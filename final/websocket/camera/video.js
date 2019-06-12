(function() {
    var canvas = document.getElementById('canvas'),
        context = canvas.getContext('2d'),
        video=document.getElementById('video');

    navigator.getMedia = navigator.getUserMedia || 
                         navigator.webkitGetUserMedia || 
                         navigator.mozGetUserMedia ||
                         navigator.msGetUserMedia;

    navigator.getMedia({
        video : true,
        audio : true
    }, function(stream){
        video.srcObject = stream;
        video.play();
    }, function(error){
      //error
    });

})()

