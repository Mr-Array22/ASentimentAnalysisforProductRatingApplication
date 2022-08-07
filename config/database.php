<?php

class Database{
 
    public static function connect(){

        $db = new mysqli('localhost', 'root', '', 'php_mvc');
        $db->query("SET NAMES 'utf8'");

        return $db;
    }
}

?>