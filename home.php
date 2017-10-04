<?php session_start(); ?>
<!DOCTYPE HTML>
<html>
    <head>
        <?php include("Camagru_header.php"); ?>
    </head>
    
    
    <body>
        <?php include("Camagru_menu.php"); ?>
        <?php include("Camagru_video.php"); ?>
        
        <?php
if(isset($_POST['img']))
   {
       echo ("img received<br/>");
       $photo = imagecreatefromstring($_POST['img']);
       echo ("<img src=\"".$photo."\"/>");
//        unset($_POST['uid']);
   }
 
?>
    
    </body>
    
    
    
    <footer>
        <?php include("Camagru_footer.php"); ?>
    </footer>
</html>