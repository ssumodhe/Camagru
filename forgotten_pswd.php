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
        $_SESSION[user_mail] = htmlspecialchars($_POST[user_mail]);
        unset($_POST[user_mail]);
        $bdd = include("database.php");
        
        $reponse = $bdd->query("SELECT mail FROM users WHERE mail=\"".$_SESSION['user_mail']."\";");
        $donnees = $reponse->fetch();
        
        if ($donnees[mail] != NULL)
        {
           $characts    = 'abcdefghijklmnopqrstuvwxyz';
           $characts   .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';	
	       $characts   .= '1234567890';
            $new_pass = "";

            for($i=0;$i < 5;$i++)
	       { 
            $new_pass .= substr($characts,rand()%(strlen($characts)),1); 
	       }
            $mdp = hash("sha512", $new_pass);
            $mdp_2 = hash("md5", $mdp);
            unset($mdp);
            $_SESSION[new_pass] = $mdp_2;
            unset($mdp_2);
            
            $requete = ("UPDATE users SET password=".$_SESSION[new_pass]." WHERE mail=\"".$_SESSION['user_mail']."\";");
            $rep = $bdd->prepare($requete);
            $rep->execute();
            $rep->closeCursor();
            unset($requete);
            unset($rep);
            
            $_SESSION[new_pass] = $new_pass;
            unset($new_pass);
            require("mailing_forgotten_pswd.php"); 
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