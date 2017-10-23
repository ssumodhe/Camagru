<?php session_start(); 
if(!isset($_SESSION[log]))
{
    header("Location: index.php");
    exit();
}
if(isset($_POST[del_pic]))
    header("Location: gallery.php");
if(!isset($_GET[id]) || !isset($_GET[user]) || $_GET[id] == NULL || $_GET[user] == NULL)
{
    header("Location: gallery.php");
    exit();
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
        <a href="gallery.php?'.$_SESSION[page].'">Revenir à la galerie.</a>
        </div>');?>
        
        <?php
        if(isset($_POST[del_pic]))
            {
                $bdd = include("database.php");
                $requete= "DELETE FROM pictures WHERE id=".$_SESSION[pic_id].";";
                //        MYSQL
                //    $bdd->prepare($requete)->execute();
                $reponse = $bdd->prepare($requete);
                $result = $reponse->execute();
                unset($_POST[del_pic]);
            }
        ?>
        <!-- ------------------- -->
        <!-- Partie photo + like -->
        <!-- ------------------- -->
        <?php
        
        if(isset($_GET[id]) && isset($_GET[user]))
        {
            $_SESSION[pic_id] = $_GET[id];
            $_SESSION[name] = $_GET[user];
            unset($_GET[id]);
            unset($_GET[user]);
        
        
        $bdd = include("database.php");
        
        $get_if_like = $bdd->query("SELECT * FROM likes WHERE id_picture=\"".$_SESSION['pic_id']."\" AND user_mail=\"".$_SESSION[user_mail]."\";");
        $like = $get_if_like->fetch();
        if ($like != NULL)
        {
            $no_like = 1;
        }
        
        
        $reponse = $bdd->query("SELECT * FROM pictures WHERE id=\"".$_SESSION['pic_id']."\";");
        $donnees = $reponse->fetch();
        
        if($donnees[user_id] == $_SESSION[name])
        {
            if ($donnees[user_mail] == $_SESSION[user_mail])
            { 
                echo("<form action=\"\" method=\"post\">
                <input type='hidden' name='id' value='".$_SESSION[pic_id]."' />");
                echo("<input id='del_button' type='image' name='del_pic' value='to_be_del' width=30px height=30px src='img/delete_bin.png'/>");
                echo("</form>");
                
                echo("Photo de vous.");
            }
            else
            {
                echo("Photo de ".$donnees[user_id].".");
            }
            echo("<br/>");
            echo("<img src='".$donnees[data_picture]."' />");
            echo("<br/>");
            echo("<div id='info_pic'>Crée le ".$donnees[created]."");
            echo("<form action='gallery_pic.php' method='GET'>
            <input type='hidden' name='id' value='".$_SESSION[pic_id]."' />
            <input type='hidden' name='user' value='".$_SESSION[name]."' />
            <input id='like_button' type='image' name='likeup' value='oneup' width=30px height=32px src='img/like_button_unicorn.png'");
            if($no_like == 1)
            {
                echo("disabled='disabled'");
            }
            echo("/> </form>");
            if(isset($_GET[likeup]) && $no_like != 1)
            {
                $donnees[nb_like]++;
                $requete= "UPDATE pictures SET nb_like=".$donnees[nb_like]." WHERE id=".$_SESSION[pic_id].";";
                //        MYSQL
                //    $bdd->prepare($requete)->execute();
                $reponse = $bdd->prepare($requete);
                $result = $reponse->execute();
                unset($_GET[likeup]);
                
            date_default_timezone_set('Europe/Paris');
            $_SESSION['created'] = date('Y-m-d h:i:s');
            $requete = "INSERT INTO likes (user_mail, id_picture, created) VALUES ('".$_SESSION['user_mail']."', 
            '".$_SESSION['pic_id']."',
            '".$_SESSION['created']."');";
                //        MYSQL
                //    $bdd->prepare($requete)->execute();
                $reponse = $bdd->prepare($requete);
                $result = $reponse->execute();
            }
//            echo("<a href='gallery_add_like.php'><img width=30px height=32px src='img/like_button_unicorn.png' />");
            echo("".$donnees[nb_like]."");
            echo("<br/>");
            echo("<br/></div>");
//            unset($_SESSION[pic_id]);
//            unset($_SESSION[name]);
        }
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
                date_default_timezone_set('Europe/Paris');
                $_SESSION['created'] = date('Y-m-d h:i:s');
                $requete = "INSERT INTO comments (user_id, user_mail, id_picture, comment, created) VALUES ('".$_SESSION['id_user']."', '".$_SESSION['user_mail']."', 
                '".$_SESSION['pic_id']."',
                '".$_POST['message']."',
                '".$_SESSION['created']."');";
                //        MYSQL
                //    $bdd->prepare($requete)->execute();
                
//                $bdd->beginTransaction();
//                $bdd->exec($requete);
//                $bdd->commit();
                
                $reponse = $bdd->prepare($requete);
                $result = $reponse->execute();
                
            }
            $bdd = include("database.php");
            $reponse = $bdd->query("SELECT * FROM comments WHERE id_picture=\"".$_SESSION['pic_id']."\"ORDER BY id DESC;");
            while ($donnees = $reponse->fetch())
            {
//                echo("<br/>");
                echo("<div id=\"comments\">");
                echo("<pre>Le ".$donnees[created]."<br/> <b>".$donnees[user_id]."</b> a commenté:</pre>   ".$donnees[comment]."");
                echo("</div>");
                
            }
        ?>
        
    </body>
    
    
    
    <footer>
        <?php include("Camagru_footer.php"); ?>
    </footer>
</html>