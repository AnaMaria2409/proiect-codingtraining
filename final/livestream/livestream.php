
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
   <li><a class="active" href="../homepage/index.php">Home</a></li>
   <li><a href="../account/account.html">My Account</a></li>
   <li><a href="../paginalogare/logout.php">Sign out</a></li>
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
  <form action="submitComment.php" method="POST">
  <input class="comment" type="text">
  <input class="submit" type="submit">
</form>
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
      
        
        ws.onmessage = message => {
            // set the base64 string to the src tag of the image
          
          
           img.src = message.data;
            
          console.log("am primit date");
        }
    </script>

</body>
</html> 
