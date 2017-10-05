<?php session_start(); 
if(!isset($_SESSION[log]))
{
    header("Location: index.php");
}
?>
<!DOCTYPE HTML>
<html>
    <head>
        <?php include("Camagru_header.php"); ?>
    </head>
    
    
    <body>
        <?php include("Camagru_menu.php"); ?>
        <?php include("Camagru_video.php"); ?>
        
        <?php
            if(isset($_POST['hidden_img']))
            {
                echo ("<img src=\"".$_POST['hidden_img']."\"/>");
//               unset($_POST['img']);
            }
 
        ?>
    
    </body>
    
    
    
    <footer>
        <?php include("Camagru_footer.php"); ?>
    </footer>
</html>