<?php
require_once "../../operation.php";
require_once "../../dboperations.php";
require_once "../../token.php";
global $token;

$token=new token();
$db=new dboperations();
global $username;
if(isset($_COOKIE["token"]) and $token->vtoken($_COOKIE["token"])){
$operation = new operation($_COOKIE["token"]);
if($operation->checkLivestream($_REQUEST["port"])){
  $username =$db->getUsernameFromToken($_COOKIE["token"]);

header("Location:http://localhost/livestream/bin/sender.php?port=".$_REQUEST["port"]);
}


}else header("Location:http://localhost/paginalogare/paginalogare.php");

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel = "stylesheet"
   type = "text/css"
   href = "style.css" />
   <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <title>Livestream</title>
</head>
<header class="navBar">
<ul>
             <li><a class="active" href="../../homepage/index.php">Home</a></li>
  <li><a href="../../account/account.php">My Account</a></li>
  <li><a href="../../paginalogare/logout.php">Sign out</a></li>
            </ul>

</header>
<div class="container">
<div class="liveStreamVideo">
<img src="" width="100%" height="auto">
</div>
<div class="liveStreamBox">
  <div class="liveStreamComments">
    <div class="commentObject"><div class="username"><a href="usernamepage">username:</a></div>this is a commentthis is a commentthis is a commentthis is a comment</div>

  </div>

  <input class="comment" type="text">
  <input id="sbmt" class="submit" type="submit">

</div>
</div>
<script>
function sleep (time) {
  return new Promise((resolve) => setTimeout(resolve, time));
}

// Usage!

var canvas = document.getElementById('canvas');

 var ws = new WebSocket('ws://localhost:<?php echo $_GET['port'];?>/websocket/bin/server.php');
        // get img dom element
        const img = document.querySelector('img');
      
      document.getElementById("sbmt").addEventListener("click", function(){
      var message = "<?php echo $username;?>"+document.getElementsByClassName('comment')[0].value;
    
      ws.send(message);      


});
        
        ws.onmessage = message => {
            // set the base64 string to the src tag of the image
          if(message.data.length<100)
            console.log(message.data);
          else{
          
           img.src = message.data;
            
          console.log("am primit date");
        }
        }
    </script>

</body>
</html> 
