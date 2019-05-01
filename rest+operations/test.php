<!DOCTYPE html>
<html>
<body>

<?php

$result="asasdasdsad";
$email="a@a.com";



if($result==verify_username($result))echo "input is ok";
else echo "input invalid";
echo "<br/>";
if($email==verify_email($email))echo "email is ok";
else echo "email is not ok";


function verify_username($string){
return preg_replace("/[^a-zA-Z0-9]+/", "", $string);
}
function verify_email($email){
return str_replace("'","",filter_var($email, FILTER_VALIDATE_EMAIL));
}
?>

</body>
</html>