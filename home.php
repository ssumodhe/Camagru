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
                $_SESSION['nb_like'] = 0;
                $_SESSION['created'] = date('Y-m-d h:i:s');
                
                $bdd = include("database.php");
                $requete = "INSERT INTO pictures (user_id, user_mail, nb_like, data_picture, created) VALUES (
                '".$_SESSION['id_user']."',
                '".$_SESSION['user_mail']."', '".$_SESSION['nb_like']."',
                '".$_POST['hidden_img']."',
                '".$_SESSION['created']."');";
                $bdd->prepare($requete)->execute();
                
            }
 
        ?>
    
   
        
        
    </body>
    
    
    
    <footer>
        <?php include("Camagru_footer.php"); ?>
    </footer>
</html>