<?php
include "../token.php";
$token=new token();
if(isset($_POST["user"]) and isset($_POST["pass"]) and isset($_POST["email"])){
$token->db->register($_POST["user"],$_POST["pass"],$_POST["email"]);
$tok=$token->vuser($_POST["user"],$_POST["pass"]);
setcookie("token",$token->vuser($_POST["user"],$_POST["pass"]),time() + (86400 * 30),"/");
$token->db->validateAndAddToken($_POST["user"],$token->vuser($_POST["user"],$_POST["pass"]));
header("Location: ../homepage/index.php");
}else header("Location: paginalogare.php");


?>