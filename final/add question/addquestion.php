<?php
include "../token.php";
require_once "../operation.php";
$token=new token();

if(isset($_COOKIE["token"]) and $token->vtoken($_COOKIE["token"])){
$op=new operation($_COOKIE["token"]);    
}
else header("Location: ../paginalogare/paginalogare.php");

if(isset($_POST["question"]) and 
	isset($_POST["solution"]) and
	isset($_POST["difficulty"]) and
	isset($_POST["category"]) 
){
$op->putquestion($_POST["question"],$_POST["category"],$_POST["difficulty"],$_POST["solution"]);
header("Location: ../add question/add.php?done=true");
}

?>