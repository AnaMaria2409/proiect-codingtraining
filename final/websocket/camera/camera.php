
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
    <video autoplay="true" id="videoElement"></video>
    <canvas id="canvas" width="500px" height="375px" onclick= canvasOnclick()></canvas>

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



var myVar = setInterval(intervalTimer, 1000/100);

function intervalTimer() {
  ctx.clearRect(0,0,475,500);
  //ctx.drawImage(video,0,0,500,375);
    draw(ctx,video);
}
function draw(a,b){
  a.drawImage(b,0,0,500,375);
   
}

</script>
</body>
</html>