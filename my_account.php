<?php
session_start();
?>
<!DOCTYPE HTML>
<html>
    <head>
        <?php include("Camagru_header.php"); ?>
    </head>
    
    
    <body id="NotYetSub">
        <?php include("Camagru_menu.php"); ?>
        
        <div>
        <form method="post" action="sign_up.php">
        
            
            <?php
               // if (isset($_SESSION[subscribe] && $_SESSION[subscribe] == "KO"))
            //    {
              //      echo "<p id='error'>Erreur : vous devez remplir correctement tous les champs\n</p>";
                //    unset($_SESSION[subscribe]);
            //    }
            ?>
            
            
            
            <p>Pas encore inscrit ?</p>
            <label for="id_user">Votre nom : </label><input type="text" name="id_user"/>
            <br/>
            <label for="user_mail">Votre e-mail : </label><input type="user_mail" name="user_mail"/>
            <br/>
            <label for="password">Votre mot de passe : </label><input type="password" name="password"/>
            <br/>
            <input type="submit" name="sign_up" value="Je m'inscris !"/>
        </form>
        </div>
            
        <div>
        <form method="post" action="sign_in.php">
            <p> Déjà inscrit ?</p>
            <label for="pseudo">Votre e-mail : </label><input type="text" name="pseudo"/>
            <br/>
            <label for="password">Votre mot de passe : </label><input type="password" name="password"/>
            <br/>
            <input type="submit" name="sign_in" value="Go !"/>
            
        </form>
        </div>
   </body>
    
    
    
    
    <footer>
        <?php include("Camagru_footer.php"); ?>
    </footer>
</html>
