<?php
header('Origin:xxx.com');
header('Access-Control-Allow-Origin:*');
require 'Db.php';
class LaporanMahasiswa extends Db
{
    public function read()
    {
        $ar = array();
        $query = "select a.id_matkul,c.nama_matkul,count(*) as total_mahasiswa_masuk,b.jumlah_mahasiswa,a.waktu_masuk from mahasiswa_masuk a join (select id_matkul,count(*) as jumlah_mahasiswa from krs GROUP by id_matkul) b on a.id_matkul = b.id_matkul join matkul c on a.id_matkul = c.id_matkul group by a.waktu_masuk,a.id_matkul order by a.waktu_masuk" ;
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

$ds = new LaporanMahasiswa();
if (isset($_POST["readLaporan"])) {
    $ds->read();
}