<?php
header('Origin:xxx.com');
header('Access-Control-Allow-Origin:*');
require 'Db.php';
class Matkul extends Db
{
    public function Create($id_matkul, $nama_matkul, $hari, $mulai, $akhir,$jurusan, $nip, $jumlah_pertemuan)
    {
        $query = "INSERT into matkul (id_matkul,nama_matkul,hari,mulai_jam,akhir_jam,jurusan,nip,jumlah_pertemuan) 
        values 
        ('$id_matkul','$nama_matkul','$hari','$mulai','$akhir','$jurusan','$nip','$jumlah_pertemuan')";
        $exc = $this->Koneksi()->query($query);
        if ($exc == true) {
            echo "matkulcreatesuccess";
        } else {
            echo "matkulcreatefailed";
        }
    }
    public function read()
    {
        $ar = array();
        $query = "SELECT * from matkul a,dosen b where a.nip = b.nip order by a.time_add";
        $result = $this->Koneksi()->query($query);
        while ($obj = $result->fetch_object()) {
            $ar[] = $obj;
        }
        echo json_encode($ar);
    }
    public function read2()
    {
        $ar = array();
        $query = "SELECT * from matkul order by id_matkul";
        $result = $this->Koneksi()->query($query);
        while ($obj = $result->fetch_object()) {
            $ar[] = $obj;
        }
        echo json_encode($ar);
    }
    public function readWithParam($id_matkul)
    {
        $ar = array();
        $query = "SELECT * from matkul where id_matkul='$id_matkul'";
        $result = $this->Koneksi()->query($query);
        while ($obj = $result->fetch_object()) {
            $ar[] = $obj;
        }
        echo json_encode($ar);
    }
    
    public function readForAbsensi($nip,$hari)
    {
        $ar = array();
        $query = "SELECT * from matkul where nip='$nip' and hari='$hari' order by mulai_jam";
        $result = $this->Koneksi()->query($query);
        while ($obj = $result->fetch_object()) {
            $ar[] = $obj;
        }
        
        if($result->num_rows > 0){
            echo json_encode($ar);
        }else{
            $arr = array('st' => 'kosong');
            echo json_encode($arr);
        }
        
    }
    
     public function readMatkulKu($nip)
    {
        $ar = array();
        $query = "SELECT * from matkul where nip='$nip'";
        $result = $this->Koneksi()->query($query);
        while ($obj = $result->fetch_object()) {
            $ar[] = $obj;
        }
        
        if($result->num_rows > 0){
            echo json_encode($ar);
        }else{
            $arr = array('st' => 'kosong');
            echo json_encode($arr);
        }
        
    }
    
    public function Update($id_matkul, $nama_matkul, $hari, $mulai, $akhir)
    {
        $query = "UPDATE matkul set nama_matkul='$nama_matkul', hari='$hari', mulai_jam='$mulai', akhir_jam='$akhir' where id_matkul='$id_matkul'";
        $exc = $this->Koneksi()->query($query);
        if ($exc == true) {
            echo "matkulupdatesuccess";
        } else {
            echo "matkulupdatefailed";
        }
    }
    public function Delete($id_matkul)
    {
        $query = "DELETE from matkul where id_matkul='$id_matkul'";
        $exc = $this->Koneksi()->query($query);
        if ($exc == true) {
            echo "matkuldeletesuccess";
        } else {
            echo "matkuldeletefailed";
        }
    }
}

$mk = new Matkul();
if (isset($_POST["readMatkul"])) {
    $mk->read();
}else if (isset($_POST["readMatkulKu"])) {
    $mk->readMatkulKu($_POST["nip"]);
}else if (isset($_POST["readMatkul2"])) {
    $mk->read2();
} else if (isset($_POST["deleteMatkul"])) {
    $mk->Delete($_POST["id_matkul"]);
} else if (isset($_POST["createMatkul"])) {
    $mk->Create($_POST["id_matkul"], $_POST["nama_matkul"], $_POST["hari"], $_POST["mulai"], $_POST["akhir"], $_POST["jurusan"], $_POST["nip"], $_POST["jumlah_pertemuan"]);
} else if (isset($_POST["readMatkulParam"])) {
    $mk->readWithParam($_POST["id_matkul"]);
} else if (isset($_POST["updateMatkul"])) {
    $mk->Update($_POST["id_matkul"], $_POST["nama_matkul"], $_POST["hari"], $_POST["mulai"], $_POST["akhir"]);
}else if(isset($_POST["readAbsen"])){
    $mk->readForAbsensi($_POST["nip"],$_POST["hari"]);
}
