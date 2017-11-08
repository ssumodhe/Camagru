<!DOCTYPE HTML>
<html>
    <body>
        <div id="copyright">
                <hr color="gainsboro">
            <pre><a href="contact.php"><br/>Nous contacter.<br/></a></pre>
                <pre>© Copyright à Kitty! </pre>
                <img width="40px" height="50px" src="emoji_kitty.gif"/> 
            
        </div>
        
        <?php if(isset($_SESSION[id_user]) && isset($_SESSION[user_mail])
                        && $_SESSION[id_user] == "ze_admin")
        {?>
            <form action="php_info.php">
                <input type='submit' name='php_info' value='php_info'/>
            </form>
        <?php }?>
        
<!--        A VIRER -->
        <?php
        echo("SESSION<br/>");
        print_r($_SESSION);
        ?>
<!--        ------  -->
        
        
    </body>
</html>