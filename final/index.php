<?php
include "token.php";
$token=new token();
if(isset($_COOKIE["token"]) and $token->vtoken($_COOKIE["token"])){
	echo "you are logged in , congrats<br/>";
	echo $token->db->getNameFromId($token->db->getIdFromToken($_COOKIE["token"]));
}

else header("Location: login.php");

?>