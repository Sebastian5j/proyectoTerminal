<?php

class dbConnection
{
	private $dbHost;
	private $user;
	private $pass;
	private $dbName;
	private $conn;
	public function __construct($dbHost, $user, $pass, $dbName)
	{
		$this->dbHost = $dbHost;
		$this->user = $user;
		$this->pass = $pass;
		$this->dbName = $dbName;
	}
	public function connect()
	{
		$this->conn = new mysqli($this->dbHost, $this->user, $this->pass, $this->dbName);
		if(($this->conn)->connect_error)
		{
			die("Connection failed %s\n".$this->conn->connect_error."\n");
		}
			
	}

	public function execute($query)
	{
		$result = mysqli_query($this->conn,$query);
		if(!$result)
		{
			die( "Error---- ".$query." ".($this->conn)->error."\n");
		}
		return $result;
	}
	public function disconnect()
	{
		$this->conn->close();
	}
}

//ejemplo
$db = new dbConnection("localhost","root","password","mydb");
/*
$db->connect();

$db->execute("insert into users(nombre, password) values('alejandra2','algo')");
$db->execute("insert into users(nombre, password) values('alejandra3','algo')");
$db->disconnect();
$result = $db->execute("select * from ugsers;");
while($row = $result->fetch_assoc())
{
	echo $row["nombre"]." ".$row["password"]."\n";
	//echo $row["password"];
}
$db->disconnect();
*/
?>
