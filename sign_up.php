<?php session_start();

    if((isset($_POST['id_user']) && $_POST['id_user'] != NULL)
      && (isset($_POST['user_mail']) && $_POST['user_mail'] != NULL)
      && (isset($_POST['password']) && $_POST['password'] != NULL))
    {
        if (!preg_match("#^[a-z0-9._-]+[@][a-z]+[.][a-z]{2,4}$#", $_POST['user_mail']))
        {
            $_SESSION['form_complete'] = "KO_mail_incorrect";
            header('Location: index.php');
            exit();
        }
        else
        {
            $_SESSION['id_user'] = $_POST['id_user'];
            $_SESSION['user_mail'] = $_POST['user_mail'];
            $mdp = hash("sha512", $_POST['password']);
            $mdp_2 = hash("md5", $mdp);
            
            $bdd = include("database_TH.php");
            $requete = "INSERT INTO users (login, mail, password) VALUES ('".$_SESSION['id_user']."', '".$_SESSION[user_mail]."', '".$mdp_2."');";
//            // CODE DE THOMAS
//            $bdd->beginTransaction();
//            $bdd->exec($requete);
//            $bdd->commit();
//              $_SESSION[log] = "ON";
//            require("mailing.php");
//            header('Location: home.php');
//            exit();
        
        $bdd = include("database.php");
        
        $reponse = $bdd->query("SELECT mail FROM users WHERE mail=\"".$_SESSION['user_mail']."\";");
        $donnees = $reponse->fetch();
        
        if ($donnees[mail] != NULL)
        {
            $_SESSION['form_complete'] = "KO_mail_exist";
            header('Location: index.php');
            exit();
        }
        else
        {
            $requete = "INSERT INTO users (login, mail, password) VALUES ('".$_SESSION['id_user']."', '".$_SESSION[user_mail]."', '".$mdp_2."');";
            $bdd->prepare($requete)->execute();
            $_SESSION[log] = "ON";
            require("mailing.php");
            header('Location: home.php');
            exit();
        }
        }
    }
        
    else {
        $_SESSION['form_complete'] = "KO";
        header('Location: index.php');
        exit();
    }
?>