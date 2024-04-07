<?php

require_once 'Database.php';

class User extends Database
{
    protected $tb_name = 'users';

    public function __construct()
    {
        parent::__construct();
    }

    public function all()
    {
        $sql    = "SELECT $this->tb_name.*, tb_status.nama as nama_status FROM $this->tb_name JOIN tb_status ON $this->tb_name.status = tb_status.id";
        $query  = mysqli_query($this->db, $sql);

        $data   = array();
        while ($temp_user = mysqli_fetch_array($query)) {
            $data[] = $temp_user;
        }
        return $data;
    }

    public function show($id)
    {
        $sql    = "SELECT $this->tb_name.*, tb_status.nama as nama_status FROM $this->tb_name JOIN tb_status ON $this->tb_name.status = tb_status.id WHERE $this->tb_name.id = '$id'";
        $query  = mysqli_query($this->db, $sql);

        $data   = array();
        while ($temp_user = mysqli_fetch_array($query)) {
            $data[] = $temp_user;
        }
        return $data;
    }
}


$user = new User();
