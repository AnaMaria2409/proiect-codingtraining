<?php
require_once "../token.php";
require_once "../operation.php";
$token=new token();
global $op;
global $id;
if(isset($_COOKIE["token"]) and $token->vtoken($_COOKIE["token"])){
    $op=new operation($_COOKIE["token"]);
}
else header('Location: ' . $_SERVER['HTTP_REFERER']);
if(isset($_POST["answear"])
and isset($_POST["id_user"])
and isset($_POST["feedback"])
and isset($_POST["checkbox"])){
$op->putfeedback($_POST["answear"],$_POST["id_user"], $_POST["feedback"], $_POST["checkbox"]);
	header('Location: ' . $_SERVER['HTTP_REFERER']."?done=true");
}

?>