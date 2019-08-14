<?php
    require_once($_SERVER['DOCUMENT_ROOT'] . '/shopping/model/Model.php');

    class OrderMenu extends Model
    {
        private $table = 'Order_menu';

        /*
         * 新增一筆訂單(購物車)
         */
        public function addList($user_id)
        {
            $is_success = $this->insertInto($this->table, ['user_id'], [$user_id], 'i');
            return $is_success;
        }

        /*
         * 藉由user_id取得一筆未結帳訂單(購物車)
         */
        public function getLastListByUserId($user_id)
        {
            $order_menu_item = $this->selectLastOneWithWhere(
                $this->table,
                ['*'],
                ['user_id', 'is_checkout'],
                [$user_id, 0],
                'ii',
                'order_menu_id'
            );
            return $order_menu_item;
        }

        /*
         * 藉由order_menu_id取得一筆訂單(訂單紀錄)
         */
        public function getOneBYOrderMenuId($order_menu_id)
        {
            $order_menu_item = $this->selectSingleWithWhere(
                $this->table,
                ['*'],
                ['order_menu_id'],
                [$order_menu_id],
                'i'
            );
            return $order_menu_item;
        }

        /*
         * 結帳
         */
        public function checkOut($order_menu_id)
        {
            $is_success = $this->update(
                $this->table,
                ['is_checkout', 'updated_at'],
                [1, date("Y/m/d H:i:s")],
                ['order_menu_id'],
                [$order_menu_id],
                'isi'
            );
            return $is_success;
        }

        /*
         * 取得單一使用者所有訂單編號
         */
        public function getOneUserAllMenuId($user_id)
        {
            $order_menu_id_list = $this->selectAllWithWhere(
                $this->table,
                ['order_menu_id', 'updated_at'],
                ['user_id', 'is_checkout'],
                [$user_id, 1],
                'ii'
            );
            return $order_menu_id_list;
        }

        /*
         * 取得單一使用者所有訂單編號
         */
        public function getOneUserAllMenuIdDesc($user_id)
        {
            $order_menu_id_list = $this->selectAllWithWhereDesc(
                $this->table,
                ['order_menu_id', 'is_shipped', 'updated_at'],
                ['user_id', 'is_checkout'],
                [$user_id, 1],
                'ii',
                'order_menu_id'
            );
            return $order_menu_id_list;
        }

        /*
         * 取得所有訂單
         */
        public function getAllOrderMenu()
        {
            $order_menu_list = $this->selectAllWithWhereDesc(
                $this->table,
                ['*'],
                ['is_checkout'],
                [1], 'i',
                'order_menu_id'
            );
            return $order_menu_list;
        }

        /*
         * 搜尋訂單
         */
        public function searchOrderMenu($colum, $value)
        {
            $order_menu_list = $this->selectAllWithLikeWhere(
                $this->table,
                ['*'],
                ['is_checkout'],
                [1],
                $colum,
                $value,
                'i'
            );
            return $order_menu_list;
        }

        /*
         * 更新出貨狀態
         */
        public function updateIsShipped($order_menu_id, $is_shipped)
        {
            $is_success = $this->update(
                $this->table,
                ['is_shipped'],
                [$is_shipped],
                ['order_menu_id'],
                [$order_menu_id],
                'ii'
            );
            return $is_success;
        }

        /*
         * 
         */
        public function getOneUserId($order_menu_id)
        {
            $user_id = $this->selectSingleWithWhere(
                $this->table,
                ['user_id'],
                ['order_menu_id'],
                [$order_menu_id],
                'i'
            );
            return $user_id['user_id'];
        }
    }
