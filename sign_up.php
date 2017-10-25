<?php session_start();

    if((isset($_POST['id_user']) && $_POST['id_user'] != NULL)
      && (isset($_POST['user_mail']) && $_POST['user_mail'] != NULL)
      && (isset($_POST['password']) && $_POST['password'] != NULL)
      && (isset($_POST['password_2']) && $_POST['password_2'] != NULL))
    {
        if ($_POST['password'] != $_POST['password_2'])
        {
            $_SESSION['form_complete'] = "KO_pswd_not_same";
            header('Location: index.php');
            exit();
        }
        
        if (!preg_match("#^[a-z0-9._-]+[@][a-z-]+[.][a-z]{2,4}$#", $_POST['user_mail']))
        {
            $_SESSION['form_complete'] = "KO_mail_incorrect";
            header('Location: index.php');
            exit();
        }
        else
        {
            $_SESSION['id_user'] = strtolower($_POST['id_user']);
            $_SESSION['user_mail'] = strtolower($_POST['user_mail']);
            $mdp = hash("sha512", $_POST['password']);
            unset($_POST['password']);
            $mdp_2 = hash("md5", $mdp);
            unset($mdp);
            
            
//            $bdd = include("database_TH.php");
//            $requete = "INSERT INTO users (login, mail, password) VALUES ('".$_SESSION['id_user']."', '".$_SESSION[user_mail]."', '".$mdp_2."');";
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
        $reponse->closeCursor();
            
        $rep = $bdd->query("SELECT login FROM users WHERE login=\"".$_SESSION['id_user']."\";");
        $donnees = $rep->fetch();
        if ($donnees[login] != NULL)
        {
            $_SESSION['form_complete'] = "KO_login_exist";
            header('Location: index.php');
            exit();
        }  
        else
        {
            date_default_timezone_set('Europe/Paris');
            $_SESSION['created'] = date('Y-m-d h:i:s');
            $requete = "INSERT INTO users (login, mail, password, created) VALUES ('".$_SESSION['id_user']."', '".$_SESSION[user_mail]."', 
            '".$mdp_2."',
            '".$_SESSION['created']."');";
            //        MYSQL
            //    $bdd->prepare($requete)->execute();
            $reponse = $bdd->prepare($requete);
            $result = $reponse->execute();
            $reponse->closeCursor();
            $_SESSION[log] = "ON";
            unset($mdp);
            unset($mdp_2);
            require("mailing.php");
            header('Location: home.php');
            exit();
        }
        $rep->closeCursor();
        }
    }
        
    else {
        $_SESSION['form_complete'] = "KO";
        header('Location: index.php');
        exit();
    }
?>