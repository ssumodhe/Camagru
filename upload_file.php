<?php session_start(); ?>
<!DOCTYPE HTML>
<html>
    <form method="post" action="" enctype="multipart/form-data">
        <input type="hidden" name="MAX_FILE_SIZE" value="1048576" />
        <input type="file" name="file_upload"/>
        <input type="submit" value="Upload" />
    </form>
    
    <?php

        if(isset($_FILES[file_upload]))
        {
//            print_r($_FILES);
//        <!-- ----- -->
//        <!-- Check -->
//        <!-- ----- -->
//        Pour un securité++,il faudrait regarder le type MIME du fichier uploadé.
            $extensions = array('.png', '.gif', '.jpg', '.jpeg');
            $files_ext = strrchr($_FILES['file_upload']['name'], '.');
            $max_size = 1048576;
            $files_size = filesize($_FILES['file_upload']['tmp_name']);
            if ($_FILES['file_upload']['error'] > 0) 
            {
                unset($_FILES[file_upload]);
                echo("<p id='error'>Une erreur est survenue lors du tranfert du fichier.</p>");
            }
            else if(!in_array($files_ext, $extensions))
            {
                unset($_FILES[file_upload]);
                echo("<p id='error'>Vous devez uploader un fichier de type png, gif, jpg, jpeg.</p>");
            }
            else if(files_size > max_size)
            {
                unset($_FILES[file_upload]);
                echo("<p id='error'>Votre fichier est trop gros.</p>");
            }
            else
            {           
//        <!-- ------------- -->
//        <!-- Upload & Save -->
//        <!-- ------------- -->
                if(!file_exists("img"))
                    mkdir("img", 0777, true);
                if(!file_exists("img/uploaded_files"))
                    mkdir("img/uploaded_files", 0777, true);
            
                
            
                $nom = md5(uniqid(rand(), true));
                $nom .= ".png";
                $path = "img/uploaded_files/".$nom."";
                $resultat = move_uploaded_file($_FILES['file_upload']['tmp_name'], $path);
                if ($resultat)
                {
//                   echo("<b>Transfert réussi</b>");
                $_SESSION[upload_file] = $path;
                }       
//                echo("<br/>");
            }

        }

    ?>
    
</html>