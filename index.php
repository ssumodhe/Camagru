<!DOCTYPE HTML>
<html>
    <head>
        <title> My Camagru !</title>
        <meta charset="utf-8">
        
      <!-- <script src="index.js"></script> -->
        
        
        <style type="text/css">
            h1{
                text-align: center;
            }
            .id_video{
            /*    background-color: burlywood;
                border-width: 1vh;
                border-color: black;
                border-style: double; */
                
                margin: 0px auto;
                width: 500px;
                height: 375px;
              
                }
            #videoElement{
                width: 500px;
                height: 375px;
                background-color: gainsboro;
                border-width: 1vh;
                border-color: black;
                border-style: double;
                }
            #buttonElement{
                margin-top: 1vh;
                margin-left: 70%
                }
           /* #snapshotElement{
                width: 0px;
                height: 0px;
            }*/
            
        </style>
        
        <h1> Welcome to Camagru !</h1>
    </head>
    
    
    <body>
        <div class="id_video">
            <video id="videoElement" autoplay="true"></video>
            
            <button id="buttonElement" alt="takepic_button">Prendre la photo</button>
            
            <canvas id="canvasElement"></canvas>
            
          <!--  <img id="snapshotElement" alt="snapshot"> -->
            
            <script src="webcam.js"></script>
            
        </div>
        
        
        
        
       <!-- <div>
            <button id="buttonElement">Prendre la photo</button>

        </div> -->
        
        
    </body>
    
    
</html>