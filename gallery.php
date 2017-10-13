<?php
session_start();
if(!isset($_SESSION[log]))
{
    header("Location: index.php");
}
if(isset($_GET[p]) && $_GET[p] != 1 && $_GET[p] != $_SESSION[next_p])
{
    header("Location: gallery.php?p=1");
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
        
        <?php
        
        
        if(isset($_GET[p]) && $_GET[p] == 1)
        {
            $_SESSION[nb_pic_display] = 0;
            $_SESSION[page] = 1;
            $_SESSION[next_p] = 2;
            unset($_SESSION[stop_page]);
            
        }   
        else if(isset($_GET[p]) && $_GET[p] != 1 
               && $_GET[p] == $_SESSION[next_p])
        {
            $_SESSION[nb_pic_display] += 5;
            $_SESSION[page] += 1;
            $_SESSION[next_p] += 1;
        }
        
        ?>
        
        <?php 
        
        $bdd = include("database.php");
        $reponse = $bdd->query("SELECT * FROM pictures ORDER BY id DESC LIMIT 5 OFFSET ".$_SESSION[nb_pic_display].";");
        
        $n = 0;
        while ($donnees = $reponse->fetch())
        {
//            $photo = str_replace("data:image/png;base64,", "", $donnees[data_picture]);
            echo("<a href='gallery_pic.php?id=".$donnees[id]."&user=".$donnees[user_id]."'><img src='".$donnees[data_picture]."' />");
            echo("<br/>");
            if ($donnees[user_mail] == $_SESSION[user_mail])
                echo("Photo de vous.</a>");
            else
                echo("Photo de ".$donnees[user_id].".</a>");
            echo("<br/>");
            echo("<br/>");
            $n++;
        }
        if($n != 5)
            $_SESSION[stop_page] = "ON";
        
        ?>
        <div id="prec_page">
            <?php echo("<br/>".$_SESSION[page]."<br/>"); ?>
            <?php if(!isset($_SESSION[stop_page]) && $_SESSION[stop_page] != "ON")
            {
                unset($_SESSION[stop_page]);?>
                <a href="gallery.php?p=<?php echo($_SESSION[next_p]); ?>"><?php echo($_SESSION[next_p]); ?> </a>
            <?php }?>
            <br/>
        </div>
        
        
   </body>
    
    
    
    
    <footer>
        <?php include("Camagru_footer.php"); ?>
    </footer>
</html>