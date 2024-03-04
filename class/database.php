<?php 
class Database extends PDO{
    
    public function __construct() {
        try{
            parent::__construct('mysql:host=localhost;dbname=db;charset=utf8' ,'root','');
            parent::setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }   catch (Exception $ex) {
            die('Error con la conexion ');
        }
    }
}

?>
