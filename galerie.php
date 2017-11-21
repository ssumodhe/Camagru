<?php
session_start();
?>
<!DOCTYPE HTML>
<html>
    <head>
        <?php include("Camagru_header.php"); ?>
    </head>
    
    
    <body>
        <h4 style="color: blue;"><a href="index.php">Rejoignez notre communauté en vous inscrivant! :)<br/>Vous pourrez alors commenter et liker les photos!<br/>C'est par ici!</a></h4>
        <!-- --------------------- -->
        <!-- Partie Pagination 1/2 -->
        <!-- --------------------- -->        
        <?php
        if(isset($_GET[p]) && $_GET[p] == 1)
        {
            $_SESSION[nb_pic_display] = 0;
            $_SESSION[page] = 1;
            $_SESSION[prev_p] = 0;
            $_SESSION[next_p] = 2;
            unset($_SESSION[stop_page]);
            
        }   
        else if(isset($_GET[p]) && $_GET[p] != 1 
               && $_GET[p] == $_SESSION[next_p])
        {
            $_SESSION[nb_pic_display] += 5;
            $_SESSION[page] += 1;
            $_SESSION[prev_p] += 1;
            $_SESSION[next_p] += 1;
        }
        else if(isset($_GET[p]) && $_GET[p] != 1 
               && $_GET[p] == $_SESSION[prev_p])
        {
            $_SESSION[nb_pic_display] -= 5;
            $_SESSION[page] -= 1;
            $_SESSION[prev_p] -= 1;
            $_SESSION[next_p] -= 1;
        }
        
        ?>
        
        <!-- ------------- -->
        <!-- Partie Photos -->
        <!-- ------------- --> 
        <?php 
        $bdd = include("config/database.php");
        $reponse = $bdd->query("SELECT * FROM pictures ORDER BY id DESC LIMIT 5 OFFSET ".$_SESSION[nb_pic_display].";");
        
        $n = 0;
        while ($donnees = $reponse->fetch())
        {
//            $photo = str_replace("data:image/png;base64,", "", $donnees[data_picture]);
            echo("<a href='galerie_pic.php?id=".$donnees[id]."&user=".$donnees[user_id]."'><img src='".$donnees[data_picture]."' />");
            echo("<br/>");
            if ($donnees[user_mail] == $_SESSION[user_mail] && $donnees[user_id] == $_SESSION[id_user])
                echo("Photo de vous. <pre>Vus : ".$donnees[nb_view]."</a></pre>");
            else
                echo("Photo de ".$donnees[user_id].". <pre>Vus : ".$donnees[nb_view]."</a></pre>");
            echo("<br/>");
            echo("<br/>");
            $n++;
        }
        $reponse->closeCursor();
        if($n != 5)
            $_SESSION[stop_page] = "ON";
        
        ?>
        
        <!-- --------------------- -->
        <!-- Partie Pagination 2/2 -->
        <!-- --------------------- -->
        
        <div id="prec_page">
            <?php if(isset($_SESSION[prev_p]) && $_SESSION[prev_p] != 0)
            { ?>
                <a href="galerie.php?p=<?php echo($_SESSION[page] - 1); ?>"><?php echo($_SESSION[page] - 1); ?> </a>
            <?php }?>
            
            <?php echo("".$_SESSION[page].""); ?>
            
            <?php if(!isset($_SESSION[stop_page]) && $_SESSION[stop_page] != "ON")
            {
                unset($_SESSION[stop_page]);?>
                <a href="galerie.php?p=<?php echo($_SESSION[next_p]); ?>"><?php echo($_SESSION[next_p]); ?> </a>
            <?php }?>
        </div>
        
        
   </body>
    
    
    
    
    <footer>
        <?php include("Camagru_footer.php"); ?>
    </footer>
</html>