
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
    <video autoplay="true" id="videoElement"></video>a
    <canvas id="canvas" width="100px" height="100px" onclick= canvasOnclick()></canvas>

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

function intervalTimer() {

            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;
            canvas.getContext('2d').drawImage(video, 0, 0);
  conn.send(canvas.toDataURL('image/svg'));
}


</script>
</body>
</html>