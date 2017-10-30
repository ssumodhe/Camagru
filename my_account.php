<?php
session_start();
$_SESSION[nb_pic_display] = 0;
$_SESSION[page] = 1;
$_SESSION[next_p] = 2;
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
        
        <!-- ------------------- -->
        <!-- Partie user's infos -->
        <!-- ------------------- -->
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
        
        
        <!-- ---------------------- -->
        <!-- Partie user's pictures -->
        <!-- ---------------------- -->
        <div>
            <h2>Vos Photos</h2>
            <div class="prev_pic">
                <?php
                    $bdd = include("database.php");
                    $reponse = $bdd->query("SELECT * FROM pictures WHERE user_id=\"".$_SESSION[id_user]."\"ORDER BY id DESC;");
                    
                    $i = 0;
                    while ($donnees = $reponse->fetch())
                    {
                        echo("<a href='gallery_pic.php?id=".$donnees[id]."&user=".$donnees[user_id]."'><img id='user_pic' width=15% src='".$donnees[data_picture]."' />");
                        $i++;
                    }
                    $reponse->closeCursor();
                    if($i == 0)
                    {
                        echo("Vous n'avez pas encore de photos, <a href='home.php'>venez par <a href='home.php'>ici</a> pour en prendre!");
                    }
                ?>
            </div>
        </div>
        
        
   </body>
    
    
    
    
    <footer>
        <?php include("Camagru_footer.php"); ?>
    </footer>
</html>
