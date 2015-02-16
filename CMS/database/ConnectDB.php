<?php

namespace CMS\Database;


class ConnectDB {

    protected static $_instance;
    protected $PDO;
    protected $ErrorMessage;


	public static function getInstance(){
        if(!self::$_instance){
            self::$_instance = new ConnectDB();
        }
        return self::$_instance;
	}

	private function __construct(){
        $this->SetPDO();
	}

    private function __clone(){}

	protected function GetAccessString(){
		require_once '/CMS/database/config.php';

        return DATABASE_DRIVER.':'.
        'host='.DATABASE_HOST.';'.
        'dbname='.DATABASE_NAME.','.
        DATABASE_USERNAME.','.
        DATABASE_PASSWORD;
	}

    protected function SetPDO(){
        try{
            $this->PDO = new \PDO($this->GetAccessString());
        }
        catch(\PDOException $e){
            $this->ErrorMessage = $e->getMessage();
        }
    }

    public function getErrorMessage(){
        return $this->ErrorMessage;
    }

    public function getPDO(){
        return $this->PDO;
    }
}