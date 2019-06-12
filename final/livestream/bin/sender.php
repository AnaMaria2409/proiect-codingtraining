<?php
require_once "../../operation.php";
require_once "../../dboperations.php";
require_once "../../token.php";
global $token;

$token=new token();
$db= new dboperations();
global $username;
if(isset($_COOKIE["token"]) and $token->vtoken($_COOKIE["token"])){
$username =$db->getUsernameFromToken($_COOKIE["token"]);

$operation = new operation($_COOKIE["token"]);
if($operation->checkLivestream($_REQUEST["port"])){}
else header("Location:../../homepage/index.php");


}

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
  <video autoplay="true" id="videoElement"></video>a
    <canvas id="canvas" width="100px" height="100px" onclick= canvasOnclick() hidden="true"></canvas>
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
var video = document.querySelector("#videoElement");
var canvas = document.getElementById('canvas');
var ctx = canvas.getContext('2d');
if (navigator.mediaDevices.getUserMedia) {       
    navigator.mediaDevices.getUserMedia({video: true})
  .then(function(stream) {
    video.srcObject = stream;
  })
  .catch(function(err0r) {
    console.log("Something went wrong!");
  });
}
 var conn = new WebSocket('ws://localhost:<?php echo $_GET['port'];?>/websocket/bin/server.php');


var myVar = setInterval(intervalTimer, 0);
   const img = document.querySelector('img');
  
        
  document.getElementById("sbmt").addEventListener("click", function(){
      var message = "<?php echo $username;?>"+document.getElementsByClassName('comment')[0].value;
     
    conn.send(message);    


});
  conn.onmessage = message => {
            // set the base64 string to the src tag of the image
          if(message.data.length<100)
            console.log(message.data);
          
        }
function intervalTimer() {

            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;
            canvas.getContext('2d').drawImage(video, 0, 0);
  conn.send(canvas.toDataURL('image/svg'));
}


</script>

</body>
</html> 
