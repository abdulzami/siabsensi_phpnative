<?php
header('Origin:xxx.com');
header('Access-Control-Allow-Origin:*');
require 'Db.php';
class DosenMasuk extends Db
{
    public function cekAbsen($id_matkul, $waktu_masuk)
    {
        $ar = array();
        $query = "SELECT * from dosen_masuk where id_matkul='$id_matkul' and waktu_masuk='$waktu_masuk'";
        $result = $this->Koneksi()->query($query);
        while ($obj = $result->fetch_object()) {
            $ar[] = $obj;
        }

        if ($result->num_rows > 0) {
            return "ada";
        } else {
            return "tidakada";
        }
    }
    public function AbsenDosen($id_matkul, $status, $deskripsi, $longitude, $latitude)
    {
        
    }


}

$mk = new DosenMasuk();