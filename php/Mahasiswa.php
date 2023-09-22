<?php
header('Origin:xxx.com');
header('Access-Control-Allow-Origin:*');
require 'Db.php';
class Mahasiswa extends Db
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


    public function Create($nim, $nama, $username, $password, $jurusan)
    {
        $dd = new Mahasiswa();
        if ($dd->UsernameCheck($username) == "oke") {
            $pass5 = md5($password);
            $query = "INSERT into mahasiswa (nim,nama,username,password,jurusan) values ('$nim','$nama','$username','$pass5','$jurusan')";
            $exc = $this->Koneksi()->query($query);
            if ($exc == true) {
                echo "mahasiswacreatesuccess";
            } else {
                echo "mahasiswacreatefailed";
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
        $query = "SELECT * from mahasiswa order by time_add";
        $result = $this->Koneksi()->query($query);
        while ($obj = $result->fetch_object()) {
            $ar[] = $obj;
        }
        echo json_encode($ar);
    }
    public function read2()
    {
        $ar = array();
        $query = "SELECT * from mahasiswa order by nim";
        $result = $this->Koneksi()->query($query);
        while ($obj = $result->fetch_object()) {
            $ar[] = $obj;
        }
        echo json_encode($ar);
    }
    public function readWithParam($nim)
    {
        $ar = array();
        $query = "SELECT * from mahasiswa where nim='$nim'";
        $result = $this->Koneksi()->query($query);
        while ($obj = $result->fetch_object()) {
            $ar[] = $obj;
        }
        echo json_encode($ar);
    }
    public function Update($nim, $username, $password, $nama, $jurusan, $cek, $versi)
    {
        $tampung_pass = "";
        if ($versi == "biasa") {
            $tampung_pass = $password;
        } else {
            $tampung_pass = md5($password);
        }
        if ($cek == "sama") {
            $query = "UPDATE mahasiswa set username='$username', password='$tampung_pass', nama='$nama', jurusan='$jurusan' where nim='$nim'";
            $exc = $this->Koneksi()->query($query);
            if ($exc == true) {
                echo "mahasiswaupdatesuccess";
            } else {
                echo "mahasiswaupdatefailed";
            }
        } else if ($cek == "tidaksama") {
            $dd2 = new Mahasiswa();
            if ($dd2->UsernameCheck($username) == "oke") {
                $query = "UPDATE mahasiswa set username='$username', password='$tampung_pass', nama='$nama', jurusan='$jurusan' where nim='$nim'";
                $exc = $this->Koneksi()->query($query);
                if ($exc == true) {
                    echo "mahasiswaupdatesuccess";
                } else {
                    echo "mahasiswaupdatefailed";
                }
            } else if ($dd2->UsernameCheck($username) == "ada") {
                echo "usernamesama";
            } else {
                echo $dd2->UsernameCheck($username);
            }
        }
    }
    public function Delete($nim)
    {
        $query = "DELETE FROM mahasiswa where nim='$nim'";
        $exc = $this->Koneksi()->query($query);
        if ($exc == true) {
            echo "mahasiswadeletesuccess";
        } else {
            echo "mahasiswadeletefailed";
        }
    }
}

$ds = new Mahasiswa();
if (isset($_POST["readMahasiswa"])) {
    $ds->read();
}else if (isset($_POST["readMahasiswa2"])) {
   $ds->read2();
} else if (isset($_POST["deleteMahasiswa"])) {
    $ds->Delete($_POST["nim"]);
} else if (isset($_POST["createMahasiswa"])) {
    $ds->Create($_POST["nim"], $_POST["nama"], $_POST["username"], $_POST["password"], $_POST["jurusan"]);
} else if (isset($_POST["readMahasiswaParam"])) {
    $ds->readWithParam($_POST["nim2"]);
} else if (isset($_POST["updateMahasiswa"])) {
    $ds->Update($_POST["nim"], $_POST["username"], $_POST["password"], $_POST["nama"],$_POST["jurusan"], $_POST["cek"], $_POST["updateMahasiswa"]);
}
