<?php 

class Model_Core_Adapter{
	public $servername = "localhost";
	public $username = "root";
	public $password = "";
	public $dbname = "project-sarvesh-gupta";

	public function connect(){
		$connect = mysqli_connect($this->servername,$this->username,$this->password,$this->dbname);
		if(!$connect){
			throw new Exception("Connection not done....", 1);	
		}
		return $connect ;
	}

	public function query($query){
		$sql = $this->connect();
		return $sql->query($query);
	}

	public function insert($sql)
	{
		 $connect = $this->connect();
		 $result = $connect->query($sql);
		 return $connect->insert_id;
	}
	public function delete($sql)
	{
		 $connect = $this->connect();
		 $result = $connect->query($sql);
		 return $result;
	}
	public function update($query){
		$result = $this->query($query);
		if(!$result){
			throw new Exception("updation of row not sucess");
		}
		return $result;
	}
	public function fetchRow($sql)
	{
		 $connect = $this->connect();
		 $result = $connect->query($sql);
		 return $result->fetch_assoc();
	}
	public function fetchAll($sql)
	{
		 $connect = $this->connect();
		 $result = $connect->query($sql);
		 return $result->fetch_all(MYSQLI_ASSOC);
	}
		

	public function fetchPairs($sql)
	{	
		$result = $this->query($sql);
		$data = $result->fetch_all();
		$column1 = array_column($data, '0');
		$column2 = array_column($data, '1');
		if(!$column2){
			$column2 = array_fill(0, count($column1), null);
		}
		return array_combine($column1, $column2);
	}
}
?>