<?php session_start(); 
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
        <h4 style="color: blue;"><a href="index.php">Rejoignez notre communauté en vous inscrivant! :)<br/>Vous pourrez alors commenter et liker les photos!<br/>C'est par ici!</a></h4>
        
        <?php
        $bdd = include("config/database.php");
            $requete = $bdd->query("SELECT nb_view FROM pictures WHERE id=\"".htmlspecialchars($_GET['id'])."\";");
            $donnees = $requete->fetch();
            $nb_view = $donnees[nb_view];
            $requete->closeCursor();
            $nb_view = $nb_view + 1;
            unset($requete);
            unset($donnees);
            $requete = ("UPDATE pictures SET nb_view=".$nb_view." WHERE id=\"".htmlspecialchars($_GET['id'])."\";");
            $reponse = $bdd->prepare($requete);
            $result = $reponse->execute();
            $reponse->closeCursor();
            unset($requete);
            unset($reponse);
            unset($result);
            unset($nb_view);
        ?>
        
        <?php  echo('<div id="prec_page">
        <a href="galerie.php?'.$_SESSION[page].'">Revenir à la galerie.</a>
        </div>');?>
        
        <!-- ------------------- -->
        <!-- Partie photo + like -->
        <!-- ------------------- -->
        <?php
        
        if(isset($_GET[id]) && isset($_GET[user]) && $_GET[id] != NULL && $_GET[user]!= NULL)
        {
            $_SESSION[pic_id] = htmlspecialchars($_GET[id]);
            $_SESSION[name] = htmlspecialchars($_GET[user]);
            unset($_GET[id]);
            unset($_GET[user]);
        
        
        $bdd = include("config/database.php");
        
        
        $requete = $bdd->query("SELECT * FROM pictures WHERE id=\"".$_SESSION['pic_id']."\";");
        $donnees = $requete->fetch();
        
        if($donnees[user_id] == $_SESSION[name])
        {
            echo("Photo de ".$donnees[user_id].".");
            echo("<br/>");
            echo("<img src='".$donnees[data_picture]."' />");
            echo("<br/>");
            echo("<div id='info_pic'>Crée le ".$donnees[created]." <br/>Vus : ".$donnees[nb_view]."");
            echo("<form action='gallery_pic.php' method='GET'>
            <input type='hidden' name='id' value='".$_SESSION[pic_id]."' />
            <input type='hidden' name='user' value='".$_SESSION[name]."' />
            <input id='like_button' type='image' name='likeup' value='oneup' width=30px height=32px src='img/like_button_unicorn.png' disabled='disabled'/> </form>");
            
            echo("".$donnees[nb_like]."");
            echo("<br/>");
            echo("<br/></div>");
            $_SESSION[pic_id_comment] = $_SESSION[pic_id];
            unset($_SESSION[pic_id]);
            unset($_SESSION[name]);
        }
        }
        else
        {
            header("Location: galerie.php?p=1");
        }
     
        ?>
        
        <!-- ------------------- -->
        <!-- Partie Commentaires -->
        <!-- ------------------- -->
        
        <?php
            
            if(isset($_SESSION[pic_id_comment]))
            {
            $bdd = include("config/database.php");
            $reponse = $bdd->query("SELECT * FROM comments WHERE id_picture=\"".$_SESSION['pic_id_comment']."\"ORDER BY id DESC;");
            while ($donnees = $reponse->fetch())
            {
                echo("<div id=\"comments\">");
                echo("<pre>Le ".$donnees[created]."<br/> <b>".$donnees[user_id]."</b> a commenté:</pre>   ".$donnees[comment]."");
                echo("</div>");
                
            }
            $reponse->closeCursor();
            unset($donnees);
            unset($_SESSION[pic_id_comment]);
            }
        ?>
        
    </body>
    
    
    
    <footer>
        <?php include("Camagru_footer.php"); ?>
    </footer>
</html>