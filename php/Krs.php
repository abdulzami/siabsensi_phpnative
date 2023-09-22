<?php
header('Origin:xxx.com');
header('Access-Control-Allow-Origin:*');
require 'Db.php';
class Krs extends Db
{
    public function KrsCheck($id_matkul, $nim)
    {
        $query = "SELECT * from krs where id_matkul='$id_matkul' and nim = '$nim'";
        $result = $this->Koneksi()->query($query);
        $numRows = $result->num_rows;
        if ($numRows > 0) {
            return "ada";
        } else {
            return "oke";
        }
    }

    public function Create($id_krs, $nim, $id_matkul)
    {
        $dd = new Krs();
        if ($dd->KrsCheck($id_matkul, $nim) == "oke") {
            $query = "INSERT into krs (id_krs,nim,id_matkul) values ('$id_krs','$nim','$id_matkul')";
            $exc = $this->Koneksi()->query($query);
            if ($exc == true) {
                echo "krscreatesuccess";
            } else {
                echo "krscreatefailed";
            }
        } else if ($dd->KrsCheck($id_matkul, $nim) == "ada") {
            echo "krsada";
        } else {
            echo $dd->KrsCheck($id_matkul, $nim);
        }
    }
    public function read()
    {
        $ar = array();
        $query = "SELECT a.id_krs,a.id_matkul,a.nim,b.nama_matkul,c.nama from krs a,matkul b,mahasiswa c where a.id_matkul = b.id_matkul and c.nim = a.nim order by a.time_add";
        $result = $this->Koneksi()->query($query);
        while ($obj = $result->fetch_object()) {
            $ar[] = $obj;
        }
        echo json_encode($ar);
    }
    public function readWithParam($id_krs)
    {
        $ar = array();
        $query = "SELECT a.id_krs,a.id_matkul,a.nim,b.nama_matkul,c.nama from krs a,matkul b,mahasiswa c where a.id_matkul = b.id_matkul and c.nim = a.nim and id_krs = '$id_krs' order by a.time_add";
        $result = $this->Koneksi()->query($query);
        while ($obj = $result->fetch_object()) {
            $ar[] = $obj;
        }
        echo json_encode($ar);
    }
    public function Update($id_krs, $nim, $id_matkul,$cek)
    {
        if($cek == "lolos"){
            $dd = new Krs();
            if ($dd->KrsCheck($id_matkul, $nim) == "oke") {
                $query = "UPDATE krs set nim = '$nim', id_matkul='$id_matkul' where id_krs = '$id_krs'";
                $exc = $this->Koneksi()->query($query);
                if ($exc == true) {
                    echo "krsupdatesuccess";
                } else {
                    echo "krsupdatefailed";
                }
            } else if ($dd->KrsCheck($id_matkul, $nim) == "ada") {
                echo "krsada";
            } else {
                echo $dd->KrsCheck($id_matkul, $nim);
            }
        }else{
            echo "krsupdatesuccess";
        }
        
    }
    public function Delete($id_krs)
    {
        $query = "DELETE from krs where id_krs='$id_krs'";
        $exc = $this->Koneksi()->query($query);
        if ($exc == true) {
            echo "krsdeletesuccess";
        } else {
            echo "krsdeletefailed";
        }
    }
}

$ds = new Krs();
if (isset($_POST["readKrs"])) {
    $ds->read();
} else if (isset($_POST["deleteKrs"])) {
    $ds->Delete($_POST["id_krs"]);
} else if (isset($_POST["createKrs"])) {
    $ds->Create($_POST["id_krs"], $_POST["nim"], $_POST["id_matkul"]);
} else if (isset($_POST["readKrsParam"])) {
    $ds->readWithParam($_POST["id_krs"]);
} else if (isset($_POST["updateKrs"])) {
    $ds->Update($_POST["id_krs"], $_POST["nim"], $_POST["id_matkul"],$_POST["cek"]);
}
