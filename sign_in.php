<?php session_start();

    if((isset($_POST['user_mail']) && $_POST['user_mail'] != NULL)
      && (isset($_POST['password']) && $_POST['password'] != NULL))
    {
            $_SESSION['user_mail'] = $_POST['user_mail'];
            $mdp = hash("sha512", $_POST['password']);
            $mdp_2 = hash("sha512", $mdp);
            $_SESSION['mdp'] = $mdp_2;
    }
        
    else {
        $_SESSION['form_complete'] = "KO";
        header('Location: my_account.php');
        exit();
    }
?>