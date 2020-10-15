<?php
define("servername", "localhost:3307");
define("username", "database");
define("password", "$37HP2a9_=Jt*%WR");
define("dbname", "motoblog");
class DB
{
	public static $conn = null;
	// Check connection errors
	public static function getConnection(){
		$conn = null;
		
		// Create connection
		if (self::$conn == null) {
			$conn = new mysqli(servername, username, password, dbname);
			if ($conn->connect_error) {
				die("Connection failed: " . $conn->connect_error);
			}
			self::$conn = $conn;
			
		} else {
			$conn = self::$conn;
		}
		return $conn;
	}
	public static function closeConnection()
	{
		self::$conn->close();
	}
	
	public static function query($sql)
	{
		$conn = DB::getConnection();
		$result = self::$conn->query($sql);
		
		if (!$result) {
			echo(self::$conn->error);
			return FALSE;
		}else {
			if($result !== TRUE){
				return $result->fetch_all(MYSQLI_ASSOC);
			}
		}
		return TRUE;
	}
}