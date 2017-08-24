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
                width: 525px;
                height: 450px;
                margin: 0px auto;
                }
            .id_rendu{
                width: 525px;
                height: 260px;
                margin: auto auto;
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
                position: relative;
                }
            #canvasElement{
                width: 300px;
                height: 225px;
                border-width: 0.2vh;
                border-color: gainsboro;
                border-style: dashed;
                display: flex;
                position: absolute;
                z-index: 2;
               /* filter: type(value);*/
                }
         /*   #snapshotElement{
                width: 100px;
                height: 100px;
                position: absolute;
                z-index: 2; 
                filter: alpha;
            }*/
            #f_kitty{
                width: 125px;
                height: 175px;
                display: flex;
                position: absolute;
                z-index: 4;
                padding-bottom: 0%;
            }
            
        </style>
        
        <h1> Welcome to Camagru !</h1>
    </head>
    
    
    <body>
        <div class="id_video">
            <video id="videoElement" autoplay="true"></video>
            
            <button id="buttonElement" alt="takepic_button">Prendre la photo</button>
            
        </div>
        
        <div class="id_rendu">
            <canvas id="canvasElement"></canvas>
            
            <!-- <img id="snapshotElement" alt="snapshot"> -->
            
          <!--  <img id="img1" src="bichette_vache_detour.jpg"/> -->
            <img id="f_kitty" src="kitty_detour_redim.gif"/> 
            
            
        
            
        </div>
        
        <script src="webcam.js"></script>
    </body>
    
    
</html>