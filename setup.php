<?php
    $bdd = include("database.php");
    
    //Recupere les infos demandees par la requete.
    //$reponse = $bdd->query('SELECT * FROM ?');

    $requete = "CREATE TABLE IF NOT EXISTS users (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    login VARCHAR(100) CHARACTER SET utf8,
    mail VARCHAR(255) CHARACTER SET utf8,
    password VARCHAR(255) CHARACTER SET utf8,
    created DATETIME NOT NULL
    )ENGINE=INNODB";
    $bdd->prepare($requete)->execute();

    $requete = "CREATE TABLE IF NOT EXISTS pictures (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    id_picture VARCHAR(100) CHARACTER SET utf8,
    login VARCHAR(100) CHARACTER SET utf8,
    nb_like INT,
    data_picture LONGTEXT CHARACTER SET utf8,
    created DATETIME NOT NULL
    )ENGINE=INNODB";
    $bdd->prepare($requete)->execute();

    $requete = "CREATE TABLE IF NOT EXISTS comments (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    login VARCHAR(100) CHARACTER SET utf8,
    id_picture VARCHAR(100) CHARACTER SET utf8,
    comment TEXT CHARACTER SET utf8,
    created DATETIME NOT NULL
    )ENGINE=INNODB";
    $bdd->prepare($requete)->execute();



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