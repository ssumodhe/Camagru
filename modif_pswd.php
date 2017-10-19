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
        
        <form method="post">
            <label>Votre ancien mot de passe : </label>
            <input type="password" name="pswd_old"/><br/>
            
            <label>Le nouveau : </label>
            <input type="password" name="pswd_new_1" /><br/>
            
            <label>Resaisissez le nouveau svp : </label>
            <input type="password" name="pswd_new_2"/><br/>
            
            <input type="submit" value="Modifier!" />
            
        </form>
        
        <?php 
        
            if(isset($_POST[pswd_old]) && $_POST[pswd_old] != NULL && isset($_POST[pswd_new_1]) && $_POST[pswd_new_1] != NULL && isset($_POST[pswd_new_2]) && $_POST[pswd_new_2] != NULL)
            {
                $mdp = hash("sha512", $_POST[pswd_old]);
                unset($_POST[pswd_old]);
                $mdp_2 = hash("md5", $mdp);
                unset($mdp);
                
                $bdd = include("database.php");   
                $reponse = $bdd->query("SELECT * FROM users WHERE login=\"".$_SESSION['id_user']."\" AND mail=\"".$_SESSION['user_mail']."\";");
                $donnees = $reponse->fetch();
        
                if($donnees[password] != $mdp_2)
                {
                    echo ("<br/><br/><p id='error'>Erreur : l'ancien mot de passe n'est pas valide.\n</p>");
                }
                else
                {
                    if($_POST[pswd_new_1] != $_POST[pswd_new_2])
                    {
                        echo ("<br/><br/><p id='error'>Erreur : Veuillez resaisir les deux nouveaux mots de passe à l'identique svp.\n</p>");
                    }
                    else
                    {
                        $mdp = hash("sha512", $_POST[pswd_new_1]);
                        unset($_POST[pswd_new_1]);
                        unset($_POST[pswd_new_2]);
                        $mdp_2 = hash("md5", $mdp);
                        unset($mdp);
                        
                        $bdd = include("database.php");   
                        $requete= "UPDATE users SET password=\"".$mdp_2."\" WHERE mail=\"".$_SESSION['user_mail']."\";";
                        //        MYSQL
                        //    $bdd->prepare($requete)->execute();
                      $reponse = $bdd->prepare($requete);
                $result = $reponse->execute();
                        unset($mdp_2);
                        
                        echo ("<p>Un e-mail de réinitialisation vient de vous etre envoyé. </p>");
                        echo "<meta http-equiv='refresh' content='3,url=my_account.php'>";
                    }
                    
                }
                
            }
        
        ?>
        
    </body>
    
    
    
    <footer>
        <?php include("Camagru_footer.php"); ?>
    </footer>
</html>