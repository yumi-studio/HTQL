<?php
class DB{
    private static $instance = NULL;

    public static function getInstance(){
        if(!isset(self::$instance)){
            try{
                self::$instance = new PDO("sqlsrv:server=DESKTOP-L0RGUBJ\DUYSV08 ; Database=htql", "sa", "123");
                self::$instance->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
            }catch(PDOException $e){
                die("Lỗi: ".$e->getMessage());
            }
        }
        return self::$instance;
    }
}
?>