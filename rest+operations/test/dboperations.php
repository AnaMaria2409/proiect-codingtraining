<?php
	class dboperations{
		public $servername = "localhost";
		public $username = "root";
		public $password = "";
		public $dbName = "test_database"; 
		public $conn;

		function __construct(){
			
		}

		function createConnection(){
			$this->conn = mysqli_connect($this->servername, $this->username, $this->password,$this->dbName);
			// Check connection
			if (!$this->conn) {
				die("Connection failed: " . mysqli_connect_error());
			}
			else echo "Connected successfully \n";
		}
		public function validateToken($token_parameter){
			$sql =  "SELECT token FROM tokens";
			$result = mysqli_query($this->conn,$sql);
			$resultCheck = mysqli_num_rows($result);
			if($resultCheck > 0 ){
				while($row = mysqli_fetch_assoc($result)){
					if($row['token']==$token_parameter) return 1;
				}
				return 0;
			}
		}
		public function validateAndAddToken($username_parameter,$token_parameter){
			if($this->validateToken($token_parameter)==1){
				echo "Token already exists";
			}else{
				$sql = "INSERT INTO tokens (username,token) VALUES ('$username_parameter','$token_parameter')";
				if(mysqli_query($this->conn,$sql)) echo "token succesfully added !";
				else echo "Error: " . $sql . "<br>" . mysqli_error($this->conn);
			}
		}
		public function validateAndDeleteToken($token_parameter){
			if($this->validateToken($token_parameter)==0){
				echo "Token doesn't exist";
			}else{
				$sql = "delete from tokens where token=$token_parameter";
				if(mysqli_query($this->conn,$sql)) echo "token succesfully removed !";
				else echo "Error: " . $sql . "<br>" . mysqli_error($this->conn);
			}
		}

	}
	
	$dataBase = new dboperations();
	$dataBase->createConnection();

	//$dataBase->validateAndAddToken('wefwe12312312312312312fws','152433');
	$dataBase->validateAndDeleteToken("15243");
?>