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
			$sql="SELECT id from utilizatori where username='$username_parameter'";
			$result = mysqli_query($this->conn,$sql);
			$resultCheck = mysqli_num_rows($result);
			if($resultCheck>0){
				while($row = mysqli_fetch_assoc($result)){
					return $row['id'];
				}
				return 0;
			}
		}
			public function getIdFromToken($token){
			$sql="SELECT id_user from token where continut='$token'";
			$result = mysqli_query($this->conn,$sql);
			$resultCheck = mysqli_num_rows($result);
			if($resultCheck>0){
				while($row = mysqli_fetch_assoc($result)){
					return $row['id_user'];
				}
				return 0;
			}
		}
		public function getUsernameFromToken($token){
			$id=$this->getIdFromToken($token);
			$sql="SELECT username from utilizatori where id='$id'";
			$result = mysqli_query($this->conn,$sql);
			$resultCheck = mysqli_num_rows($result);
			if($resultCheck>0){
				while($row = mysqli_fetch_assoc($result)){
					return $row['username'];
				}
				return 0;
			}
		}
		public function getEmailFromToken($token){
			$id=$this->getIdFromToken($token);
			$sql="SELECT email from utilizatori where id='$id'";
			$result = mysqli_query($this->conn,$sql);
			$resultCheck = mysqli_num_rows($result);
			if($resultCheck>0){
				while($row = mysqli_fetch_assoc($result)){
					return $row['email'];
				}
				return 0;
			}
		}

		public function getNameFromId($id){
			$sql="SELECT username from utilizatori where id='$id'";
			$result = mysqli_query($this->conn,$sql);
			$resultCheck = mysqli_num_rows($result);
			if($resultCheck>0){
				while($row = mysqli_fetch_assoc($result)){
					return $row['username'];
				}
				return 0;
			}

		}
		public function checkAnswerExistence($id_user,$question_id){
			$response=0;
			$sql="SELECT id from raspunsuri where id_user='$id_user' and id_intrebare='$question_id'";
			$sql2="SELECT id_user from intrebari where id='$question_id'";
			
			$result = mysqli_query($this->conn,$sql);
			$result2=mysqli_query($this->conn,$sql2);

			$resultCheck = mysqli_num_rows($result);
			$resultCheck2 = mysqli_num_rows($result2);
			
			if($resultCheck>0){
				while($row = mysqli_fetch_assoc($result)){
					$response=1;
				}
			}
			if($resultCheck2>0){
				while($row = mysqli_fetch_assoc($result2)){
					if($row['id_user']==$id_user)$response=2;
				}
			}

			return $response;
		}
		public function counterAdded($token){
			$id=$this->getIdFromToken($token);
			$sql="SELECT * from intrebari where id_user='$id'";
			$result = mysqli_query($this->conn,$sql);
			$resultCheck = mysqli_num_rows($result);
			$counter=0; 
			if($resultCheck>0){
				while($row = mysqli_fetch_assoc($result)){
					$counter++;
				}
				return $counter;
			}
		}



		public function validateAndAddToken($username_parameter,$token_parameter){
			$id_user=$this->getId($username_parameter);
			if($this->validateToken($token_parameter)==1){
				echo "";
			}else{
				$sql = "INSERT INTO token (id_user,continut) VALUES ('$id_user','$token_parameter')";
				if(mysqli_query($this->conn,$sql)) echo "";
				else echo "Error: " . $sql . "<br>" . mysqli_error($this->conn);
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
         $user = array();
	 $sql="SELECT username from utilizatori";
	 $result = mysqli_query($this->conn,$sql);
         
         while($row = mysqli_fetch_assoc($result))
	 	$user[] = $row['username'];
        
         foreach ($user as $i)
           if ($i === $username){
            $check=true;
             break;
            }
        return $check;
        }


  public function register($username, $password, $email){
         if($this->verifyUsername($username) === true){
           return 2;
         }
         else{
         $sql="INSERT INTO utilizatori (username, email, tip, parola) VALUES ('$username','$email','normal','$password')";
         if ($this->conn->query($sql) === TRUE)
			return 1;
         else 
            return 0;
        }
     }

	}

?>
