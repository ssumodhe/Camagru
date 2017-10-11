<?php session_start(); 
?>
<!DOCTYPE HTML>
<html>
    <head>
        <?php include("Camagru_header.php"); ?>
    </head>
    
    
    <body>
        <?php if(isset($_SESSION[log]))
            {include("Camagru_menu.php");} ?>
        
        <form method="post" action="#">
        
<!--        <form method="post" action="contact_mail.php">-->
            <label>Votre nom :</label><input type="text" name="id_user"
            <?php if(isset($_SESSION[log])){echo("value='".$_SESSION[id_user]."'");} ?>     
            /><br/>
            <label>Votre e-mail :</label><input type="text" name="user_mail"
            <?php if(isset($_SESSION[log])){echo("value='".$_SESSION[user_mail]."'");} ?>     /><br/>
            <label>Votre message :</label><br/>
            <textarea name="message" rows=4 cols=40></textarea><br/> 
            <input type="submit" value="Envoyer!" />
            <br/>
            
        </form>
        
        
           <?php if(!isset($_SESSION[log]))
            {
                echo('<div id="prec_page">
                <a href="index.php">Revenir à la page précédente.</a>
                </div>');
            } ?>
    
    </body>
    
    
    
    <footer>
     
        
        
        <?php include("Camagru_footer.php"); ?>
    </footer>
</html>