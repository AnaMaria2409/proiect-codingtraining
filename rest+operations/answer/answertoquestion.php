<?php
require_once "../token.php";
require_once "../operation.php";
$token=new token();

if(isset($_COOKIE["token"]) and $token->vtoken($_COOKIE["token"])){
  $op=new operation($_COOKIE["token"]);
  $op->answertoquestion($_POST["id"],$_POST["answer"]);
	header("Location: ../answer/answer.php?id={$_POST["id"]}");
}
else header("Location: ../paginalogare/paginalogare.php");

?>