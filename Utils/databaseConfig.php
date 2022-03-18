<?php 
require_once('crud.php');
require_once('constants.php');

class DatabaseConfig{

	private static $instances = [];
	private $connection=null;
	private $crud=null;
	 
	protected function __construct() { 	
		$this->crud=new Crud;
		$this->connection=mysqli_connect(Constants::$HOSTNAME,Constants::$USERNAME,Constants::$PASSWORD,Constants::$DATABASE) or die("Error".mysqli_error());	
	}

    protected function __clone() { }

    public function __wakeup()
    {
        throw new \Exception("Cannot unserialize a singleton.");
    }
	
	public static function getInstance(): DatabaseConfig
	{
		
        $cls = static::class;
        if (!isset(self::$instances[$cls])) {
            self::$instances[$cls] = new static();
        }

        return self::$instances[$cls];
    }

	public function query($query)
	{
		return mysqli_query($this->connection,$query)?true:false;
	}

	public function isConnected(){
		return $this->connection ? true : false; 
	}

	public function getConnection(){
		return $this->connection;
	}
	

	function getdata($datalist, $tablename, $condition, $order){
		return $this->crud->getdata($this->connection, $datalist, $tablename, $condition, $order);
	}

	function adddata($tablename, $datalist){
		return $this->crud->adddata($this->connection, $tablename, $datalist);
	}

	function updatedata($tablename, $datalist, $condition){
		return $this->crud->updatedata($this->connection, $tablename, $datalist,$condition);
	}

	function deletedata($tablename, $condition){
		return $this->crud->deletedata($this->connection, $tablename, $condition);
	}
}

?>