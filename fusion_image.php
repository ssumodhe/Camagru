<?php 
session_start();

//print_r($_POST);

    if(isset($_POST[upload_img]) && $_POST[upload_img] != NULL)
    {
      
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

        
        $new_src_x = intval($largeur_destination) * intval($largeur_source) / intval($_POST[dest_width]);
        $new_src_y = intval($hauteur_destination) * intval($hauteur_source) / intval($_POST[dest_height]);
        
            
        // VERIFIER L'EXTENSION ET LE MIME DE L'IMAGE UPLOADE avec getimagesize et recp l'exentsion avec image_type_to
        // ET ADDAPTER LE BON IMAGECREATEFROM___
        
  
        $image_p = imagecreatetruecolor($new_src_x, $new_src_y);
        imagealphablending($image_p,false);
        imagesavealpha($image_p,true);
        imagecopyresampled($image_p, $source, 0, 0, 0, 0, $new_src_x, $new_src_y, $largeur_source, $hauteur_source);
        $black = imagecolorallocatealpha($image_p, 0, 0, 0, 127);
        imagecolortransparent($image_p, $black);        
        
        
        $destination_x = intval($_POST[pic_display_left]) * intval($largeur_destination) / intval($_POST[dest_width]);
        $destination_y = intval($_POST[pic_display_top]) * intval($hauteur_destination) / intval($_POST[dest_height]);

  
        // On place l'image source dans l'image de destination
        $return = imagecopymerge($destination, $image_p, $destination_x, $destination_y, 0, 0, $new_src_x, $new_src_y, 100);
 
        
        
        
        

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
        
        
        if (isset($_SESSION[upload_file]))
        {
                $_SESSION['nb_like'] = 0;
                $_SESSION['nb_view'] = 0;
                date_default_timezone_set('Europe/Paris');
                $_SESSION['created'] = date('Y-m-d h:i:s');
                
                $bdd = include("database.php");
                $requete = "INSERT INTO pictures (user_id, user_mail, nb_like, nb_view, data_picture, created) VALUES (
                '".$_SESSION['id_user']."',
                '".$_SESSION['user_mail']."', 
                '".$_SESSION['nb_like']."',
                '".$_SESSION['nb_view']."',
                '".$_SESSION[filtre]."',
                '".$_SESSION['created']."');";
                //        MYSQL
                //    $bdd->prepare($requete)->execute();
                $reponse = $bdd->prepare($requete);
                $result = $reponse->execute();
                $reponse->closeCursor();
//                unset($_SESSION[filtre]);
                unset($_SESSION[created]);
                unset($_SESSION[nb_like]);
                unset($_SESSION[nb_view]);
                unset($_POST['upload_img']);
                unset($_POST[filtre]);
//        unset($_SESSION[upload_file]);
        }
        
    }
    else if(isset($_POST[hidden_img]) && $_POST[hidden_img] != NULL)
    {
      
        // Traitement de l'image destination
        $destination = imagecreatefrompng($_POST[hidden_img]);
        $largeur_destination = imagesx($destination);
        $hauteur_destination = imagesy($destination);

        // Traitement de l'image source
        $source = imagecreatefrompng($_POST[filtre]);
        $largeur_source = imagesx($source);
        $hauteur_source = imagesy($source);
        $black = imagecolorallocatealpha($source, 0, 0, 0, 127);
        imagecolortransparent($source, $black);

        
        $new_src_x = intval($largeur_destination) * intval($largeur_source) / intval($_POST[dest_width]);
        $new_src_y = intval($hauteur_destination) * intval($hauteur_source) / intval($_POST[dest_height]);
        
            
        // VERIFIER L'EXTENSION ET LE MIME DE L'IMAGE UPLOADE avec getimagesize et recp l'exentsion avec image_type_to
        // ET ADDAPTER LE BON IMAGECREATEFROM___
        
  
        $image_p = imagecreatetruecolor($new_src_x, $new_src_y);
        imagealphablending($image_p,false);
        imagesavealpha($image_p,true);
        imagecopyresampled($image_p, $source, 0, 0, 0, 0, $new_src_x, $new_src_y, $largeur_source, $hauteur_source);
        $black = imagecolorallocatealpha($image_p, 0, 0, 0, 127);
        imagecolortransparent($image_p, $black);        
        
        
        $destination_x = intval($_POST[pic_display_left]) * intval($largeur_destination) / intval($_POST[dest_width]);
        $destination_y = intval($_POST[pic_display_top]) * intval($hauteur_destination) / intval($_POST[dest_height]);

  
        // On place l'image source dans l'image de destination
        $return = imagecopymerge($destination, $image_p, $destination_x, $destination_y, 0, 0, $new_src_x, $new_src_y, 100);
 
        
        
        
        

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

        
    }
    header("Location: home.php");
?>