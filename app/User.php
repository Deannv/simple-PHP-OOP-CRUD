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

    public function store($request)
    {
        $nama       = $request['nama'];
        $email      = $request['email'];
        $password   = $request['password'];
        $kota       = $request['kota'];
        $alamat     = $request['alamat'];
        $telp       = $request['telp'];
        $status     = $request['status'];

        $sql        = "INSERT INTO $this->tb_name (nama, email, password, kota, alamat, telp, status) VALUES ('$nama', '$email', '$password', '$kota', '$alamat','$telp', '$status')";
        $query      = mysqli_query($this->db, $sql);
        header('Location: index.php');
    }

    public function update($request)
    {
        $id         = $request['id'];
        $nama       = $request['nama'];
        $email      = $request['email'];
        $kota       = $request['kota'];
        $alamat     = $request['alamat'];
        $telp       = $request['telp'];
        $status     = $request['status'];

        $sql        = "UPDATE $this->tb_name SET nama='$nama', email='$email', kota='$kota', alamat='$alamat', telp='$telp', status='$status' WHERE id = '$id'";
        $query      = mysqli_query($this->db, $sql);

        header('Location: index.php?data=' . $query);
    }

    public function delete($id)
    {
        $sql    = "DELETE FROM $this->tb_name WHERE id = '$id'";
        $query  = mysqli_query($this->db, $sql);

        header('Location: index.php');
        exit();
    }
}


$user = new User();
