<?php

class Database
{
    private $host       = 'localhost';
    private $username   = 'root';
    private $password   = '';
    private $db_name  = 'backend_selasa';
    protected $db;

    protected function __construct()
    {
        return $this->db = mysqli_connect($this->host, $this->username, $this->password, $this->db_name);
    }
}
