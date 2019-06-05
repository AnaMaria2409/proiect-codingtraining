<?php
	class dboperations{
		public $servername = "localhost";
		public $username = "root";
		public $password = "";
		public $dbName = "proiect"; 
		public $conn;
		function __construct(){
			$this->createConnection();
		}
		function createConnection(){
			$this->conn = mysqli_connect($this->servername, $this->username, $this->password,$this->dbName);
			if (!$this->conn) {
				die("Connection failed: " . mysqli_connect_error());
			}
		}
		public function validateToken($token_parameter){
			$sql =  "SELECT continut FROM token";
			$result = mysqli_query($this->conn,$sql);
			$resultCheck = mysqli_num_rows($result);
			if($resultCheck>0){
				while($row = mysqli_fetch_assoc($result)){
					if($row['continut']==$token_parameter) return 1;
				}
				return 0;
			}
		}
		public function getId($username_parameter){
			$stmt = $this->conn->prepare("SELECT id from utilizatori where username=?");
			$stmt->bind_param("s", $username_parameter);
			$stmt->execute();
			$result = $stmt->get_result();
			if($result->num_rows > 0){
				while($row = $result->fetch_assoc()){
					return $row['id'];
				}
				return 0;
			}
		}
			public function getIdFromToken($token){
			$stmt = $this->conn->prepare("SELECT id_user from token where continut=?");
			$stmt->bind_param("s", $token);
			$stmt->execute();
			$result = $stmt->get_result();
			if($result->num_rows > 0){
				while($row = $result->fetch_assoc()){
					return $row['id_user'];
				}
				return 0;
			}
		}
		public function getUsernameFromToken($token){
			$id=$this->getIdFromToken($token);
			$stmt = $this->conn->prepare("SELECT username from utilizatori where id=?");
			$stmt->bind_param("i", $id);
			$stmt->execute();
			$result = $stmt->get_result();
			if($result->num_rows > 0){
				while($row = $result->fetch_assoc()){
					return $row['username'];
				}
				return 0;
			}
		}
		public function getEmailFromToken($token){
			$id=$this->getIdFromToken($token);
			$stmt = $this->conn->prepare("SELECT email from utilizatori where id=?");
			$stmt->bind_param("i", $id);
			$stmt->execute();
			$result = $stmt->get_result();
			if($result->num_rows > 0){
				while($row = $result->fetch_assoc()){
					return $row['email'];
				}
				return 0;
			}
		}

		public function getNameFromId($id){
			$stmt = $this->conn->prepare("SELECT username from utilizatori where id=?");
			$stmt->bind_param("i", $id);
			$stmt->execute();
			$result = $stmt->get_result();
			if($result->num_rows > 0){
				while($row = $result->fetch_assoc()){
					return $row['username'];
				}
				return 0;
			}

		}
		public function checkAnswerExistence($id_user,$question_id){
			$response=0;
			$stmt = mysqli_prepare($this->conn, "SELECT id from raspunsuri where id_user=? and id_intrebare=?"); 
			mysqli_stmt_bind_param($stmt, 'ii', $id_user,$question_id);
			mysqli_stmt_execute($stmt);

			while(mysqli_stmt_fetch($stmt)){
				$response=1;
			}

			$stmt = mysqli_prepare($this->conn, "SELECT id_user from intrebari where id=?"); 
			mysqli_stmt_bind_param($stmt, 'i', $question_id);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_bind_result($stmt,$result);
			while(mysqli_stmt_fetch($stmt)){
				if($result == $id_user)
				         $response=2;
			}

			mysqli_stmt_close($stmt);			
			return $response;
		}


		public function counterAdded($token){

			$id = $this->getIdFromToken($token);
			$stmt = mysqli_prepare($this->conn, "SELECT * from intrebari where id_user=?"); 
			mysqli_stmt_bind_param($stmt, 'i', $id);
			mysqli_stmt_execute($stmt);
			$counter=0; 
				while(mysqli_stmt_fetch($stmt)){
					$counter++;
				}
				mysqli_stmt_close($stmt);
				return $counter;
			
		}



		public function validateAndAddToken($username_parameter,$token_parameter){
			$id_user=$this->getId($username_parameter);
			if (filter_var($id_user, FILTER_VALIDATE_INT) === false) {
				echo 'Incorrect id';
			 }
			 
			if($this->validateToken($token_parameter)==1){
				echo "";}
			else
			{
				$stmt = mysqli_prepare($this->conn, "INSERT INTO token (id_user,continut) VALUES (?,?)"); 
        mysqli_stmt_bind_param($stmt, 'is', $id_user,$token_parameter);
				mysqli_stmt_execute($stmt);
				mysqli_stmt_close($stmt);
			}
		}


		public function validateAndDeleteToken($token_parameter){
			if($this->validateToken($token_parameter)==0){
				echo "Token doesn't exist";
			}else{
				$sql = "delete from token where continut='$token_parameter'";
				if(mysqli_query($this->conn,$sql)) echo "";
				else echo "Error: " . $sql . "<br>" . mysqli_error($this->conn);
			}
		}


	 public function verifyUsername($username){
         $check = false;
				 $stmt = mysqli_prepare($this->conn, "SELECT id from utilizatori where username = ?"); 
				 mysqli_stmt_bind_param($stmt, 's', $username);
				 mysqli_stmt_execute($stmt);
				 $stmt->store_result();
					 if($stmt -> num_rows > 0)
										$check=true;
        return $check;
        }


  public function register($username, $password, $email){
         if($this->verifyUsername($username) === true){
					 return 2;
         }
         else{
					$email = filter_var($email, FILTER_SANITIZE_EMAIL);
					if (filter_var($email, FILTER_VALIDATE_EMAIL) === false  || ctype_space($username) === true ) {
							return 2;
					} else {
					$tip='normal';
					$stmt = mysqli_prepare($this->conn, "INSERT INTO utilizatori (username, email, tip, parola) VALUES (?,?,?,?)"); 
					mysqli_stmt_bind_param($stmt, 'ssss', $username,$email,$tip,$password);
					mysqli_stmt_execute($stmt);
					mysqli_stmt_close($stmt);
					return 1;
				 }
				 return 0;
        }
     }
	}

?>
