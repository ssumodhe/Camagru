<?php 
session_start();

//print_r($_POST);
//echo("<br/>");

    if(isset($_POST[filtre]) && $_POST[filtre] != NULL)
    {
//        $photo = $_POST[upload_file];
        
//        $img_infos = getimagesize($_POST[upload_img], $imageinfo);
//        print_r($img_infos);
        
        // Traitement de l'image destination
        $destination = imagecreatefrompng($_POST[upload_img]);
        $largeur_destination = imagesx($destination);
        $hauteur_destination = imagesy($destination);
        
        // Traitement de l'image source
        $source = imagecreatefrompng($_POST[filtre]);
        $largeur_source = imagesx($source);
        $hauteur_source = imagesy($source);
        $black = imagecolorallocatealpha($source, 0, 0, 0, 127);
        imagecolortransparent($source, $black);
        
        // integer representation of the color black (rgb: 0,0,0)
//        $background = imagecolorallocatealpha($source , 255, 255, 255, 0);
        // removing the black from the placeholder
//        imagecolortransparent($source, $background);
//        $source = imagecreatetruecolor($largeur_source, $hauteur_source);
//        imagealphablending($source, false);
//        imagesavealpha($source, true);
//        
        
        
        // VERIFIER L'EXTENSION ET LE MIME DE L'IMAGE UPLOADE avec getimagesize et recp l'exentsion avec image_type_to
        // ET ADDAPTER LE BON IMAGECREATEFROM___
        
  
        // Calcul des coordonnées pour placer l'image source dans l'image de destination
//        $destination_x = ($largeur_destination - $largeur_source)/2;
//        $destination_y =  ($hauteur_destination - $hauteur_source)/2;
//        echo($_POST[pic_display_left]);
//        echo("<br/>");
//        echo($largeur_destination);
//        echo("<br/>");
//        echo($_POST[dest_width]);
//        echo("<br/>");
        
        $destination_x = intval($_POST[pic_display_left]) * intval($largeur_destination) / intval($_POST[dest_width]);
        $destination_y = intval($_POST[pic_display_top]) * intval($hauteur_destination) / intval($_POST[dest_height]);
//        echo($destination_x);
//        echo("<br/>");
//        echo($destination_y);
//        $destination_y = intval($_POST[pic_display_top])/4;
  
        // On place l'image source dans l'image de destination
        $return = imagecopymerge($destination, $source, $destination_x, $destination_y, 0, 0, $largeur_source, $hauteur_source, 100);
 
        
        
        
        

        //Enregistrement de l'image fusionnée
        if(!file_exists("img"))
                mkdir("img", 0777, true);
        if(!file_exists("img/filtres"))
                mkdir("img/filtres", 0777, true);
        $nom = "filtre_";
        $nom .= md5(uniqid(rand(), true));
        $nom .= ".png";
        $path = 'img/filtres/';
        $path .= $nom;
        imagepng($destination, $path);
        
        imagedestroy($source);
        imagedestroy($destination);
        $_SESSION[filtre] = $path;
        unset($_POST[filtre]);
//        unset($_SESSION[upload_file]); ??????
        
    }
    header("Location: home.php");
?>