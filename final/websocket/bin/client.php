
<!DOCTYPE html>
<html>
<head>

<title>transmite video din id videoElement  in canvas</title>
  
<style>
#container {
    margin: 0px auto;
    width: 500px;
    height: 375px;
    }
#videoElement {
    width: 500px;
    height: 375px;
    background-color: #666;
}
#canvas {
  background-color: #666;
}
</style>
</head>
  
<body>
   
    <img src="" >
      
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

</script>
</body>
</html>