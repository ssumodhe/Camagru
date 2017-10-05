<?php
session_start();
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
        
        <div id="infos">
            <h2>Vos informations</h2>
            <p>Votre nom: <?php echo($_SESSION['id_user'])?></p>
            <p>Votre e-mail: <?php echo($_SESSION['user_mail'])?></p>
            <form action="sign_out.php"><input type="submit" value="Déconnexion"></form>
        </div>
        
        
   </body>
    
    
    
    
    <footer>
        <?php include("Camagru_footer.php"); ?>
    </footer>
</html>
