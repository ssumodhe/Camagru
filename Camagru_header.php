<!DOCTYPE HTML>
<html>
    <header>
        <title> My Camagru !</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="Camagru_CSS.css"/>
        
        <?php
        if(isset($_SESSION[log]) && $_SESSION[log] == "ON")
        {
            echo ("<a href=\"home.php\" style=\"\">
                <h1> Welcome to Camagru !</h1>
                </a>");
        }
        else
        {
            echo ("<h1> Welcome to Camagru !</h1>");
        }
        ?>
        
    </header>
</html>