<?php session_start(); ?>
<!DOCTYPE HTML>
<html>
    <form method="post" action="" enctype="multipart/form-data">
        <input type="hidden" name="MAX_FILE_SIZE" value="1048576" />
        <input type="file" name="file_upload"/>
        <input type="submit" value="Upload" />
    </form>
    
    <?php

        if(isset($_FILES))
        {
//            print_r($_FILES);
            
          
//            echo("<br/>");
            
            if(!file_exists("img"))
                mkdir("img", 0777, true);
            if(!file_exists("img/uploaded_files"))
                mkdir("img/uploaded_files", 0777, true);
            
            if ($_FILES['icone']['error'] > 0) 
                echo("<b>Erreur lors du transfert</b>");
            
            $nom = md5(uniqid(rand(), true));
            $nom .= ".png";
            $path = "img/uploaded_files/".$nom."";
            $resultat = move_uploaded_file($_FILES['file_upload']['tmp_name'], $path);
            if ($resultat)
            {
//                echo("<b>Transfert réussi</b>");
                $_SESSION[upload_file] = $path;
            }
            
            echo("<br/>");
//         
//            
//            echo("<img src=\"".$path."\">");
            
//            $image_sizes = getimagesize($path);
//            echo("<br/>");
//            echo("<br/>");
//            echo("<br/>");
//            
//            print_r($image_sizes);

        }

    ?>
    
</html>