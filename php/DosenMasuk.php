<?php
header('Origin:xxx.com');
header('Access-Control-Allow-Origin:*');
require 'Db.php';
class DosenMasuk extends Db
{
    public function lihatStatus($id_matkul,$waktu_masuk)
    {
        $ar = array();
        $query = "SELECT deskripsi,mode from dosen_masuk where id_matkul='$id_matkul' and waktu_masuk='$waktu_masuk'";
        $result = $this->Koneksi()->query($query);
        if ($result->num_rows > 0) {
            $obj = $result->fetch_object();
            echo json_encode($obj);
        } else {
            echo "tidakada";
        }
    }
    
     public function cekAbsen($id_matkul,$waktu_masuk)
    {
        $query = "SELECT * from dosen_masuk where id_matkul='$id_matkul' and waktu_masuk='$waktu_masuk'";
        $result = $this->Koneksi()->query($query);
        if ($result->num_rows > 0) {
            echo "ada";
        } else {
            echo "tidakada";
        }
    }
    
    public function masukAbsen($id_matkul,$waktumasuk,$status,$deskripsi,$longitude,$latitude,$mode)
    {
        $query = "INSERT into dosen_masuk (id_matkul,waktu_masuk,status,deskripsi,latitude,longitude,mode) values ('$id_matkul','$waktumasuk','$status','$deskripsi','$longitude','$latitude','$mode')";
            $exc = $this->Koneksi()->query($query);
            if ($exc == true) {
                if($status == "masuk"){
                    $query2 = "UPDATE matkul set jumlah_pertemuan = jumlah_pertemuan - 1 where id_matkul = '$id_matkul'";
                    $exc2 = $this->Koneksi()->query($query2);
                    if($exc2 = true){
                        echo "dosenabsensuccess";    
                    }else{
                        echo "dosenabsenfailed";
                    }
                }else{
                    echo "dosenabsensuccesstanpa";  
                }
                
                
            } else {
                echo "dosenabsenfailed";
            }      
    }


}

$mk = new DosenMasuk();
if(isset($_POST["cekAbsen"])){
    $mk->cekAbsen($_POST["id_matkul"],$_POST["waktu_masuk"]);
}else if(isset($_POST["masukAbsen"])){
    $mk->masukAbsen($_POST["id_matkul"],$_POST["waktumasuk"],$_POST["status"],$_POST["deskripsi"],$_POST["longitude"],$_POST["latitude"],$_POST["mode"]);
}else if(isset($_POST["lihatStatus"])){
    $mk->lihatStatus($_POST["id_matkul"],$_POST["waktu_masuk"]);
}