<?php
session_start();
$mail = $_SESSION[user_mail]; // Déclaration de l'adresse de destination.
if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $mail)) // On filtre les serveurs qui rencontrent des bogues.
{
	$passage_ligne = "\r\n";
}
else
{
	$passage_ligne = "\n";
}
//=====Déclaration des messages au format texte et au format HTML.
$message_txt = "Hello, Tu viens de t'inscrire à Camagru. Tu peux venir t'y amuser et prendre plein de photos! Amuses toi bien";
$message_html = "<html><head></head><body><b>Hello,</b><br/> Tu viens de t'inscrire à <i>Camagru</i>.<br/>Tu peux venir t'y amuser et prendre plein de photos! Amuses toi bien!</body></html>";
//==========
 
//=====Création de la boundary
$boundary = "-----=".md5(rand());
//==========
 
//=====Définition du sujet.
$sujet = "Hello! You are now one of us!";
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
////=====Ajout du message au format texte.
//$message.= "Content-Type: text/plain; charset=\"ISO-8859-1\"".$passage_ligne;
//$message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
//$message.= $passage_ligne.$message_txt.$passage_ligne;
////==========
//$message.= $passage_ligne."--".$boundary.$passage_ligne;
//=====Ajout du message au format HTML
$message.= "Content-Type: text/html; charset=\"ISO-8859-1\"".$passage_ligne;
$message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
$message.= $passage_ligne.$message_html.$passage_ligne;
//==========
$message.= $passage_ligne."--".$boundary."--".$passage_ligne;
$message.= $passage_ligne."--".$boundary."--".$passage_ligne;
//==========
 

$return = mail($mail,$sujet,$message,$header);
//if ($return == true)
//{
//    echo("Mail envoyé");
//}
//else
//{
//    echo("Probleme mail");
//}
?>