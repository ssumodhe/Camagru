var video = document.querySelector("#videoElement");
var button = document.querySelector("#buttonElement");
var canvas = document.querySelector("#canvasElement");
var width = 300;
var height = 225;

/*Gestion Navigateur/Webcam*/
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

/*Gestion Video*/
//function handlePictureSize(ev) {
//   height = video.videoHeight / (video.videoWidth/width);
//    video.setAttribute('width', width);
//    video.setAttribute('height', height);
//    canvas.setAttribute('width', width);
//    canvas.setAttribute('height', height);
    /* height = video.videoHeight / (video.videoWidth/width);
      canvas.setAttribute('width', width);
      canvas.setAttribute('height', height); */
//}
//video.addEventListener('canplay', handlePictureSize, false);

/*Gestion Bouton Photo*/
function takePicture() {
  //  canvas.width = width;
//    canvas.height = height;
    canvas.getContext('2d').drawImage(video, 0, 0, width, height);
    var data = canvas.toDataURL('image/png');
   /* photo.setAttribute('src', data); */
    /*canvas.width = width;
    canvas.height = height;
    canvas.getContext('2d').drawImage(video, 0, 0, 0, 0);
    var data = canvas.toDataURL('image/png'); *//* enregistre la data de la photo */
    
}
button.addEventListener('click', takePicture, false);

/*function handleButton(ev){
    takePicture();
    ev.preventDefault();  ??? 
}*/

