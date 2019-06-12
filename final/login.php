<?php
include "token.php";
$token=new token();
$db=new dboperations();
if(isset($_COOKIE["token"]) and $token->vtoken($_COOKIE["token"]))
	header("Location: index.php");
if(isset($_POST["user"]) and isset($_POST["pass"]))
{
$token=new token();
if($token->vuser($_POST["user"],$_POST["pass"])){
setcookie("token",$token->vuser($_POST["user"],$_POST["pass"]),time() + (86400 * 30),"/");
$db->validateAndAddToken($_POST["user"],$token->vuser($_POST["user"],$_POST["pass"]));
header("Location: index.php");
}
}
else echo "login data incorect";
?>


<!DOCTYPE html>
<html>
<body>

<h2>LOGIN</h2>

<form action="/login.php" method="POST">
  <input type="text" name="user" >
   <input type="text" name="pass" >
  <input type="submit" value="Submit">
</form> 

</form> 
</body>
</html>
