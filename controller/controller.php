<?php
    
    class Controller
    {
        public function isGet()
        {
            if (!$_SERVER['REQUEST_METHOD'] == 'GET') {
                $date = [
                    'alert' => '錯誤請求'
                ];
                echo json_encode($date);
                exit();
            }
        }

        public function isPost()
        {
            if (!$_SERVER['REQUEST_METHOD'] == 'POST') {
                $date = [
                    'alert' => '錯誤請求'
                ];
                echo json_encode($date);
                exit();
            }
        }


        public function isPut()
        {
            if (!$_SERVER['REQUEST_METHOD'] == 'PUT') {
                $date = [
                    'alert' => '錯誤請求'
                ];
                echo json_encode($date);
                exit();
            }
        }


        public function isDelete()
        {
            if (!$_SERVER['REQUEST_METHOD'] == 'DELETE') {
                $date = [
                    'alert' => '錯誤請求'
                ];
                echo json_encode($date);
                exit();
            }
        }

        /*
         * 前端重導
         */
        protected function redirect($controller, $action, $alert)
        {
            $data = [
                'alert' => $alert,
                'is_success' => 2,
                'location' => "/shopping/controller/$controller.php/{$action}"
            ];
            echo json_encode($data);
            exit();
        }

        /*
         * 送出錯誤訊息並導頁
         */
        public function GET_error($error)
        {
            $this->smarty->assign('error', $error);
            $this->smarty->display($_SERVER['DOCUMENT_ROOT'] . '/shopping/views/error.html');
            exit();
        }
    }
    