<?php
/**
 * Eniad Application Framework
 * A small, lightweight framework usable for very very small web apps
 * 
 * Database class
 * Handles the database connection. Only supports mysql as of now.
 * 
 * @author Daine Trinidad <daine@compilesource.com>
 * @copyright Daine Trinidad 2011
 * @access public
 * @since July 4, 2011
 * 
 */
class Database{
	private $database;
	private $statement;
	public static $me;
	private $logger;
	
	/**
	 * 
	 * Database constructor
	 * @param $dbname Database name
	 * @param $host Host address (i.e. localhost, db.mysite.com)
	 * @param $db_user Database User
	 * @param $db_pass Database Password
	 */
    public function __construct($dbname, $host, $db_user, $db_pass){
    	try{
    		$this->database = new PDO("mysql:dbname=$dbname;host=$host", $db_user, $db_pass);
    		$this->logger = new Logger("naughtymobi-sql.log");
    	}catch(PDOException $e){
    		echo $e->getMessage();
    	}
    }
    
    /**
     * 
     * Insert data into database
     * @param $statement Example: INSERT INTO users (name, ip) VALUES (:name, :ip)
     * @param $data Example: array(':name'=>'Daine', ':ip'=>'192.168.1.1')
     */
	public function insert($statement, $data){
    	$this->statement = $this->database->prepare($statement);
    	$this->statement->execute($data);
    	return $this->statement->errorInfo();
    }
    
    /**
     * 
     * Update data in database
     * @param $statement Example: UPDATE users SET name=?, ip=? WHERE id=?
     * @param $data Example: array('Daine','192.168.1.1','2')
     */
	public function update($statement, $data){
    	$this->statement = $this->database->prepare($statement);
    	$this->statement->execute($data);
    	return $this->statement->errorInfo();
    }
    
    /**
     * 
     * Delete data in database
     * @param $statement Example: DELETE FROM users WHERE id=?
     * @param $data Example: array('2')
     */
	public function delete($statement, $data){
    	$this->statement = $this->database->prepare($statement);
    	$this->statement->execute($data);
    	return $this->statement->errorInfo();
    }
    
    /**
     * 
     * Select and return a query
     * @param $statement
     */    
    public function select($statement, $data){
    	$this->statement = $this->database->prepare($statement);
    	$this->statement->execute($data);
    	return $this->statement->fetchAll();
    }
    
    /**
     * 
     * Use this method if you need to reinstantiate the database
     */
    public function getDatabase(){
    	$config = new Config(APP_INI);
    	if(is_null(self::$me))
    		self::$me = new Database($config->settings['database']['name'], $config->settings['database']['host'], $config->settings['database']['username'], $config->settings['database']['password']);
        return self::$me;
    }
}