<?php
header('Origin:xxx.com');
header('Access-Control-Allow-Origin:*');
require 'Db.php';
class MahasiswaMasuk extends Db
{
    public function cekDosenAbsen($id_matkul,$waktu_masuk)
    {
        $ar = array();
        $query = "SELECT * from dosen_masuk where id_matkul='$id_matkul' and waktu_masuk='$waktu_masuk'";
        $result = $this->Koneksi()->query($query);
        if ($result->num_rows > 0) {
            $obj = $result->fetch_object();
            if($obj->status == "izin"){
                return "izin";
            }else if($obj->status == "sakit") {
                return "sakit";
            }else if($obj->status == "masuk"){
                return "ada";
            }
        } else {
            return "tidakada";
        }
    }
    
    public function cekAbsen($id_matkul,$waktu_masuk,$nim)
    {
        $mk = new MahasiswaMasuk();
        if($mk->cekDosenAbsen($id_matkul,$waktu_masuk) == "tidakada"){
           echo "dosenbelummasuk";
        }else if($mk->cekDosenAbsen($id_matkul,$waktu_masuk) == "ada"){
            $query = "SELECT * from mahasiswa_masuk where id_matkul='$id_matkul' and waktu_masuk='$waktu_masuk' and nim='$nim'";
            $result = $this->Koneksi()->query($query);
            if ($result->num_rows > 0) {
                echo "ada";
            } else {
                echo "tidakada";
            }   
        }else if($mk->cekDosenAbsen($id_matkul,$waktu_masuk) == "sakit"){
            echo "dosensakit";
        }else if($mk->cekDosenAbsen($id_matkul,$waktu_masuk) == "izin"){
            echo "dosenizin";
        }else{
            echo $mk->cekDosenAbsen($id_matkul,$waktu_masuk);
        }
       
    }
    
    
    public function masukAbsen($id_matkul,$nim,$waktumasuk,$status,$deskripsi,$longitude,$latitude,$mode)
    {
        $query = "INSERT into mahasiswa_masuk (id_matkul,nim,waktu_masuk,status,deskripsi,latitude,longitude,mode) values ('$id_matkul','$nim','$waktumasuk','$status','$deskripsi','$longitude','$latitude','$mode')";
            $exc = $this->Koneksi()->query($query);
            if ($exc == true) {
                echo "mahasiswaabsensuccess";
            } else {
                echo "mahasiswaabsenfailed";
            }      
    }

    public function readForAbsensi($nim,$hari)
    {
        $ar = array();
        $query = "SELECT a.id_krs,a.nim,a.id_matkul,b.nama_matkul,b.hari,b.mulai_jam,b.akhir_jam,b.nip,d.nama FROM krs a join matkul b on a.id_matkul = b.id_matkul join dosen d on b.nip = d.nip where b.hari = '$hari' and a.nim = '$nim' order by b.mulai_jam ";
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
}

$mk = new MahasiswaMasuk();
if(isset($_POST["cekAbsen"])){
    $mk->cekAbsen($_POST["id_matkul"],$_POST["waktu_masuk"],$_POST["nim"]);
}else if(isset($_POST["masukAbsen"])){
    $mk->masukAbsen($_POST["id_matkul"],$_POST["nim"],$_POST["waktumasuk"],$_POST["status"],$_POST["deskripsi"],$_POST["longitude"],$_POST["latitude"],$_POST["mode"]);
}else if(isset($_POST["readAbsen"])){
    $mk->readForAbsensi($_POST["nim"],$_POST["hari"]);
}