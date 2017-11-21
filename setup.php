<?php
    $bdd = require_once("database.php");
    
    //Recupere les infos demandees par la requete.
    //$reponse = $bdd->query('SELECT * FROM ?');

    $requete = "CREATE TABLE IF NOT EXISTS users (
    id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
    login VARCHAR(100),
    mail VARCHAR(255),
    password VARCHAR(255),
    created DATETIME NOT NULL
    );";
//        MYSQL
//    $bdd->prepare($requete)->execute();
   $reponse = $bdd->prepare($requete);
                $result = $reponse->execute();
                    $reponse->closeCursor();


        
    $reponse = $bdd->query("SELECT login FROM users WHERE login=\"ze_admin\";");
    $donnees = $reponse->fetch();
    if ($donnees[login] == NULL)
    {
        date_default_timezone_set('Europe/Paris');
        $date = date('Y-m-d h:i:s');
        $mdp = hash("sha512", "mee");
        $mdp_2 = hash("md5", $mdp);
        unset($mdp);
        $requete = "INSERT INTO users (login, mail, password, created) VALUES ('ze_admin', 'safaiya@sumodhee.com',   '".$mdp_2."', '".$date."');";
//        MYSQL
//    $bdd->prepare($requete)->execute();
        $reponse = $bdd->prepare($requete);
        $result = $reponse->execute();
        unset($mdp_2);
        unset($date);  
    }
    $reponse->closeCursor();
    

    $requete = "CREATE TABLE IF NOT EXISTS pictures (
    id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
    user_id VARCHAR(100),
    user_mail VARCHAR(100),
    nb_like INTEGER,
    nb_view INTEGER,
    data_picture LONGTEXT,
    created DATETIME NOT NULL
    );";
//        MYSQL
//    $bdd->prepare($requete)->execute();
  $reponse = $bdd->prepare($requete);
                $result = $reponse->execute();
                    $reponse->closeCursor();



    $requete = "CREATE TABLE IF NOT EXISTS comments (
    id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
    user_id VARCHAR(100),
    user_mail VARCHAR(100),
    id_picture VARCHAR(100),
    comment TEXT,
    created DATETIME NOT NULL
    );";
//        MYSQL
//    $bdd->prepare($requete)->execute();

    $reponse = $bdd->prepare($requete);
                $result = $reponse->execute();
                    $reponse->closeCursor();
    
$requete = "CREATE TABLE IF NOT EXISTS likes (
    id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
    user_mail VARCHAR(100),
    id_picture VARCHAR(100),
    created DATETIME NOT NULL
    );";
//        MYSQL
//    $bdd->prepare($requete)->execute();

    $reponse = $bdd->prepare($requete);
                $result = $reponse->execute();
                    $reponse->closeCursor();

    //[...] or die(print_r($bdd->errorInfo()));

    // Affiche chaque entrée une à une
   // while ($donnees = $reponse->fetch())
   // {
   //     ...
   // }

    //Il faut fermer $reponse; Cela indique que l'on a fini
    //de travailler sur la requete.
   // $reponse->closeCursor();

?>