<!DOCTYPE HTML>
<html>
    <head>
        <title> My Camagru !</title>
        <meta charset="utf-8">
        
        <style type="text/css">
            body{
                background-color: aliceblue; 
            }
            h1{
                text-align: center;
                }
            .id_video{
            /*  background-color: aliceblue;
                border-width: 1vh;
                border-color: black;
                border-style: double; */
                
                margin: 0px auto;
                width: 525px;
                height: 800px;
              
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
                margin-left: 70%;
                }
            #canvasElement{
                border-width: 0.2vh;
                border-color: gainsboro;
                border-style: dashed;
                filter: type(value);
                }
           /* #snapshotElement{
                width: 0px;
                height: 0px;
            }*/
            
            #img1{
                width: 100px;
                height: 100px;
                position: absolute;
                z-index: 2; 
                filter: alpha;
            }
            #img2{
                margin:2vh;
                width: 50px;
                height: 50px;
                position: absolute;
                z-index: 4; 
                filter: alpha;
                
            }
            
        </style>
        
        <h1> Welcome to Camagru !</h1>
    </head>
    
    
    <body>
        <div class="id_video">
            <video id="videoElement" autoplay="true"></video>
            
            <button id="buttonElement" alt="takepic_button">Prendre la photo</button>
            
            <canvas id="canvasElement"></canvas>
            
           <!-- <img id="snapshotElement" alt="snapshot"> -->
            
            <img id="img1" src="bichette_vache_detour.jpg"/>
            <img id="img2" src="camagru_magnifing_glass.png"/> 
            
            
        <!--  <script src="webcam.js"></script> -->
            
        </div>
        
        
    </body>
    
    
</html>