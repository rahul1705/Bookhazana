<?php
class Users
{
    public $db = null;
    public function __construct(DBController $db)
    {
        if (!isset($db->con)) {
            throw new Exception("Database connection is not available.");
        }
        $this->db = $db;
    }

    // Function to get user data by user_id
    public function getUserData($user_id)
    {
        if ($user_id != null) {
            $query = "SELECT * FROM users WHERE user_id = ?";
            $stmt = $this->db->con->prepare($query);
            $stmt->bind_param("i", $user_id);
            $stmt->execute();
            $result = $stmt->get_result();
            return $result->fetch_assoc();
        }
        return null;
    }

    // Function to update user data
    public function updateUserData($user_id, $data)
    {
        $query = "UPDATE users SET user_img = ?, fullname = ?, email = ?, mobile = ?, address = ? WHERE user_id = ?";
        $stmt = $this->db->con->prepare($query);
        $stmt->bind_param("sssssi", $data['user_img'], $data['fullname'], $data['email'], $data['mobile'], $data['address'], $user_id);
        return $stmt->execute();
    }
}
