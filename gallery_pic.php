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
        <?php  echo('<div id="prec_page">
        <a href="gallery.php">Revenir à la galerie.</a>
        </div>');?>
        
        
        <!-- ------------------- -->
        <!-- Partie photo + like -->
        <!-- ------------------- -->
        <?php
        
        if(isset($_GET[id]) && isset($_GET[user]))
        {
            $_SESSION[pic] = $_GET[id];
            $_SESSION[name] = $_GET[user];
            unset($_GET[id]);
            unset($_GET[user]);
        
        
        $bdd = include("database.php");
        $reponse = $bdd->query("SELECT * FROM pictures WHERE id=\"".$_SESSION['pic']."\";");
        $donnees = $reponse->fetch();
        
        if($donnees[user_id] == $_SESSION[name])
        {
            echo("Photo de ".$donnees[user_id].".");
            echo("<br/>");
            echo("<img src='".$donnees[data_picture]."' />");
            echo("<br/>");
            echo("<div id='info_pic'>Crée le ".$donnees[created]."");
            echo("<form action='gallery_pic.php' method='GET'>
            <input type='hidden' name='id' value='".$_SESSION[pic]."' />
            <input type='hidden' name='user' value='".$_SESSION[name]."' />
            <input id='like_button' type='image' name='likeup' value='oneup' width=30px height=32px src='img/like_button_unicorn.png'/>
            </form>");
            if(isset($_GET[likeup]))
            {
                $donnees[nb_like]++;
                $requete= "UPDATE pictures SET nb_like=".$donnees[nb_like]." WHERE id=".$_SESSION[pic].";";
                $bdd->prepare($requete)->execute();
                unset($_GET[likeup]);
                
            $_SESSION['created'] = date('Y-m-d h:i:s');
            $requete = "INSERT INTO likes (user_mail, id_picture, created) VALUES ('".$_SESSION['user_mail']."', 
            '".$_SESSION['pic']."',
            '".$_SESSION['created']."');";
            $bdd->prepare($requete)->execute();
                
            }
//            echo("<a href='gallery_add_like.php'><img width=30px height=32px src='img/like_button_unicorn.png' />");
            echo("".$donnees[nb_like]."");
            echo("<br/>");
            echo("<br/></div>");
//            unset($_SESSION[pic]);
//            unset($_SESSION[name]);
        }
        }
        else
        {
            header("Location: gallery.php");
            exit();
        }
        ?>
        
        <!-- ------------------- -->
        <!-- Partie Commentaires -->
        <!-- ------------------- -->
        <form method="post" action="">
            <label>Ajouter un commentaire :</label><br/>
            <input type="hidden" name="id_user" value="<?php $_SESSION[id_user] ?>"/>
            <input type="hidden" name="user_mail" value="<?php $_SESSION[user_mail] ?>"/>
            <textarea name="message" rows=4 cols=40></textarea><br/> 
            <input type="submit" value="Commenter!" /><br/>
        </form>
        
        <?php
            if(isset($_POST['message']))
            {
                $bdd = include("database.php");
                $_SESSION['created'] = date('Y-m-d h:i:s');
                $requete = "INSERT INTO comments (user_id, user_mail, id_picture, comment, created) VALUES ('".$_SESSION['id_user']."', '".$_SESSION['user_mail']."', 
                '".$_SESSION['pic']."',
                '".$_POST['message']."',
                '".$_SESSION['created']."');";
            $bdd->prepare($requete)->execute();
            }
            $bdd = include("database.php");
            $reponse = $bdd->query("SELECT * FROM comments WHERE id_picture=\"".$_SESSION['pic']."\"ORDER BY id DESC;");
            while ($donnees = $reponse->fetch())
            {
                echo("Le ".$donnees[created].", ".$donnees[user_id]." a commenté:   ".$donnees[comment]."");
                echo("<br/>");
                echo("<br/>");
                
            }
        ?>
        
    </body>
    
    
    
    <footer>
        <?php include("Camagru_footer.php"); ?>
    </footer>
</html>