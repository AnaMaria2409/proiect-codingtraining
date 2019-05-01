<?php
include "dboperations.php";
class token{
public $db;
function __construct(){
	$this->db=new dboperations();
}


public function vtoken($token){
	return $this->db->validateToken($token);
}
public function vuser($a,$b){
    //sa nu existe deja un token . 

    $sql = "SELECT username FROM utilizatori WHERE (username='$a' and parola='$b')";
	
	$result = mysqli_query($this->db->conn,$sql) or die("Bad query $sql");
	
	$resultCheck = mysqli_num_rows($result);

	$secret="1e4ff3a2990c87ff9db143ed52f60383";
	
	$conn=$a.$b.$secret;
	
	if($resultCheck>0)
		return md5($conn);
	else return "";
}

}


?>