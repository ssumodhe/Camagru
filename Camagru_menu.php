<!DOCTYPE HTML>
<html>
    <body>
        <div id="menu">
            <ul>
                <li><a href="home.php" title="Accueil">Accueil</a></li>
                <li><a href="my_profil.php" title="Votre espace photos">Galerie</a></li>
                
                <li><a href="my_account.php" title="Votre espace membre">Bonjour, <?php echo($_SESSION['id_user'])?>.</a>
                <a href="sign_out.php"><img src=img/deco_button.png width="20px" height="20px"></a>
                </li>
                
            </ul>
        </div>
    </body>
</html>