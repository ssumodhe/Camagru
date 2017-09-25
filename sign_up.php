<?php session_start();

    if((isset($_POST['id_user']) && $_POST['id_user'] != NULL)
      && (isset($_POST['user_mail']) && $_POST['user_mail'] != NULL)
      && (isset($_POST['password']) && $_POST['password'] != NULL))
    {
            $_SESSION['id_user'] = $_POST['id_user'];
            $_SESSION['user_mail'] = $_POST['user_mail'];
            $mdp = hash("sha512", $_POST['password']);
            $mdp_2 = hash("sha512", $mdp);
            $_SESSION['mdp'] = $mdp_2;
    }
        
    else {
        $_SESSION['subscribe'] = "KO";
        header('Location: my_account.php');
        exit();
    }
?>