<?php 
session_start();

    if(isset($_GET[filtre]))
    {
        $photo = $_SESSION[upload_file];
        
        $img_infos = getimagesize($_GET[filtre], $imageinfo);
//        print_r($img_infos);
        
        // Traitement de l'image source
        $source = imagecreatefrompng($_GET[filtre]);
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
        
        // Traitement de l'image destination
        $destination = imagecreatefrompng($photo);
        $largeur_destination = imagesx($destination);
        $hauteur_destination = imagesy($destination);
  
        // Calcul des coordonnées pour placer l'image source dans l'image de destination
        $destination_x = ($largeur_destination - $largeur_source)/2;
        $destination_y =  ($hauteur_destination - $hauteur_source)/2;
  
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
        unset($_GET[filtre]);
//        unset($_SESSION[upload_file]); ??????
        
    }
    header("Location: home.php");
?>