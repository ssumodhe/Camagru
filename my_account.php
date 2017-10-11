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
            <form action="modif_pswd.php">
                <input type="submit" value="Modifier mon mot de passe" />
            </form>
            <br/>
            <form action="sign_out.php">
                <input type="submit" value="Déconnexion">
            </form>
        </div>
        
        <div>
            <h2>Vos Photos</h2>
            <div class="prev_pic">
                <?php
                    $bdd = include("database.php");
                    $reponse = $bdd->query("SELECT * FROM pictures WHERE user_mail=\"".$_SESSION[user_mail]."\"ORDER BY id DESC;");
        
                    while ($donnees = $reponse->fetch())
                    {
                        echo("<a href='gallery_pic.php?id=".$donnees[id]."&user=".$donnees[user_id]."'><img id='user_pic' width=10% length=10% src='".$donnees[data_picture]."' />");
                    }
                ?>
            </div>
        </div>
        
        
   </body>
    
    
    
    
    <footer>
        <?php include("Camagru_footer.php"); ?>
    </footer>
</html>
