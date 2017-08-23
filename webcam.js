var video = document.querySelector("#videoElement");
var button = document.querySelector("#buttonElement");
var canvas = document.querySelector("#canvasElement");
/*var width = 300;
var height = 0;*/
 
navigator.getUserMedia = navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia || navigator.msGetUserMedia || navigator.oGetUserMedia;
 
if (navigator.getUserMedia) {
    navigator.getUserMedia({video: true}, handleVideo, videoError);
}

function handleVideo(stream) {
    /* set la source de la variable video à ce que la webcam envoie (le stream)*/
    video.src = window.URL.createObjectURL(stream);
}
 
function videoError(error) {
    console.log("It seems to be a problem when displaying the webcam video stream");
}



/*video.addEventListener('canplay', handlePictureSize, false);

function handlePictureSize(ev) {
      height = video.videoHeight / (video.videoWidth/width);
      canvas.setAttribute('width', width);
      canvas.setAttribute('height', height);
}*/



button.addEventListener('click', takePicture, false);

/*function handleButton(ev){
    takePicture();
    ev.preventDefault();
}*/

function takePicture() {
   /* height = video.videoHeight / (video.videoWidth/width);*/
    canvas.getContext('2d').drawImage(video, 0, 0, 0, 0);
    var data = canvas.toDataURL('image/png'); /* enregistre la data de la photo */
}