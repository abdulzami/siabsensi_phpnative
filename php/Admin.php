<?php
header('Origin:xxx.com');
header('Access-Control-Allow-Origin:*');
require 'Db.php';
class Admin extends Db
{
    public function Create($username, $password)
    {
        $query = "INSERT into admin (username,password) values ($username,$password)";
        $exc = $this->Koneksi()->query($query);
        if ($exc == true) {
            echo "admincreatesuccess";
        } else {
            echo "admincreatefailed";
        }
    }
}
