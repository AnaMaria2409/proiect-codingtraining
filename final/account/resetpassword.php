<?php

require_once "../operation.php";
require_once "../token.php";
global $token;
$token=new token();
if(isset($_COOKIE["token"]) and $token->vtoken($_COOKIE["token"])){

if(isset($_POST["currentpassword"]) &&  isset($_POST["newpass1"])
&& isset($_POST["newpass2"]) && !empty($_POST["currentpassword"])&& !empty($_POST["newpass1"])&& !empty($_POST["newpass2"])
){
	$username=$token->db->getUsernameFromToken($_COOKIE["token"]);
$currentpassword=$_POST["currentpassword"];
if($token->vuser($username,$currentpassword)){
$p1=$_POST["newpass1"];
$p2=$_POST["newpass2"];
if($p1==$p2 && strlen($p1)>10){
	$token->db->changePassword($username,$p1);
	header("Location:account.php?message=done");
}else header("Location:account.php?message=passwords are different");



}
else header("Location:account.php?message=invalid password");

}else {header("Location:account.php?message=invalid data");}




    
}
else header("Location: ../paginalogare/paginalogare.php");

?>