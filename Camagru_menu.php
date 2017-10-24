<!DOCTYPE HTML>
<html>
    <body>
        <div id="menu">
            <ul>
                <li><a href="home.php" title="Accueil">Accueil</a></li>
                <li><a href="gallery.php?p=1" title="Votre espace photos">Galerie</a></li>
                
                <li><a href="my_account.php" title="Votre espace membre">Bonjour, <?php echo($_SESSION['id_user'])?>.</a>
                <a href="sign_out.php"><img src=img/deco_button.png width="20px" height="20px"></a>
                </li>
                <?php if(isset($_SESSION[id_user]) && isset($_SESSION[user_mail])
                        && $_SESSION[id_user] == "ze_admin")
                        {?>
                <li><a href="im_admin.php" title="Espace_ADMIN">My_Admin</a></li>
                <?php }?>
            </ul>
        </div>
    </body>
</html>