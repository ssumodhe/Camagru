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
                $_SESSION['id_picture'] = 12;
                $_SESSION['nb_like'] = 0;
                $_SESSION['created'] = date('l jS \of F Y h:i:s A');
                
                echo($_POST['hidden_img']);
                echo ("<img src=\"".$_POST['hidden_img']."\"/>");
                
                $bdd = include("database.php");
                $requete = "INSERT INTO pictures (id_picture, login, nb_like, data_picture, created) VALUES (
                '".$_SESSION['id_picture']."',
                '".$_SESSION['user_mail']."', '".$_SESSION['nb_like']."',
                '".$_POST['hidden_img']."',
                '".$_SESSION['created']."');";
                $bdd->prepare($requete)->execute();
                
            }
        print_r($_SESSION);
 
        ?>
    
    </body>
    
    
    
    <footer>
        <?php include("Camagru_footer.php"); ?>
    </footer>
</html>