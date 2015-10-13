<?php

class DALBase{
    private static $UserN = "lw222gz";
    private static $passW = "lw222gz";
    private static $severN = "127.0.0.1";
    private static $dbName = "A_Shitty_Monday";
    private static $port = 3306;
    
    private $SQLconn;
    
    public function __construct(){
        date_default_timezone_set('Europe/Stockholm');
    }
    
    //returns new SQL Connection
    public function getSQLConn(){
        $this -> SQLconn = mysqli_connect(self::$severN, self::$UserN, self::$passW, self::$dbName, self::$port);
        
        if($this -> SQLconn -> connect_error){
            die("Connection failed". $this -> SQLconn -> connect_error);
        }

        return $this -> SQLconn;
    }
    
    
}