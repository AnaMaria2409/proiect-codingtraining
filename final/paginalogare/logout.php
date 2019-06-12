<?php
include "../dboperations.php";
$db=new dboperations();
$db->validateAndDeleteToken($_COOKIE['token']);
setcookie("token","",time()-100,"/");
header("Location: paginalogare.php");


?>