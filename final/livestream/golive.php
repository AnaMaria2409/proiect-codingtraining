<?php
include "../token.php";
include "../operation.php";
global $op;

$token=new token();

if(isset($_COOKIE["token"]) and $token->vtoken($_COOKIE["token"])){
$op=new operation($_COOKIE["token"]); 


}
if($op->isPrivilegiat()){
	$port=$op->generatePORT();
	if($op->addLivestream($port)!=1){
		header("Location: ../livestream/bin/sender.php?port=".$op->addLivestream($port));
	}
	else {
		header("Location: ../livestream/bin/sender.php?port=".$port);

	}


}
else header("Location: ../paginalogare/paginalogare.php");

?>