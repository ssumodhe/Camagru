<?php
    session_start();
    include_once("database.php");
?>

<?php
/*
// Try essaie d'acceder a mysql, si cela echoue, 
// et pour eviter que php n'affiche la ligne qui pose probleme, 
// on lance catch qui recupere le message d'erreur envoyer
// par PDO.
    try{
        $bdd = new PDO('mysql:host=localhost;dbname=camagru;charset=utf8',
              'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        //Etablie une connexion avec la base de donnees.
        //N'a besoin d'etre faite qu'une seule fois, 
        //en debut de page
        //Le dernier paramettre permet d'activer les erreurs,
        //ainsi elles seront plus claires a comprendre.
    }
    catch (Exception $error){
        die('An error occurred while connecting to mysql. Here\'s the error:' . $error->getMessage());
    }

    //Recupere les infos demandees par la requete.
    //$reponse = $bdd->query('SELECT * FROM ?');

    $requete = "CREATE TABLE IF NOT EXISTS users (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    login VARCHAR(100) CHARACTER SET utf8,
    mail VARCHAR(255) CHARACTER SET utf8,
    password VARCHAR(255) CHARACTER SET utf8,
    created DATETIME NOT NULL
    )ENGINE=INNODB";
    $bdd->prepare($requete)->execute();

    $requete = "CREATE TABLE IF NOT EXISTS pictures (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    login VARCHAR(100) CHARACTER SET utf8,
    data_picture VARCHAR(255) CHARACTER SET utf8,
    created DATETIME NOT NULL
    )ENGINE=INNODB";
    $bdd->prepare($requete)->execute();
    //[...] or die(print_r($bdd->errorInfo()));

    // Affiche chaque entrée une à une
   // while ($donnees = $reponse->fetch())
   // {
   //     ...
   // }

    //Il faut fermer $reponse; Cela indique que l'on a fini
    //de travailler sur la requete.
   // $reponse->closeCursor();
*/
?>
<!DOCTYPE HTML>
<html>
    <head>
        <?php include("Camagru_header.php"); ?>
    </head>
    
    
    <body>
        <?php include("Camagru_menu.php"); ?> <!-- A virer apres -->

        <!-- -------------- -->
        <!-- Message Erreur -->
        <!-- -------------- -->
        <?php
            if (isset($_SESSION['form_complete']) && $_SESSION['form_complete'] == "KO")
            {
               echo "<p id='error'>Erreur : vous devez remplir correctement tous les champs.\n</p>";
               unset($_SESSION['form_complete']);
            }
        ?>
        
        <!-- ------- -->
        <!-- Sign_up -->
        <!-- ------- -->
        <div id="sign_up">
        <form method="post" action="sign_up.php">
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
            
        
        <!-- ---------------- -->
        <!--  Barre Verticale -->
        <!-- ---------------- -->
        <div id="verti_stick">
        </div>
        
        
        <!-- ------- -->
        <!-- Sign_in -->
        <!-- ------- -->
        <div id="sign_in">
        <form method="post" action="sign_in.php">
            <p> Déjà inscrit ?</p>
            <label for="pseudo">Votre e-mail : </label><input type="text" name="user_mail"/>
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