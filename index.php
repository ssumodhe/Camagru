<?php
    session_start();
    include_once("database_TH.php");
?>
<!DOCTYPE HTML>
<html>
    <head>
        <?php unset($_SESSION['log']);
        include("Camagru_header.php"); ?>
    </head>
    
    
    <body>

        <!-- --------------- -->
        <!-- Messages Erreur -->
        <!-- --------------- -->
        <?php
            if (isset($_SESSION['form_complete']) && $_SESSION['form_complete'] == "KO")
            {
               echo "<p id='error'>Erreur : vous devez remplir correctement tous les champs.\n</p>";
               unset($_SESSION['form_complete']);
            }
            else if (isset($_SESSION['form_complete']) && $_SESSION['form_complete'] == "KO_sign_in")
            {
               echo "<p id='error'>Erreur : les informations renseignées semblent incorrectes.\n</p>";
               unset($_SESSION['form_complete']);
            }
            else if (isset($_SESSION['form_complete']) && $_SESSION['form_complete'] == "KO_mail_exist")
            {
               echo "<p id='error'>Erreur : cet email est déjà utilisé.\n</p>";
               unset($_SESSION['form_complete']);
            }
            else if (isset($_SESSION['form_complete']) && $_SESSION['form_complete'] == "KO_mail_incorrect")
            {
               echo "<p id='error'>Erreur : l'adresse email ne semble pas valide.\n</p>";
               unset($_SESSION['form_complete']);
            }
        ?>
        
        <!-- ------- -->
        <!-- Sign_up -->
        <!-- ------- -->
        <div id="sign_up">
        <form method="post" action="sign_up.php">
            <p>Pas encore inscrit ?</p>
            <label for="id_user">Votre nom : </label><input type="text" name="id_user" id="id_user"/>
            <br/>
            <label for="user_mail">Votre e-mail : </label><input type="text" name="user_mail" id="user_mail"/>
            <br/>
            <label for="password">Votre mot de passe : </label><input type="password" name="password" id="password"/>
            <br/>
            <input type="submit" name="sign_up" value="Je m'inscris !"/>
        </form>
        </div>
            
        
        <!-- --------------- -->
        <!-- Barre Verticale -->
        <!-- --------------- -->
        <div id="verti_stick">
        </div>
        
        
        <!-- ------- -->
        <!-- Sign_in -->
        <!-- ------- -->
        <div id="sign_in">
        <form method="post" action="sign_in.php">
            <p> Déjà inscrit ?</p>
            <label for="pseudo">Votre e-mail : </label><input type="text" name="user_mail" id="pseudo"/>
            <br/>
            <label for="password">Votre mot de passe : </label><input type="password" name="password" id="password"/>
            <br/>
            <a href="#">Mot de passe oublié?</a>
            <br/>
            <input type="submit" name="sign_in" value="Go !"/>
            
        </form>
        </div>
        
    </body>
    
    
    
    <footer>
        <?php include("Camagru_footer.php"); ?>
    </footer>
</html>