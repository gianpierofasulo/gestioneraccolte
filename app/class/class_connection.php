<?php


//function connessione_db() {
//            // CONNESSIONE AL DB
//            $host = 'localhost';
//            $db   = 'microhard';
//            $user = 'root';
//            $pass = '';
//            $port = "3306";
//            $charset = 'utf8mb4';
//
//            $options = [
//                \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
//                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
//                \PDO::ATTR_EMULATE_PREPARES   => false,
//            ];
//                $connessione = "mysql:host=$host;dbname=$db;charset=$charset;port=$port";
//
//                try {
//                     $pdo = new \PDO($connessione, $user, $pass, $options);
//                } catch (\PDOException $e) {
//                     throw new \PDOException($e->getMessage(), (int)$e->getCode());
//                }
//                return $pdo;
//    
//}

// Define database configuration
	define("DB_HOST", "localhost");
	define("DB_USER", "root");
	define("DB_PASS", "");
	define("DB_NAME", "avisraccolta");

	class Database{
		private $host      = DB_HOST;
		private $user      = DB_USER;
		private $pass      = DB_PASS;
		private $dbname    = DB_NAME;
		private $dbh;
		private $error;
		private $stmt;
	 
		public function __construct(){
			// Set DSN
			$dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;
			// Set options
			$options = array(
				PDO::ATTR_PERSISTENT    => true,
				PDO::ATTR_ERRMODE       => PDO::ERRMODE_EXCEPTION
			);
			// Create a new PDO instanace
			try{
				$this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
			}
			// Catch any errors
			catch(PDOException $e){
				$this->error = $e->getMessage();
			}
		}
		
		public function query($query){
			$this->stmt = $this->dbh->prepare($query);
		}
		public function bind($param, $value, $type = null){
			if (is_null($type)) {
				switch (true) {
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
			$this->stmt->bindValue($param, $value, $type);
		}
		public function execute(){
			return $this->stmt->execute();
		}    
		
		public function resultset(){
			$this->execute();
			return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
		}
		
		public function single(){
			$this->execute();
			return $this->stmt->fetch(PDO::FETCH_ASSOC);
		}
		
		public function rowCount(){
			return $this->stmt->rowCount();
		}
		
		public function lastInsertId(){
			return $this->dbh->lastInsertId();
		}
		
		public function beginTransaction(){
			return $this->dbh->beginTransaction();
		}
		
		public function endTransaction(){
			return $this->dbh->commit();
		}
		
		public function cancelTransaction(){
			return $this->dbh->rollBack();
		}
		
		public function debugDumpParams(){
			return $this->stmt->debugDumpParams();
		}
                
                public function getError(){
			return $this->stmt->errorInfo();
		}
                
                public function getErrorCode(){
			return $this->stmt->errorInfo[1];
		}
		
		public function close(){
		  $this->dbh = null;
		}
	}
