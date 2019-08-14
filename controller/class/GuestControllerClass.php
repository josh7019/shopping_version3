<?php
    require_once($_SERVER['DOCUMENT_ROOT'] . '\shopping\model\all.php');

    class GuestController extends Controller
    {
        private $id;
        private $smarty;
        private $query_string;
        public function __construct($action, $id, $query_string)
        {
            $this->id = $id;
            $this->smarty = new Smarty;
            $this->query_string = $query_string;
            if (method_exists($this, $action)) {
                $this->$action();
            } else {
                $action = 'GET_index';
                $this->$action();
            }
        }


        /*
         * 首頁
         */
        public function GET_index()
        {
            $this->isGet();
            $is_login = (checkToken()) ? true : false;
            $user_item = getUser();
            $product = new Product;
            $order_detail = new OrderDetail;
            $check_tool = new CheckTool;
            if (isset($_GET['page'])) {
                $page_number = $_GET['page'];
                $page_number = ($check_tool->checkUnsignIntNoZero($page_number)) ? $page_number : 1;
            } else {
                $page_number = 1;
            }
            ## 檢查是否搜尋
            if (isset($_GET['search_value'])) {
                $type = 'name';
                $search_value = $_GET['search_value'];
                $product_count = $product->searchProductOnSaleCount($type, $search_value);
                $page_amount = ceil($product_count/8);
                $page_amount = ($page_amount == 0) ? 1 : $page_amount;
                $page_number = ($page_number > $page_amount) ? $page_amount : $page_number;
                $product_list = $product->searchProductOnSaleLimit(
                    $type,
                    $search_value,
                    $page_number,
                    8
                );
                $search = true;
                $this->smarty->assign('search_value', $search_value);
            } else {
                $product_count = $product->getAllProductOnSaleCount();
                $page_amount = ceil($product_count/8);
                $page_amount = ($page_amount == 0) ? 1 : $page_amount;
                $page_number = ($page_number > $page_amount) ? $page_amount : $page_number;
                $product_list = $product->getAllProductOnSaleLimit($page_number, 8);
                $search = false;
            }
            foreach ($product_list as $index => $product_item) {
                $total_saled = $order_detail->getProductSaled($product_item['product_id']);
                $product_list[$index]['total_saled'] = $total_saled;
            }
            // 購物車中商品數量
            if ($is_login) {
                $order_menu_id = GetOrderMenuId($user_item);
                $order_detail = new OrderDetail;
                $order_detail_list = $order_detail->getAllProductId($order_menu_id);
                $this->smarty->assign('order_detail_list_length', count($order_detail_list));
            }
            
            $this->smarty->assign('now_page', $page_number);
            $this->smarty->assign('search', $search);
            $this->smarty->assign('page_amount', $page_amount);
            $this->smarty->assign('product_list', $product_list);
            $this->smarty->assign('permission', $user_item['permission']);
            $this->smarty->assign('is_login', $is_login);
            $this->smarty->display($_SERVER['DOCUMENT_ROOT'] . '/shopping/views/index.html');
        }

        /*
         * 檢查帳號是否重複
         */
        public function POST_checkAccount()
        {
            $this->isPost();
            $account = $_POST['account'];
            $user = new User();
            $user_account = $user->getAccount($account);
            echo json_encode($user_account);
            exit();
        }

        /*
         * 註冊頁面
         */
        public function GET_signup()
        {
            $this->isGet();
            if (checkToken()) {
                $this->GET_error(7);
            }
            $is_login = (checkToken()) ? true : false;
            $user_item = getUser();

            $this->smarty->assign('permission', $user_item['permission']);
            $this->smarty->assign('is_login', $is_login);
            $this->smarty->display($_SERVER['DOCUMENT_ROOT'] . '/shopping/views/signup.html');
        }
        
        /*
         * 註冊
         */
        public function POST_signup()
        {
            $this->isPost();
            if (checkToken()) {
                $this->redirect('guestcontroller', 'index', '請先登出再註冊');
            }
            $account = $_POST['account'];
            $password = $_POST['password'];
            $id_number = $_POST['id_number'];
            $name = $_POST['name'];
            $check_tool = new CheckTool;
            $check_result = $check_tool->checkSignupFormat($account, $password, $name, $id_number);
            ## 判斷格式是否正確
            if (!$check_result) {
                $data = [
                    'alert' => '格式錯誤或帳號已存在',
                ];
                echo json_encode($data);
                exit();
            }

            $user = new User;
            $password = password_hash($password, PASSWORD_DEFAULT);
            $is_success = $user->signup($account, $password, $name, $id_number);
            if ($is_success) {
                $this->redirect('guestcontroller', 'login', '註冊成功');
            } else {
                $data = [
                    'alert' => '註冊失敗',
                ];
            }
            echo json_encode($data);
            exit();
        }

        /*
         * 登入
         */
        public function GET_login()
        {
            $this->isGet();
            if (checkToken()) {
                $this->GET_error(7);
            }
            $is_login = (checkToken()) ? true : false;
            $user_item = getUser();

            $this->smarty->assign('permission', $user_item['permission']);
            $this->smarty->assign('is_login', $is_login);
            $this->smarty->display($_SERVER['DOCUMENT_ROOT'] . '/shopping/views/login.html');
        }

         public function POST_login()
        {
            $this->isPost();
            if (checkToken()) {
                $this->redirect('guestcontroller', 'index', '重複登入');
            }
            $account = $_POST['account'];
            $password = $_POST['password'];
            $check_tool = new CheckTool;
            $is_format_right = $check_tool->checkLoginFormat($account, $password);
            ## 檢查格式
            if (!$is_format_right) {
                $data = [
                    'alert' => '格式錯誤',
                ];
                echo json_encode($data);
                exit();
            }
            
            $user = new User;
            $user_item = $user->getAccount($account);
            ## 搜尋帳號
            if (isset($user_item['account'])) {
                if (password_verify($password, $user_item['password'])) {
                    $token = produceToken();
                    $user->addToken($account, $token);
                    setcookie('token', $token, time() + 3600 ,'/');
                    ##檢查並更新購物車
                    GetOrderMenuId($user_item);
                    $this->redirect('guestcontroller', 'index', '登入成功');
                } else {
                    $data = [
                        'alert' => '密碼錯誤',
                    ];
                    echo json_encode($data);
                    exit();
                }
            }
        }

        
        /*
         * 登出
         */
        public function GET_logout()
        {
            $this->isGet();
            $this->smarty->display($_SERVER['DOCUMENT_ROOT'] . '/shopping/views/logout.html');
        }

        public function DELETE_logout()
        {
            $this->isDelete();
            $user = new User;
            $user_item = getUser();
            $is_success = $user->addToken($user_item['account'], null);
            setcookie ("token", "test", time()-100, '/');
            $this->redirect('guestcontroller', 'index', '已登出');
        }
    }
