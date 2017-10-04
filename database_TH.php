<?php

// Try essaie d'acceder a mysql, si cela echoue, 
// et pour eviter que php n'affiche la ligne qui pose probleme, 
// on lance catch qui recupere le message d'erreur envoyer
// par PDO.
    try{
//        $bdd = new PDO('mysql:host=localhost;dbname=camagru;charset=utf8',
//              'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        $bdd = new PDO("sqlite:camagru", "safsaf", "mdpsupersecret");
        //Etablie une connexion avec la base de donnees.
        //N'a besoin d'etre faite qu'une seule fois, 
        //en debut de page
        //Le dernier paramettre permet d'activer les erreurs,
        //ainsi elles seront plus claires a comprendre.
    }
    catch (Exception $error){
        die('An error occurred while connecting to mysql. Here\'s the error:' . $error->getMessage());
    }

    //Recupere les infos demandees par la requete.
    //$reponse = $bdd->query('SELECT * FROM ?');

    $requete = "CREATE TABLE IF NOT EXISTS users (
        id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        login VARCHAR(100) CHARACTER SET utf8,
        mail VARCHAR(255) CHARACTER SET utf8,
        password VARCHAR(255) CHARACTER SET utf8,
        created DATETIME NOT NULL
    )ENGINE=INNODB;";
//    $bdd->prepare($requete)->execute();

    $requete .= "CREATE TABLE IF NOT EXISTS pictures (
        id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        id_picture VARCHAR(100) CHARACTER SET utf8,
        login VARCHAR(100) CHARACTER SET utf8,
        nb_like INT,
        data_picture VARCHAR(255) CHARACTER SET utf8,
        created DATETIME NOT NULL
    )ENGINE=INNODB;";
//    $bdd->prepare($requete)->execute();

    $requete .= "CREATE TABLE IF NOT EXISTS comments (
        id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        login VARCHAR(100) CHARACTER SET utf8,
        id_picture VARCHAR(100) CHARACTER SET utf8,
        comment TEXT CHARACTER SET utf8,
        created DATETIME NOT NULL
    )ENGINE=INNODB;";

    $requete .= "INSERT INTO users (login, mail, password) VALUES ('mee', 'mee@html.com', 'superpswd');";
    // CODE DE THOMAS
    $bdd->beginTransaction();
    $bdd->exec($requete);
    $bdd->commit();
//    $bdd->prepare($requete)->execute();
    //[...] or die(print_r($bdd->errorInfo()));

    // Affiche chaque entrée une à une
   // while ($donnees = $reponse->fetch())
   // {
   //     ...
   // }

    //Il faut fermer $reponse; Cela indique que l'on a fini
    //de travailler sur la requete.
   // $reponse->closeCursor();

return ($bdd);

?>