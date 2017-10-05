<!DOCTYPE HTML>
<html>
        <div class="id_video">
            <video id="videoElement" autoplay="true"></video>
            
            <button id="buttonElement" alt="takepic_button">Prendre la photo</button>
            
            
            
            
        </div>
    
    <div class="id_form">
         <form method="post">
                <input id="hidden_img" name="hidden_img" type="hidden">
                <input id="button_save" type="submit" name="save_pic" value="Sauvegarder" alt="sauvegarder la photo" disabled="disabled">
            </form>
    </div>
        
        
        <div class="id_rendu">
            <canvas id="canvasElement"></canvas>
            <img id="photo"/>
           
          
            
        </div>
        
      <script src="webcam.js"></script> 
    
 
</html>