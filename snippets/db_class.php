<?php
class db{
	public function connect(){
		if(! $conn = new mysqli(DB_ADRESS,DB_USER,DB_PASS,DB_NAME))
			die ("<b>SERVER:</b> Could not connect to the database");
		else return $conn;
	}
	public function insert($table,$colls,$values){
		$conn = $this->connect();
		$sql = "INSERT INTO $table($colls) VALUES ($values)";
		if($conn->query($sql))
			return true;
		else
			return false;
	}
	public function select($table,$colls,$expression = '1'){
		$conn = $this->connect();
		$sql = "SELECT $colls FROM $table WHERE $expression";
		if($result = $conn -> query($sql))
			return $result->fetch_object();
		else
			return false;
	}
	public function update($table,$colls_values,$where){
		$conn = $this->connect();
		$sql = "UPDATE $table SET $colls_values WHERE $where";
		if($conn->query($sql))
			return true;
		else
			return false;
	}
	public function clean($array){
		$escaped_array = [];
		$conn = $this -> connect();
		foreach ($array as $key => $value) {
			if(is_array($value)){
				global $db;
				$escaped_array[$key] = $db->clean($value);
			}
			else
				$escaped_array[$key] = $conn->real_escape_string($value);
		}
		return $escaped_array;
	}
	public function hash_pass($password,$nonce){
		return $hashed_pass = hash_hmac('sha512', $password . $nonce, SITE_KEY);
	}
}
$db = new db;
?>