<?php
    require_once($_SERVER['DOCUMENT_ROOT'] . '\shopping\model\all.php');
    
    class UserController extends Controller
    {
        private $id;
        public $smarty;
        
        public function __construct($action, $id)
        {
            $this->id = $id;
            $this->smarty = new Smarty;
            if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                if (!checkToken()) {
                    $this->GET_error(4);
                }
                if (!$this->checkPermission()) {
                    $this->GET_error(6);
                }
            } else {
                if (!checkToken()) {
                    $this->redirect('guestcontroller', 'login', '未登入');
                }
                if (!$this->checkPermission()) {
                    $this->redirect('guestcontroller', 'logout', '帳戶已凍結,請撥打分機號碼2116進行解鎖');
                }
            };
            if (method_exists($this, $action)) {
                $this->$action();
            } else {
                $action = 'GET_index';
                $this->$action();
            }
        }

        /*
         * 檢查權限
         */
        private function checkPermission()
        {
                $user_item = getUser();
                return ($user_item['permission'] == 1) ? false :true;
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
            $this->redirect('guestcontroller', 'index', '登出成功');
        }

        /*
         * 個人資料頁面
         */
        public function GET_userInfo()
        {
            $this->isGet();
            $is_login = (checkToken()) ? true : false;
            $user_item = getUser();
            
            $this->smarty->assign('permission', $user_item['permission']);
            $this->smarty->assign('user_item', $user_item);
            $this->smarty->assign('cash', $user_item['cash']);
            $this->smarty->assign('is_login', $is_login);
            $this->smarty->display($_SERVER['DOCUMENT_ROOT'] . '/shopping/views/user_info.html');
        }

        /*
         * 驗證密碼
         */
        function POST_checkPassword() {
            $user_item = getUser();
            $password = $_POST['password'];
            $check_tool = new CheckTool;
            if (!$is_right = $check_tool->checkPassword($password)) {
                $data = [
                    'alert' => '密碼格式錯誤',
                    'location' => '',
                    'is_success' => false,
                ];
                echo json_encode($data);
                exit();
            }
            $user = new User;
            $user_password_item = $user->getPasswordByAccount($user_item['account']);
            $is_old_password_right = password_verify($password, $user_password_item['password']);
            if ($is_old_password_right) {
                $data = [
                    'alert' => '密碼正確',
                    'location' => '',
                    'is_success' => true
                ];
                echo json_encode($data);
                exit();
            } else {
                $data = [
                    'alert' => '密碼錯誤',
                    'location' => '',
                    'is_success' => false
                ];
                echo json_encode($data);
                exit();
            }
        }

        /*
         * 修改密碼頁面
         */
        public function GET_changePassword()
        {
            $this->isGet();
            $is_login = (checkToken()) ? true : false;
            $user_item = getUser();
            
            $this->smarty->assign('permission', $user_item['permission']);
            $this->smarty->assign('user_item', $user_item);
            $this->smarty->assign('cash', $user_item['cash']);
            $this->smarty->assign('is_login', $is_login);
            $this->smarty->display($_SERVER['DOCUMENT_ROOT'] . '/shopping/views/user_change_password.html');
        }

        /*
         * 修改密碼
         */
        public function PUT_changePassword()
        {
            $this->isPut();
            $user_item = getUser();
            parse_str(file_get_contents('php://input'), $_PUT);
            $old_password = $_PUT['old_password'];
            $new_password = $_PUT['new_password'];
            $check_tool = new CheckTool;
            if (!$is_right = $check_tool->checkPassword($new_password)) {
                $data = [
                    'alert' => '密碼格式錯誤',
                    'location' => '',
                    'is_success' => false,
                ];
                echo json_encode($data);
                exit();
            }
            $user = new User;
            $user_password_item = $user->getPasswordByAccount($user_item['account']);
            $is_user_right = password_verify($old_password, $user_password_item['password']);
            if (!$is_user_right) {
                $data = [
                    'alert' => '使用者密碼錯誤',
                    'location' => '',
                    'is_success' => false,
                ];
                echo json_encode($data);
                exit();
            }
            $is_password_same = password_verify($new_password, $user_password_item['password']);
            if ($is_password_same) {
                $data = [
                    'alert' => '新舊密碼不可相同',
                    'location' => '',
                    'is_success' => false,
                ];
                echo json_encode($data);
                exit();
            }
            $new_password = password_hash($new_password, PASSWORD_DEFAULT);
            $is_success = $user->changePassword($user_item['user_id'], $new_password);
            if ($is_success) {
                $data = [
                    'alert' => '修改成功',
                    'location' => '/shopping/controller/usercontroller.php/userInfo',
                    'is_success' => true,
                ];
                echo json_encode($data);
                exit();
            } else {
                $data = [
                    'alert' => '新舊密碼不可相同',
                    'location' => '',
                    'is_success' => false,
                ];
                echo json_encode($data);
                exit();
            }
        }

        /*
         * 修改暱稱頁面
         */
        public function GET_changeName()
        {
            $this->isGet();
            $is_login = (checkToken()) ? true : false;
            $user_item = getUser();
            
            $this->smarty->assign('permission', $user_item['permission']);
            $this->smarty->assign('user_item', $user_item);
            $this->smarty->assign('cash', $user_item['cash']);
            $this->smarty->assign('is_login', $is_login);
            $this->smarty->display($_SERVER['DOCUMENT_ROOT'] . '/shopping/views/user_change_name.html');
        }
        
        /*
         * 修改暱稱
         */
        public function PUT_changeName()
        {
            $this->isPut();
            $user_item = getUser();
            parse_str(file_get_contents('php://input'), $_PUT);
            $name = $_PUT['name'];
            $check_tool = new CheckTool;
            $is_right = $check_tool->checkName($name);
            if ($is_right) {
                $user = new User;
                $is_success = $user->changeName($user_item['user_id'], $name);
                if ($is_success) {
                    $data = [
                        'alert' => '修改成功',
                        'location' => '/shopping/controller/usercontroller.php/userInfo',
                        'is_success' => true
                    ];
                } else {
                    $data = [
                        'alert' => '資料無異動',
                        'location' => '/shopping/controller/usercontroller.php/userInfo',
                        'is_success' => false
                    ];
                }
            } else {
                $data = [
                    'alert' => '格式錯誤',
                    'location' => '/shopping/controller/usercontroller.php/userInfo',
                    'is_success' => false
                ];
            }
            echo json_encode($data);
        }

        /*
         * 儲值頁面
         */
        public function GET_addMoney()
        {
            $this->isGet();
            $is_login = (checkToken()) ? true : false;
            $user_item = getUser();
            
            $this->smarty->assign('permission', $user_item['permission']);
            $this->smarty->assign('user_item', $user_item);
            $this->smarty->assign('cash', $user_item['cash']);
            $this->smarty->assign('is_login', $is_login);
            $this->smarty->display($_SERVER['DOCUMENT_ROOT'] . '/shopping/views/add_money.html');
        }

        /*
         * 儲值
         */
        public function POST_addMoney()
        {
            $this->isPost();
            $user_item = getUser();
            $add_money = $_POST['add_money'];
            $password = $_POST['password'];
            $check_tool = new CheckTool;
            $user = new User;
            $user_password_item = $user->getPasswordByAccount($user_item['account']);
            $is_user_right = password_verify($password, $user_password_item['password']);
            if (!$is_user_right) {
                $data = [
                    'alert' => '使用者密碼錯誤',
                    'location' => '',
                    'is_success' => false,
                ];
                echo json_encode($data);
                exit();
            }
            $is_right = $check_tool->checkUnsignIntNoZero($add_money);
            ## 檢查加值金額
            if (!$is_right) {
                $data = [
                    'alert' => '金額錯誤',
                    'location' => '',
                    'is_success' => false
                ];
                echo json_encode($data);
                exit();
            } elseif ($add_money > 9999999) {
                $data = [
                    'alert' => '金額錯誤',
                    'location' => '',
                    'is_success' => false
                ];
                echo json_encode($data);
                exit();
            }
            $cash = $add_money + $user_item['cash'];
            ## 計算總金額
            if ($cash > 9999999) {
                $data = [
                    'alert' => '總金額超過上限',
                    'location' => '',
                    'is_success' => false
                ];
                echo json_encode($data);
                exit();
            }
            ## 儲值
            $is_success = $user->updateCash($user_item['user_id'], $cash);
            if ($is_success) {
                $data = [
                    'alert' => '儲值成功',
                    'location' => '/shopping/controller/guestcontroller.php/index',
                    'is_success' => false
                ];
                echo json_encode($data);
                exit();
            } else {
                $data = [
                    'alert' => '儲值失敗',
                    'location' => '/shopping/controller/guestcontroller.php/index',
                    'is_success' => false
                ];
                echo json_encode($data);
                exit();
            }
        }

        /*
         * 購物車頁面
         */
        public function GET_shoppingCar()
        {
            $this->isGet();
            $is_login = (checkToken()) ? true : false;
            $user_item = getUser();
            if ($is_login) {
                $order_menu_id = GetOrderMenuId($user_item);
                $order_detail = new OrderDetail;
                $product_id_list = $order_detail->getAllProductId($order_menu_id);
                $product_list = [];
                $product = new Product;
                ## 檢查物品是否售賣中
                foreach($product_id_list as $product_id) {
                    $product_item = $product->getOneProductOnSale($product_id["product_id"]);
                    if (!isset($product_item["product_id"]) || $product_item['stock'] == 0) {
                        $order_detail->deleteOne($order_menu_id,$product_id["product_id"]);
                        continue;
                    }
                    $order_detail_item = $order_detail->getOne(GetOrderMenuId($user_item), $product_id["product_id"]);
                    $product_item['amount'] = $order_detail_item['amount'];
                    $product_list[] = $product_item;
                }
                $total_price = getTotalPrice($order_menu_id,$order_menu_id);
                $user_final_cash = $user_item['cash'] - $total_price;
                $this->smarty->assign('order_detail_list_length', count($product_id_list));
            } else {
                $total_price = 0;
                $user_final_cash = 0;
                $product_list = 0;
            }
            
            $this->smarty->assign('permission', $user_item['permission']);
            $this->smarty->assign('user_item', $user_item);
            $this->smarty->assign('product_list', $product_list);
            $this->smarty->assign('total_price', $total_price);
            $this->smarty->assign('user_final_cash', $user_final_cash);
            $this->smarty->assign('cash', $user_item['cash']);
            $this->smarty->assign('is_login', $is_login);
            $this->smarty->display($_SERVER['DOCUMENT_ROOT'] . '/shopping/views/shopping_car.html');
        }

        /*
         * 將產品加到購物車
         */
        public function POST_addProduct()
        {
            $this->isPost();
            $product_id = $_POST['product_id'];
            $user = new User;
            $user_item = $user->getUserByToken($_COOKIE['token']);
            $order_menu_id = GetOrderMenuId($user_item);
            $order_detail = new OrderDetail;
            $product_count = $order_detail->getOneCount($order_menu_id, $product_id);
            if ($product_count['count(*)']) {
                $data = [
                    'alert' => '產品已在購物車',
                    'is_success' => 0
                ];
                echo json_encode($data);
                exit();
            }
            $is_success = $order_detail->addProduct($order_menu_id, $product_id);
            if ($is_success) {
                $data = [
                    'alert' => '加入成功',
                    'is_success' => 1
                ];
            }
            echo json_encode($data);
        }

        /*
         * 將產品從購物車移除
         */
        public function DELETE_product()
        {
            $this->isDelete();
            parse_str(file_get_contents('php://input'), $_DELETE);
            $user_item = getUser();
            $order_menu_id = GetOrderMenuId($user_item);
            $product_id = $_DELETE['product_id'];
            $order_detail = new OrderDetail;
            $is_success = $order_detail->deleteOne($order_menu_id, $product_id);
            $total_price = getTotalPrice($order_menu_id);
            $user_final_cash =  $user_item['cash'] - $total_price;
            if ($is_success) {
                $data = [
                    'alert' => '',
                    'is_success' => true,
                    'total_price' => $total_price,
                    'user_final_cash' => $user_final_cash
                ];
            } else {
                $data = [
                    'alert' => '商品不存在',
                    'is_success' => false
                ];
            }
            echo json_encode($data);
        }

        /*
         * 修改購物車中產品數量
         */
        public function PUT_product()
        {
            $this->isPut();
            parse_str(file_get_contents('php://input'), $_PUT);
            $user_item = getUser();
            $order_menu_id = GetOrderMenuId($user_item);
            $product_id = $_PUT['product_id'];
            $amount = $_PUT['amount'];
            if (!preg_match('/^[1-9][0-9]{0,}$/', $amount)) {
                exit();
            }
            
            $product = new Product;
            $product_item = $product->getOneProductOnSale($product_id);
            ## 判斷產品是否售賣中
            if (!isset($product_item['product_id'])) {
                $order_detail = new OrderDetail;
                $is_success = $order_detail->updateAmount($amount, $order_menu_id, $product_id);
                $total_price = getTotalPrice($order_menu_id);
                $user_final_cash =  $user_item['cash'] - $total_price;
                $data = [
                    'alert' => '商品已下架',
                    'is_success' => 2,
                    'total_price'=> $total_price,
                    'user_final_cash' => $user_final_cash
                ];
                echo json_encode($data);
                exit();
            }
            ## 判斷庫存量是否足夠
            if ($amount > $product_item['stock']) {
                $amount = $product_item['stock'];
                $order_detail = new OrderDetail;
                $is_success = $order_detail->updateAmount($amount, $order_menu_id, $product_id);
                $total_price = getTotalPrice($order_menu_id);
                $user_final_cash =  $user_item['cash'] - $total_price;
                $data = [
                    'alert' => '庫存量不足',
                    'is_success' => 3,
                    'amount' => $amount,
                    'total_price'=> $total_price,
                    'user_final_cash' => $user_final_cash
                ];
                echo json_encode($data);
                exit();
            }
            $order_detail = new OrderDetail;
            $is_success = $order_detail->updateAmount($amount, $order_menu_id, $product_id);
            $total_price = getTotalPrice($order_menu_id);
            $user_final_cash =  $user_item['cash'] - $total_price;
            

            if ($is_success) {
                $data = [
                    'alert' => '',
                    'is_success' => 1,
                    'total_price'=> $total_price,
                    'user_final_cash' => $user_final_cash
                ];
            } else {
                $data = [
                    'alert' => '',
                    'is_success' => 0
                ];
            }
            echo json_encode($data);
        }
        
        /*
         * 結帳
         */
        public function PUT_checkOut()
        {
            $this->isPut();
            $user_item = getUser();
            $order_menu_id = GetOrderMenuId($user_item);
            $total_price = getTotalPrice($order_menu_id);
            $final_price= $user_item['cash'] - $total_price;
            ## 檢查購物車是否為空
            if ($total_price == 0) {
                $data = [
                    'alert' => '購物車內無物品',
                    'location' => '/shopping/controller/guestcontroller.php/shoppingcar',
                    'is_success' => false
                ];
                echo json_encode($data);
                exit();
            }
            ## 檢查餘額是否足夠
            if ($final_price < 0) {
                $data = [
                    'alert' => '餘額不足',
                    'is_success' => false,
                ];
                echo json_encode($data);
                exit();
            }
            $order_menu = new OrderMenu;
            $order_detail = new OrderDetail;
            $user = new User;
            $product = new Product;
            ##交易流程開始
            $user->startTransaction();
            $order_menu->startTransaction();
            $order_detail->startTransaction();
            $product->startTransaction();
            ## 登記所有物品價格
            if ($is_success_deal_price = updateDealPriceAndStock($order_detail, $product, $order_menu_id)) {
                ## 使用者扣款
                if ($is_success_user = $user->checkOut($final_price, $user_item['user_id'])) {
                    ## 修改訂單狀態
                    if ($is_success_order = $order_menu->checkOut($order_menu_id)) {
                        GetOrderMenuId($user_item);
                        $data = [
                            'alert' => '結帳成功,感謝您的光臨',
                            'location' => '/shopping/controller/guestcontroller.php/index',
                            'is_success' => true
                        ];
                        echo json_encode($data);
                        $user->commit();
                        $order_menu->commit();
                        $order_detail->commit();
                        $product->commit();
                        exit();
                    }
                }
            } 
            $data = [
                'alert' => '結帳失敗',
                'is_success' => false,
                'location' => '/shopping/controller/usercontroller.php/shoppingcar'
            ];
            $user->rollback();
            $order_menu->rollback();
            $order_detail->rollback();
            $product->rollback();
            echo json_encode($data);
        }

        /*
         * 訂單記錄頁面
         */
        public function GET_shoppingHistory()
        {
            $this->isGet();
            $is_login = (checkToken()) ? true : false;
            $user_item = getUser();
            $order_menu = new OrderMenu;
            $order_menu_list = $order_menu->getOneUserAllMenuIdDesc($user_item['user_id']);
            $order_detail = new OrderDetail;
            foreach ($order_menu_list as $index => $order_menu_item) {
                $order_menu_list[$index]['total_price'] = $order_detail->getOneMenuIdTotalPrice(
                    $order_menu_item['order_menu_id']
                );
            }
            // 購物車中商品數量
            if ($is_login) {
                $order_menu_id = GetOrderMenuId($user_item);
                $order_detail_list = $order_detail->getAllProductId($order_menu_id);
                $this->smarty->assign('order_detail_list_length', count($order_detail_list));
            }
            $this->smarty->assign('order_menu_list', $order_menu_list);
            $this->smarty->assign('permission', $user_item['permission']);
            $this->smarty->assign('cash', $user_item['cash']);
            $this->smarty->assign('is_login', $is_login);
            $this->smarty->display($_SERVER['DOCUMENT_ROOT'] . '/shopping/views/shopping_history.html');
        }

        /*
         * 訂單詳細資料頁面
         */
        public function GET_shoppingDetail()
        {
            $this->isGet();
            $is_login = (checkToken()) ? true : false;
            $user_item = getUser();
            $order_menu_id = $this->id;
            
            ## 檢查訂單編號格式
            $check_tool = new CheckTool;
            if (!$is_right = $check_tool->checkUnsignInt($order_menu_id)) {
                if ($user_item['permission'] == 2) {
                    $this->GET_error(8);
                }
                $this->GET_error(1);
                exit();
            }
            $order_menu = new OrderMenu;
            ## 檢查訂單是否存在
            $order_menu_item = $order_menu->getOneBYOrderMenuId($order_menu_id);
            if (!isset($order_menu_item['user_id'])) {
                if ($user_item['permission'] == 2) {
                    $this->GET_error(9);
                }
                $this->GET_error(2);
                exit();
            }
            ## 檢查訂單擁有者是否正確
            @$user_id = $order_menu->getOneUserId($order_menu_id);
            if ($user_item['permission'] != 2) {
                if ($user_id != $user_item['user_id'] || $order_menu_item['is_checkout'] == 0) {
                    $this->GET_error(2);
                    exit();
                }
            }
            
            $order_detail = new OrderDetail;
            $order_detail_list = $order_detail->getAllProduct($order_menu_id);
            $product = new Product;
            foreach ($order_detail_list as $index => $order_detail_item) {
                $product_item = $product->getOneProductWithoutDelete($order_detail_item['product_id']);
                $order_detail_list[$index]['image'] = $product_item['image'];
                $order_detail_list[$index]['name'] = $product_item['name'];
            }
            $this->smarty->assign('order_detail_list', $order_detail_list);
            $this->smarty->assign('permission', $user_item['permission']);
            $this->smarty->assign('cash', $user_item['cash']);
            $this->smarty->assign('is_login', $is_login);
            $this->smarty->display($_SERVER['DOCUMENT_ROOT'] . '/shopping/views/shopping_detail.html');
        }
        
        public function GET_test()
        {
            $this->isGet();
            $product = new product;
            $product->startTransaction();
            $is_success = $product->updateStock(19, 15);
            $product->rollback();
            echo $is_success;
        }
    }
    