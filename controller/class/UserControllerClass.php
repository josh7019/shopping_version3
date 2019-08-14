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
                foreach($product_id_list as $product_id) {
                    $product_item = $product->getOneProductOnSale($product_id["product_id"]);
                    if (!isset($product_item["product_id"])) {
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
            $total_price = getTotalPrice(GetOrderMenuId($user_item));
            $final_price= $user_item['cash'] - $total_price;
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
            $order_menu_id = GetOrderMenuId($user_item);
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
                'is_success' => false
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
                $this->GET_error(1);
                exit();
            }
            ## 檢查訂單擁有者是否正確
            $order_menu = new OrderMenu;
            @$user_id = $order_menu->getOneUserId($order_menu_id);
            $order_menu_item = $order_menu->getOneBYOrderMenuId($order_menu_id);
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
    