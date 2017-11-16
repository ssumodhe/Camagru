<?php
session_start();

//Déclaration de l'adresse de destination.
$mail = $_SESSION[user_mail]; 
if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $mail)) // On filtre les serveurs qui rencontrent des bogues.
{
	$passage_ligne = "\r\n";
}
else
{
	$passage_ligne = "\n";
}

//=====Déclaration des messages au format texte et au format HTML.
$message_txt = "Hello, un autre membre vient de commenter une de tes photos avec le commentaire suivant: ".$_SESSION[comment]."";
$message_html = "<html><head></head><body><b>Hello,</b><br/> un autre membre vient de commenter une de tes photos avec le commentaire suivant:<br/> <pre>".$_SESSION[comment]."</pre></body></html>";
//==========
unset($_SESSION[comment]);

//=====Création de la boundary
$boundary = "-----=".md5(rand());
//==========


//=====Définition du sujet.
$sujet = "Tu as un nouveau commentaire!";
//=========


//=====Création du header de l'e-mail.
$header = "From: \"Saf's Camagru\"<saf@camagru.com>".$passage_ligne;
$header.= "Reply-to: \"Saf\" <saf@camagru.com>".$passage_ligne;
//$header.= "To: ".$mail." <"$mail">".$passage_ligne;
//$header.= "Delivered-to: ".$mail."".$passage_ligne;
$header.= "MIME-Version: 1.0".$passage_ligne;
//$header .= "X-Priority: 3".$passage_ligne;
$header.= "Content-Type: multipart/alternative;".$passage_ligne." boundary=\"$boundary\"".$passage_ligne;
//==========


//=====Création du message.
$message = $passage_ligne."--".$boundary.$passage_ligne;
//=====Ajout du message au format texte.
$message.= "Content-Type: text/plain; charset=\"ISO-8859-1\"".$passage_ligne;
$message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
$message.= $passage_ligne.$message_txt.$passage_ligne;
//==========
$message.= $passage_ligne."--".$boundary.$passage_ligne;
//=====Ajout du message au format HTML
$message.= "Content-Type: text/html; charset=\"ISO-8859-1\"".$passage_ligne;
$message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
$message.= $passage_ligne.$message_html.$passage_ligne;
//==========
$message.= $passage_ligne."--".$boundary."--".$passage_ligne;
$message.= $passage_ligne."--".$boundary."--".$passage_ligne;
//==========
 

mail($mail,$sujet,$message,$header);

?>