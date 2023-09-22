<?php
header('Origin:xxx.com');
header('Access-Control-Allow-Origin:*');
require 'Db.php';
class Login extends Db
{
    function Masuk($username, $password)
    {
        $username = $this->Koneksi()->real_escape_string($username);
        $md5 = md5($password);
        $queryMahasiswa = "SELECT * from mahasiswa where username='$username' and password='$md5'";
        $queryDosen = "SELECT * from dosen where username='$username' and password='$md5'";
        $queryAdmin = "SELECT * from admin where username='$username' and password='$md5'";

        $resultMahasiswa = $this->Koneksi()->query($queryMahasiswa);
        $resultDosen = $this->Koneksi()->query($queryDosen);
        $resultAdmin = $this->Koneksi()->query($queryAdmin);

        $numRowsMahasiswa = $resultMahasiswa->num_rows;
        $numRowsDosen = $resultDosen->num_rows;
        $numRowsAdmin = $resultAdmin->num_rows;

        if ($numRowsMahasiswa > 0) {
            $obj = $resultMahasiswa->fetch_object();
            $obj->key = 'ok1';
            echo json_encode($obj);
        } else if ($numRowsDosen > 0) {
            $obj = $resultDosen->fetch_object();
            $obj->key = 'ok2';
            echo json_encode($obj);
        } else if ($numRowsAdmin > 0) {
            $obj = $resultAdmin->fetch_object();
            $obj->key = 'ok3';
            echo json_encode($obj);
        } else {
            $obj = array(
                'key' => 'bad'
            );
            echo json_encode($obj);
        }
    }
}
if (isset($_POST["login"])) {
    $login = new Login();
    $login->Masuk($_POST["username"],$_POST["password"]);
}