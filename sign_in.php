<?php session_start();

   if((isset($_POST['user_mail']) && $_POST['user_mail'] != NULL)
      && (isset($_POST['password']) && $_POST['password'] != NULL))
    {
            $_SESSION['user_mail'] = $_POST['user_mail'];
            $mdp = hash("sha512", $_POST['password']);
            $mdp_2 = hash("md5", $mdp);
            //$_SESSION['mdp'] = $mdp_2;
       
        
        
            $bdd = include("database.php");
//         $requete = "SELECT * FROM users WHERE 'mail'=\"".$_SESSION['user_mail']."\" AND 'password'=\"".$mdp_2."\";";
       
       $requete = "SELECT * FROM users WHERE `mail`=\"".$_SESSION['user_mail']."\";";
       $result = $bdd->query($requete);
       $data = $result->fetch();
       $result->closeCursor();
       if(isset($data['mail']) && $data['mail'] != NULL)
       {
            if($data['password'] === $mdp_2)
            {
                $_SESSION['id_user'] = $data[login];
                $_SESSION[log] = "ON";
                header('Location: home.php');
                exit();
            }
            else{
                $_SESSION['form_complete'] = "KO_sign_in";
                header('Location: index.php');
                exit();
            }
       }
       else
       {
            $_SESSION['form_complete'] = "KO_sign_in";
           header('Location: index.php');
           exit(); 
       }
//        print_r($data[mail]);
            
    }
        
    else {
        $_SESSION['form_complete'] = "KO";
        header('Location: index.php');
        exit();
    }
?>