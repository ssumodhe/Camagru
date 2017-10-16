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
        
        <form method="post" action="" enctype="multipart/form-data">
            <input type="file" name="upload_file"/>
            <input type="submit" name="OK" value="Upload"/>
        </form>
        <?php
        if(isset($_FILE[upload_file]))
        {
            echo("Je passe");
            $_SESSION[upload_file] = $_FILE[upload_file];
//            unset($_POST[upload_file]);
            echo("<img src=\"".$_SESSION[upload_file]."\"/>");
        }
        ?>
        <br/>
        <?php include("Camagru_video.php"); ?>        
    </body>
    
    
    
    <footer>
        <?php include("Camagru_footer.php"); ?>
    </footer>
</html>