<?php

class DBController
{
//    Database Connection
    protected $host = 'localhost';
    protected $user = 'root';
    protected $pass = '';
    protected $db = 'bookhazana';
    protected $port = 3307;

    public $con = null;

    public function __construct()
    {
        $this->con = mysqli_connect($this->host, $this->user, $this->pass, $this->db, $this->port);
        if ($this->con->connect_error) {
            die("Fail: " . $this->con->connect_error);
        }
    }

    public function __destruct()
    {
        $this->closeConnection();
    }

    protected function closeConnection()
    {
        if ($this->con != null) {
            $this->con->close();
            $this->con = null;
        }
    }
}