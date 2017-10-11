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
        $reponse = $bdd->query("SELECT * FROM pictures ORDER BY id DESC;");
        
        while ($donnees = $reponse->fetch())
        {
//            $photo = str_replace("data:image/png;base64,", "", $donnees[data_picture]);
            echo("<a href='gallery_pic.php?id=".$donnees[id]."&user=".$donnees[user_id]."'><img src='".$donnees[data_picture]."' />");
            echo("<br/>");
            if ($donnees[user_mail] == $_SESSION[user_mail])
                echo("Photo de vous.");
            else
                echo("Photo de ".$donnees[user_id].".");
            echo("<br/>");
            echo("<br/>");
        }
        
        ?>
        
        
   </body>
    
    
    
    
    <footer>
        <?php include("Camagru_footer.php"); ?>
    </footer>
</html>