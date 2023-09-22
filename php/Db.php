<?php
header('Origin:xxx.com');
header('Access-Control-Allow-Origin:*');
class Db
{
    public function Koneksi()
    {
        // $con = new mysqli("localhost", "id14037207_absensi", "n/{f625WpdPsopPu", "id14037207_db_absensi");
        $con = new mysqli("localhost", "root", "", "db_siabsensi_1");
        if (!$con) {
            echo "onk seng salah nak koneksi dbne";
        } else {
            return $con;
        }
    }
}
