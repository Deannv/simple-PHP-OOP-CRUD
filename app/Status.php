<?php

require_once 'Database.php';

class Status extends Database
{
    protected $tb_name = 'tb_status';

    public function __construct()
    {
        parent::__construct();
    }

    public function all()
    {
        $sql    = "SELECT * FROM $this->tb_name";
        $query  = mysqli_query($this->db, $sql);

        return $query;
    }
}

$status = new Status();
