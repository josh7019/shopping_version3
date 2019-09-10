<?php
    require_once($_SERVER['DOCUMENT_ROOT'] . '\shopping\model\all.php');

    class ManagerController extends Controller
    {
        private $id;
        private $smarty;
        private $query_string;
        public function __construct($action, $id, $query_string)
        {
            $this->id = $id;
            $this->smarty = new Smarty;
            $this->query_string = $query_string;
            if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                if (!checkToken()) {
                    $this->GET_error(4);
                }
                if (!$this->checkPermission()) {
                    $this->GET_error(3);
                }
            } else {
                if (!checkToken()) {
                    $this->redirect('guestcontroller', 'login', '請先登入');
                }
                if (!$this->checkPermission()) {
                    $this->redirect('guestcontroller', 'index', '權限錯誤');
                }
            };
            if (method_exists($this, $action)) {
                $this->$action();
            } else {
                $action = 'GET_error';
                $this->$action(5);
            }
        }

        /*
         * 檢查權限
         */
        private function checkPermission()
        {
                $user_item = getUser();
                return ($user_item['permission'] != 2) ? false :true;
        }

        /*
         * 管理者登入
         */
        public function POST_login()
        {
            $this->isPost();
            $account = $_POST['account'];
            $password = $_POST['password'];
            $check_tool = new CheckTool;
            $is_format_right = $check_tool->checkLoginFormat($account, $password);
            ## 檢查格式
            if (!$is_format_right) {
                $data=[
                    'alert' => '格式錯誤',
                ];
                echo json_encode($data);
            }
            
            $manager = new Manager;
            $manager_item = $manager->getAccount($account);
            ## 搜尋帳號
            if (isset($manager_item['account'])) {
                if (password_verify($password, $manager_item['password'])) {
                    $token = produceToken();
                    $manager->addToken($account, $token);
                    setcookie('token', $token, time() + 3600);
                    $data=[
                        'alert' => '管理者登入成功',
                        'location' => '/shopping/controller/PageController.php/index',
                    ];
                    echo json_encode($data);
                } else {
                    $data=[
                        'alert' => '密碼錯誤',
                    ];
                    echo json_encode($data);
                }
            }
        }

        /*
         * 產品管理頁面
         */
        public function GET_product()
        {
            $this->isGet();
            $is_login = (checkToken()) ? true : false;
            $user_item = getUser();
            $product = new Product;
            $order_detail = new OrderDetail;
            ## 檢查是否搜尋
            if (isset($_GET['type'])) {
                switch ($_GET['type']) {
                    case 1 : $type = 'product_id';
                    break;
                    case 2 : $type = 'name';
                    break;
                    case 3 : $type = 'status';
                    break;
                    default : $type = 'product_id';
                }
                $search_value = $_GET['search_value'];
                $product_list = $product->searchProduct($type, $_GET['search_value']);
            } else {
                $product_list = $product->getAllProduct();
            }

            foreach ($product_list as $index => $product_item) {
                $total_saled = $order_detail->getProductSaled($product_item['product_id']);
                $product_list[$index]['total_saled'] = $total_saled;
            }

            $this->smarty->assign('product_list', $product_list);
            $this->smarty->assign('permission', $user_item['permission']);
            $this->smarty->assign('cash', $user_item['cash']);
            $this->smarty->assign('is_login', $is_login);
            $this->smarty->display($_SERVER['DOCUMENT_ROOT'] . '/shopping/views/manager_product.html');
        }
        
        /*
         * 刪除產品
         */
        public function DELETE_product()
        {
            $this->isDelete();
            parse_str(file_get_contents('php://input'), $_DELETE);
            $product_id = $_DELETE['product_id'];
            $product = new Product;
            $is_success = $product->deleteOne($product_id);
            if ($is_success) {
                $data = [
                    'alert' => '刪除成功',
                    'is_success' => true
                ];
                echo json_encode($data);
                exit();
            } else {
                $data = [
                    'alert' => '刪除失敗',
                    'is_success' => false
                ];
                echo json_encode($data);
                exit();
            }
        }

        /*
         * 修改產品
         */
        public function POST_product()
        {
            $this->isPost();
            $product_id = $_POST['product_id'];
            $price = $_POST['price'];
            $status = $_POST['status'];
            $name = $_POST['name'];
            $stock = $_POST['stock'];
            $product = new Product;
            $name  =  htmlentities($name, ENT_NOQUOTES, "UTF-8");
            $check_tool = new CheckTool;
            ## 檢查價格與庫存
            $is_price_right = ($check_tool->checkUnsignIntNoZero($price) && $price <= 99999) ? true : false;
            $is_stock_right = ($check_tool->checkUnsignIntNoZero($price) && $stock <= 1000) ? true : false;
            if (!$is_price_right && $is_stock_right) {
                $data = [
                    'alert' => '價格或庫存量錯誤',
                    'location' => '/shopping/controller/managercontroller.php/product',
                    'is_success' => false
                ];
                echo json_encode($data);
                exit();
            }
            $is_success = $product->editOneProduct($name, $price, $status, $stock, $product_id);
            $product_item=$product->getOneProduct($product_id);
            uploadImage($product_item);
            if ($is_success) {
                $data = [
                    'alert' => '修改成功',
                    'is_success' => true,
                    'location' => '/shopping/controller/managercontroller.php/product'
                ];
                echo json_encode($data);
                exit();
            } else {
                $data = [
                    'alert' => '資料無異動',
                    'is_success' => false
                ];
                echo json_encode($data);
                exit();
            }
        }

        /*
         * 新增產品頁面
         */
        public function GET_addProduct()
        {
            $this->isGet();
            $is_login = (checkToken()) ? true : false;
            $user_item = getUser();

            $this->smarty->assign('permission', $user_item['permission']);
            $this->smarty->assign('is_login', $is_login);
            $this->smarty->assign('cash', $user_item['cash']);
            $this->smarty->display($_SERVER['DOCUMENT_ROOT'] . '/shopping/views/manager_add_product.html');
        }
        
        /*
         * 新增產品
         */
        public function POST_addProduct()
        {
            $this->isPost();
            $name = $_POST['name'];
            $price = $_POST['price'];
            $status = $_POST['status'];
            $stock = $_POST['stock'];
            $product = new Product;
            $check_tool = new CheckTool;
            $is_price_right = ($check_tool->checkUnsignIntNoZero($price) && $price <= 99999) ? true : false;
            $is_stock_right = ($check_tool->checkUnsignIntNoZero($price) && $stock <= 1000) ? true : false;
            if (!$is_price_right && $is_stock_right) {
                $data = [
                    'alert' => '價格或庫存量錯誤',
                    'location' => '/shopping/controller/managercontroller.php/product',
                    'is_success' => false
                ];
                echo json_encode($data);
                exit();
            }
            $name  =  htmlentities($name, ENT_NOQUOTES, "UTF-8");
            $is_success = $product->addProduct($name, $price, $status, $stock);
            $data = [
                'alert' => '新增產品成功',
                'location' => '/shopping/controller/managercontroller.php/product'
            ];
            $product_item = $product->getNewProductId();
            uploadImage($product_item);
            echo json_encode($data);
        }

        /*
         * 產品編輯頁面
         */
        public function GET_editProduct()
        {
            $this->isGet();
            $is_login = (checkToken()) ? true : false;
            $user_item = getUser();
            $product = new Product();
            $product_item = $product->getOneProduct($this->id);
            
            $this->smarty->assign('product_item', $product_item);
            $this->smarty->assign('permission', $user_item['permission']);
            $this->smarty->assign('cash', $user_item['cash']);
            $this->smarty->assign('is_login', $is_login);
            $this->smarty->display($_SERVER['DOCUMENT_ROOT'] . '/shopping/views/maneger_edit_product.html');
        }

         /*
         * 會員管理頁面
         */
        public function GET_member()
        {
            $this->isGet();
            $is_login = (checkToken()) ? true : false;
            $manager_item = getUser();
            $user = new User;
            $order_menu = new OrderMenu;
            ## 檢查是否搜尋
            if (isset($_GET['type'])) {
                switch ($_GET['type']) {
                    case 0 : $type = 'user_id';
                    break;
                    case 1 : $type = 'account';
                    break;
                    case 2 : $type = 'name';
                    break;
                    case 3 : $type = 'permission';
                    break;
                    default : $type = 'user_id';
                }
                $search_value = $_GET['search_value'];
                $user_list = $user->searchUser($type, $_GET['search_value']);
            } else {
                $user_list = $user->getAllUser();
            }
            foreach ($user_list as $index => $user_item) {
                ## 取得使用者所有訂單
                $order_menu_list = $order_menu->getOneUserAllMenuId($user_item['user_id']);
                $total_price = 0;
                foreach ($order_menu_list as $order_menu_index => $order_menu_item) {
                    ##取得單一訂單總價
                    $menu_price = getTotalPrice($order_menu_item['order_menu_id']);
                    $total_price += $menu_price;
                }
                $user_list[$index]['total_price'] = $total_price;
            }
            
            $this->smarty->assign('user_list', $user_list);
            $this->smarty->assign('permission', $manager_item['permission']);
            $this->smarty->assign('cash', $user_item['cash']);
            $this->smarty->assign('is_login', $is_login);
            $this->smarty->display($_SERVER['DOCUMENT_ROOT'] . '/shopping/views/maneger_member.html');
        }

        /*
         * 會員權限修改
         */
        public function PUT_member()
        {
            $this->isPut();
            parse_str(file_get_contents('php://input'), $_PUT);
            $user_id = $_PUT['user_id'];
            $permission = $_PUT['permission'];
            $user = new User;
            $is_success = $user->updatePermission($user_id, $permission);
            if ($is_success) {
                $data = [
                    'alert' => '修改成功',
                    'location' => '',
                    'is_success' => true,
                ];
            } else {
                $data = [
                    'alert' => '資料無異動',
                    'location' => '',
                    'is_success' => false,
                ];
            }
            echo json_encode($data);
        }

        /*
         * 訂單管理頁面
         */
        public function GET_orderMenu()
        {
            $this->isGet();
            $is_login = (checkToken()) ? true : false;
            $user_item = getUser();
            $order_menu = new OrderMenu;
            $user = new User;
            $order_detail = new OrderDetail;
            ## 檢查是否搜尋
            if (isset($_GET['type'])) {
                switch ($_GET['type']) {
                    case 0 : $type = 'order_menu_id';
                    break;
                    case 1 : $type = 'is_shipped';
                    break;
                    default : $type = 'order_menu_id';
                }
                    $search_value = $_GET['search_value'];
                    $order_menu_list = $order_menu->searchOrderMenu($type, $_GET['search_value']);

            } else {
                $order_menu_list = $order_menu->getAllOrderMenu();
            }
            foreach ($order_menu_list as $index => $order_menu_item) {
                $order_menu_list[$index]['total_price'] = $order_detail->getOneMenuIdTotalPrice(
                    $order_menu_item['order_menu_id']
                );
                $user_account = $user->getOneAccountByUserId($order_menu_item['user_id']);
                $order_menu_list[$index]['account'] = $user_account['account'];
            }

            
            $this->smarty->assign('order_menu_list', $order_menu_list);
            $this->smarty->assign('permission', $user_item['permission']);
            $this->smarty->assign('cash', $user_item['cash']);
            $this->smarty->assign('is_login', $is_login);
            $this->smarty->display($_SERVER['DOCUMENT_ROOT'] . '/shopping/views/manager_order_menu.html');
        }

        /*
         * 修改訂單出貨狀態
         */
        public function PUT_isShipped()
        {
            $this->isPut();
            parse_str(file_get_contents('php://input'), $_PUT);
            $order_menu_id = $_PUT['order_menu_id'];
            $is_shipped = $_PUT['is_shipped'];
            $order_menu = new OrderMenu;
            $is_success = $order_menu->updateIsShipped($order_menu_id, $is_shipped);
            if ($is_success) {
                $date = [
                    'is_success' => true,
                ];
            } else {
                $date = [
                    'is_success' => false
                ];
            }
            echo json_encode($date);
        }
    }
    