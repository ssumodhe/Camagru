<?php
session_start();
?>
<!DOCTYPE HTML>
<html>
    <head>
        <?php include("Camagru_header.php"); ?>
    </head>
    
    
    <body>
        <form method="post" action="#">
            <label>Votre e-mail: <input type="text" name="user_mail"/></label>
            <input type="submit" value="New mot de passe please!" />
        </form>
    
<?php

    if (isset($_POST['user_mail']))
    {
        // CHECK CE QUE POST RENVOI REGEX, faille XSS et injection SQL
        $_SESSION[user_mail] = $_POST[user_mail];
        unset($_POST[user_mail]);
        $bdd = include("database.php");
        
        $reponse = $bdd->query("SELECT mail FROM users WHERE mail=\"".$_SESSION['user_mail']."\";");
        $donnees = $reponse->fetch();
        
        if ($donnees[mail] != NULL)
        {
//          require("mailing_for_pswd.php"); 
            echo ("<p>Un e-mail vient de vous etre envoyé avec un nouveau mot de passe. Notez le quelque part ^^</p><p>Tu vas etre rediriger dans un instant vers la page d'accueil.</p>");
            echo "<meta http-equiv='refresh' content='4,url=index.php'>";
        }
        else
        {    
            echo ("<p>Connais pas cet e-mail!\n</p>");
        }
        $reponse->closeCursor();
    }
    
?>
        
    <div id="prec_page">
     <a href="index.php">Revenir à la page précédente.</a>
    </div>
   </body>
    
    
    <footer>
        <?php include("Camagru_footer.php"); ?>
    </footer>
</html>