<?php
class Product
{
    public $db = null;
    public function __construct(DBController $db) {
        if (!isset($db->con)) {
            throw new Exception("Database connection is not available.");
        }
        $this->db = $db;
    }

    //fetch products
    public function getData($table='products') {
        $result = $this->db->con->query("SELECT * FROM {$table}");
        $resultArray = array();
        while ($item = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $resultArray[] = $item;
        }

        return $resultArray;
    }

    public function getProduct($item_id, $table='products') {
        if (isset($item_id)) {
            $query = "
                SELECT p.item_id, p.item_name, p.item_price, p.item_image, p.item_author, p.item_desc, u.fullname AS seller_name
                FROM {$table} p
                JOIN seller s ON p.seller_id = s.seller_id
                JOIN users u ON s.user_id = u.user_id
                WHERE p.item_id = ?
            ";
            $stmt = $this->db->con->prepare($query);
            $stmt->bind_param('i', $item_id);
            $stmt->execute();
            $result = $stmt->get_result();
            $resultArray = array();
            while ($item = $result->fetch_assoc()) {
                $resultArray[] = $item;
            }
            return $resultArray;
        }


        // if (isset($item_id)) {
        //     $result = $this->db->con->query("SELECT * FROM {$table} WHERE item_id={$item_id}");
        //     $resultArray = array();
        //     while ($item = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        //         $resultArray[] = $item;
        //     }
        //     return $resultArray;
        // }
    }

    public function getCategories()
    {
        $result = $this->db->con->query("SELECT DISTINCT item_cat FROM products");
        $categories = array();

        while ($row = mysqli_fetch_assoc($result)) {
            $categories[] = $row['item_cat'];
        }

        return $categories;
    }

}