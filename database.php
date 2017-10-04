<?php

$DB_DSN = "mysql:host=localhost;dbname=camagru;charset=utf8";
$DB_USER = "root";
$DB_PASSWORD = "root";
// Try essaie d'acceder a mysql, si cela echoue, 
// et pour eviter que php n'affiche la ligne qui pose probleme, 
// on lance catch qui recupere le message d'erreur envoyer
// par PDO.
    try{
        $bdd = new PDO($DB_DSN,
              $DB_USER, $DB_PASSWORD, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        //Etablie une connexion avec la base de donnees.
        //N'a besoin d'etre faite qu'une seule fois, 
        //en debut de page
        //Le dernier paramettre permet d'activer les erreurs,
        //ainsi elles seront plus claires a comprendre.
    }
    catch (Exception $error){
        die('An error occurred while connecting to mysql. Here\'s the error:' . $error->getMessage());
    }

    
    return $bdd;
?>