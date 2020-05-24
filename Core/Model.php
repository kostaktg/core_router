<?php

namespace Core;
use \PDO;

 class Model{
    protected $dbh, $stmt, $error;
    private static $Instance;


    public function __construct(){
            // Set Options

            $options = array(
                PDO::ATTR_PERSISTENT     => true,
                PDO::ATTR_ERRMODE        => PDO::ERRMODE_EXCEPTION
            );

            try{

            // ---------------- PDO connection -------------------  
                 $this->dbh = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PASSWORD, $options);
             } catch(PDOEception $e){
                 $this->error = $e->getMessage();
            }



    }


    // ----------- INSTANCE ------------------
    public static function getInstance() {
		if(empty(self::$Instance)) {
			try {
				self::$Instance = new Model();
			} 
			catch (PDOException $e) {
				error_log( $e->getMessage() );
				header('HTTP/1.1 503 Service Temporarily Unavailable');
				header('Status: 503 Service Temporarily Unavailable');
				header('Retry-After: 300');
				exit;
			}
		}  
		return self::$Instance;
	}


public function get_error(){
    return  $this->error;
}
    // -------------  Query  ------------
 public function query($query){
    $this->stmt = $this->dbh->prepare($query);
}

// Where 
    public function bind($param, $value, $type = null){
        if(is_null($type)){
            switch(true){
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;

                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                
                default:
                    $type = PDO::PARAM_STR;
            }
        }

        $this->stmt->bindValue($param, $value,$type);
    }

    public function execute(){
        return  $this->stmt->execute();
       }


       // ASSOC Array
    public function resultset($param = PDO::FETCH_ASSOC){
        $this->execute();
         return $this->stmt->fetchAll($param);
     }

}