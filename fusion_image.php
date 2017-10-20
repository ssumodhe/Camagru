<?php session_start();
//     header ("Content-type: image/png");
//if(!isset($_SESSION[log]))
//{
//    header("Location: index.php");
//}
    
    $gd_array = gd_info();
    print_r($gd_array);
    if(isset($_GET[filtre]))
    {
        $photo = $_SESSION[upload_file];
        
        echo("<img src=\"".$photo."\" />");
        echo("<img src=\"".$_GET[filtre]."\" />");
        
        $size_filtre = getimagesize($_GET[filtre]);
        $size_photo = getimagesize($photo);
      
        echo("<br/>");
        echo("PHOTO SIZE = ");
        print_r($size_photo);
        echo("<br/>");
        echo("FILTRE SIZE = ");
        print_r($size_filtre);
        echo("<br/>");
        
//ob_clean();
     
// Traitement de l'image source
$source = imagecreatefromgif($_GET[filtre]);
$largeur_source = imagesx($source);
$hauteur_source = imagesy($source);
 
// Traitement de l'image destination
$destination = imagecreatefrompng($photo);
$largeur_destination = imagesx($destination);
$hauteur_destination = imagesy($destination);
  
// Calcul des coordonnées pour placer l'image source dans l'image de destination
$destination_x = ($largeur_destination - $largeur_source)/2;
$destination_y =  ($hauteur_destination - $hauteur_source)/2;
  
// On place l'image source dans l'image de destination
$return = imagecopymerge($destination, $source, $destination_x, $destination_y, 0, 0, $largeur_source, $hauteur_source, 100);
//imagecopymerge($photo, $_GET[filtre], 10, 10, 0, 0, 50,);
 
// On affiche l'image de destination
//        echo("<img src=\"".imagepng($destination)."\" />");

        ob_start();
imagepng($destination);
$image_data = ob_get_contents();
ob_end_clean();
        
//        echo("<br/>");
//        imagepng($destination);
// 
//imagedestroy($source);
//imagedestroy($destination);
    }
//phpinfo();
?>