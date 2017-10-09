<?php
  session_start();

    unset($_SESSION['id_user']);
    unset($_SESSION['user_mail']);

    unset($_SESSION['id_picture']);
    unset($_SESSION['nb_like']);
    unset($_SESSION['created']);


    unset($_SESSION['log']);
        

header('Location: index.php');

?>