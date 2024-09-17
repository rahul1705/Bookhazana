<?php

class Cart
{
    public $db = null;
    public function __construct(DBController $db) {
        if (!isset($db->con)) return null;
        $this->db = $db;
    }

    public function insertCart($params = null, $table = 'cart') {
        if ($this->db->con != null) {
            if ($params != null) {
                $cols = implode(',', array_keys($params));
                $vals = implode(',', array_values($params));

                $query = sprintf("INSERT INTO %s(%s) VALUES(%s)", $table, $cols, $vals);
                $res = $this->db->con->query($query);
                return $res;
            }
        }
    }

    public function addToCart($userid, $itemid) {
        if (isset($userid) && isset($itemid)) {
            $params = array(
                "user_id" => $userid,
                "item_id" => $itemid
            );

            $res = $this->insertCart($params);
            if ($res) {
                header("Location:".$_SERVER['HTTP_REFERER']);
            }
        }
    }

    //    Delete Cart Item
    public function deleteCartItem($item_id = null, $table = 'cart') {
        if ($item_id != null) {
            $res = $this->db->con->query("DELETE FROM {$table} WHERE item_id={$item_id}");
            if ($res) {
                header("Location:".$_SERVER['PHP_SELF']);
            }
            return $res;
        }
    }

    //    Calculate Subtotal
    public function getSum($arr) {
        if (isset($arr)) {
            $sum = 0;
            foreach ($arr as $item) {
                $sum += floatval($item[0]) - (floatval($item[0]) * 0.05);
            }
            return sprintf('%.2f', $sum);
        }
    }

//    Remove Duplicate
    public function getCartId($cartArray = null, $key = "item_id") {
        if ($cartArray != null) {
            $cart_id = array_map(function ($value) use ($key){
                return $value[$key];
            }, $cartArray);
            return $cart_id;
        }
    }

//    Save For Later
    public function saveForLater($item_id = null, $saveTable = 'wishlist', $fromTable = 'cart') {
        if ($item_id != null) {
            $query = "INSERT INTO {$saveTable} SELECT * FROM {$fromTable} WHERE item_id={$item_id};";
            $query  .="DELETE FROM {$fromTable} WHERE item_id={$item_id};";

//            echo $query;
            $res = $this->db->con->multi_query($query);
            if ($res) {
                header("Location:".$_SERVER['PHP_SELF']);
            }
            return $res;
        }
    }

}