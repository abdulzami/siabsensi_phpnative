<?php
header('Origin:xxx.com');
header('Access-Control-Allow-Origin:*');
require 'Db.php';
class Dosen extends Db
{
    public function UsernameCheck($username)
    {
        $queryMahasiswa = "SELECT * from mahasiswa where username='$username'";
        $queryDosen = "SELECT * from dosen where username='$username'";
        $queryAdmin = "SELECT * from admin where username='$username'";

        $resultMahasiswa = $this->Koneksi()->query($queryMahasiswa);
        $resultDosen = $this->Koneksi()->query($queryDosen);
        $resultAdmin = $this->Koneksi()->query($queryAdmin);

        $numRowsMahasiswa = $resultMahasiswa->num_rows;
        $numRowsDosen = $resultDosen->num_rows;
        $numRowsAdmin = $resultAdmin->num_rows;

        if ($numRowsMahasiswa > 0) {
            return "ada";
        } else if ($numRowsDosen > 0) {
            return "ada";
        } else if ($numRowsAdmin > 0) {
            return "ada";
        } else {
            return "oke";
        }
    }


    public function Create($nip, $nama, $username, $password)
    {
        $dd = new Dosen();
        if ($dd->UsernameCheck($username) == "oke") {
            $pass5 = md5($password);
            $query = "INSERT into dosen (nip,username,password,nama) values ('$nip','$username','$pass5','$nama')";
            $exc = $this->Koneksi()->query($query);
            if ($exc == true) {
                echo "dosencreatesuccess";
            } else {
                echo "dosencreatefailed";
            }
        } else if ($dd->UsernameCheck($username) == "ada") {
            echo "usernamesama";
        } else {
            echo $dd->UsernameCheck($username);
        }
    }
    public function read()
    {
        $ar = array();
        $query = "SELECT * from dosen order by time_add";
        $result = $this->Koneksi()->query($query);
        while ($obj = $result->fetch_object()) {
            $ar[] = $obj;
        }
        echo json_encode($ar);
    }
    public function readWithParam($nip)
    {
        $ar = array();
        $query = "SELECT * from dosen where nip='$nip'";
        $result = $this->Koneksi()->query($query);
        while ($obj = $result->fetch_object()) {
            $ar[] = $obj;
        }
        echo json_encode($ar);
    }
    public function Update($nip, $username, $password, $nama, $cek,$versi)
    {
        $tampung_pass = "";
        if($versi == "biasa"){
            $tampung_pass = $password;
        }else{
            $tampung_pass = md5($password);
        }
        if ($cek == "sama") {
            $query = "UPDATE dosen set username='$username', password='$tampung_pass', nama='$nama' where nip='$nip'";
            $exc = $this->Koneksi()->query($query);
            if ($exc == true) {
                echo "dosenupdatesuccess";
            } else {
                echo "dosenupdatefailed";
            }
        } else if ($cek == "tidaksama") {
            $dd2 = new Dosen();
            if ($dd2->UsernameCheck($username) == "oke") {
                $query = "UPDATE dosen set username='$username', password='$tampung_pass', nama='$nama' where nip='$nip'";
                $exc = $this->Koneksi()->query($query);
                if ($exc == true) {
                    echo "dosenupdatesuccess";
                } else {
                    echo "dosenupdatefailed";
                }
            } else if ($dd2->UsernameCheck($username) == "ada") {
                echo "usernamesama";
            } else {
                echo $dd2->UsernameCheck($username);
            }
        }
    }
    public function Delete($nip)
    {
        $query = "DELETE from dosen where nip='$nip'";
        $exc = $this->Koneksi()->query($query);
        if ($exc == true) {
            echo "dosendeletesuccess";
        } else {
            echo "dosendeletefailed";
        }
    }
}

$ds = new Dosen();
if (isset($_POST["readDosen"])) {
    $ds->read();
} else if (isset($_POST["deleteDosen"])) {
    $ds->Delete($_POST["nip"]);
} else if (isset($_POST["createDosen"])) {
    $ds->Create($_POST["nip"], $_POST["nama"], $_POST["username"], $_POST["password"]);
} else if (isset($_POST["readDosenParam"])) {
    $ds->readWithParam($_POST["nip2"]);
} else if (isset($_POST["updateDosen"])) {
    $ds->Update($_POST["nip"], $_POST["username"], $_POST["password"], $_POST["nama"], $_POST["cek"],$_POST["updateDosen"]);
}
