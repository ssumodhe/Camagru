<?php session_start();
$_SESSION[nb_pic_display] = 0;
$_SESSION[page] = 1;
$_SESSION[next_p] = 2;
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
        
        <pre id="directive">Clique sur un filtre pour pouvoir prendre/sauvegarder la photo.
        Tu pourras ensuite bouger le filtre sur ta photo. :)<br/></pre>
        <?php include("upload_file.php"); ?>
       
        
        <?php include("Camagru_video.php"); ?> 

    </body>
    
  
    
    <footer>
        <?php include("Camagru_footer.php"); ?>
    </footer>
</html>