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
        
        <?php
        
        $bdd = include("database.php");
        $reponse = $bdd->query("SELECT * FROM pictures;");
        
        while ($donnees = $reponse->fetch())
        {
//            $photo = str_replace("data:image/png;base64,", "", $donnees[data_picture]);
            echo("<img src='".$donnees[data_picture]."' />");
            
            echo("<br/>");
        }
        
        ?>
        
        
   </body>
    
    
    
    
    <footer>
        <?php include("Camagru_footer.php"); ?>
    </footer>
</html>