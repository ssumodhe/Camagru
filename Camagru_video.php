<?php session_start(); 
if(isset($_POST[Back_to_camera]))
{
    unset($_SESSION[upload_file]);
    unset($_POST[Back_to_camera]);
}

?>
<!DOCTYPE HTML>
<html>
    
    <?php if (isset($_SESSION[upload_file]))
    {?>
        <form method="post">
            <input type="submit" name="Back_to_camera" value="Revenir à la caméra" />
        </form>
    <?php } ?>
    
    <div id="display_home_page">
        <!-- ------------- -->
        <!-- Partie camera -->
        <!-- ------------- -->
    <?php if (!isset($_SESSION[upload_file]))
    {?>
    <div class="id_video">
        
        <video id="videoElement" autoplay="true"></video>
        
        <button id="buttonElement" alt="takepic_button">Prendre la photo</button>
        
        <form method="post">
            <input id="hidden_img" name="hidden_img" type="hidden">
            <input id="button_save" type="submit" name="save_pic" value="Sauvegarder" alt="sauvegarder la photo" disabled="disabled">
        </form>
        <?php
            if(isset($_POST['hidden_img']))
            {
                $_SESSION['nb_like'] = 0;
                date_default_timezone_set('Europe/Paris');
                $_SESSION['created'] = date('Y-m-d h:i:s');
                
                $bdd = include("database.php");
                $requete = "INSERT INTO pictures (user_id, user_mail, nb_like, data_picture, created) VALUES (
                '".$_SESSION['id_user']."',
                '".$_SESSION['user_mail']."', '".$_SESSION['nb_like']."',
                '".$_POST['hidden_img']."',
                '".$_SESSION['created']."');";
                //        MYSQL
                //    $bdd->prepare($requete)->execute();
                $reponse = $bdd->prepare($requete);
                $result = $reponse->execute();
                $reponse->closeCursor();
            }
 
        ?>

    <div class="id_rendu">
        <canvas id="canvasElement"></canvas>
    </div>
        
        
    </div>
        <!-- ------------------- -->
        <!-- Partie photo upload -->
        <!-- ------------------- -->
    <?php }
    else
    {?>
        <div>
            
            <img id="imageElement" src="<?php echo($_SESSION[upload_file]) ?>"/>
            
            <?php
          
            if(isset($_POST['upload_img']))
            {
                $_SESSION['nb_like'] = 0;
                date_default_timezone_set('Europe/Paris');
                $_SESSION['created'] = date('Y-m-d h:i:s');
                
                $bdd = include("database.php");
                $requete = "INSERT INTO pictures (user_id, user_mail, nb_like, data_picture, created) VALUES (
                '".$_SESSION['id_user']."',
                '".$_SESSION['user_mail']."', '".$_SESSION['nb_like']."',
                '".$_POST['upload_img']."',
                '".$_SESSION['created']."');";
                //        MYSQL
                //    $bdd->prepare($requete)->execute();
                $reponse = $bdd->prepare($requete);
                $result = $reponse->execute();
                $reponse->closeCursor();
                unset($_SESSION[filtre]);
                unset($_POST['upload_img']);
            }
        ?>
     
            <form method="post">
                <input id="hidden_img" name="upload_img" value="<?php echo($_SESSION[filtre]) ?>" type="hidden"/>
                <input id="button_save" type="submit" name="save_pic" value="Sauvegarder" alt="sauvegarder la photo" <?php if(!isset($_SESSION[filtre])){
                   echo("disabled=disabled"); 
                } ?>/>
            </form>
            
            <?php if(isset($_SESSION[filtre])){
                    echo("<img src=\"".$_SESSION[filtre]."\"/><br/>");
                }
            ?>
 
        <!-- ------------- -->
        <!-- Partie Filtre -->
            
            <div id="form_filtre">
            <form  id="filtre" method="get" action="fusion_image.php">
                <input type='image' name='filtre' value='emoji_kitty.png'  src='emoji_kitty.png'/>
                <input type='image' name='filtre' value='corne-de-licorne.png'  src='corne-de-licorne.png'/>
                <input type='image' name='filtre' value='lunette.png' width=200px src='lunette.png'/>
                <input type='image' name='filtre' value='barbe.png'  width=100px src='barbe.png'/>
                <input type='image' name='filtre' value='afro-hair.png' width=200px src='afro-hair.png'/>
             
<!--
                <select id="filtre" name="filtre" multiple>
                    <option width="100px" value="emoji_kitty.png" style="background:url('emoji_kitty.png') no-repeat; width:100px; height:100px;"></option>
                    <option width="100px" value="corne-de-licorne.png" style="background:url('corne-de-licorne.png') no-repeat; width:100px; height:100px;"></option>
                    <option width="100px" value="lunette.png" style="background:url('lunette.png') no-repeat; width:100px; height:100px;"></option>
                    <option width="100px" value="barbe.png" style="background:url('barbe.png') no-repeat; width:100px; height:100px;"></option>
                    <option width="100px" value="afro-hair.png" style="background:url('afro-hair.png') no-repeat; width:100px; height:100px;"></option>
                </select>
-->
            </form>
            </div>
        <!-- ------------------- -->
        <!-- ------------------- -->
        </div>
    <?php }?>
    
        <!-- ------------------------------ -->
        <!-- Partie previous photos latéral -->
        <!-- ------------------------------ -->
    <div class="prev_pic">
        <?php
        $bdd = include("database.php");
        $reponse = $bdd->query("SELECT * FROM pictures WHERE user_id=\"".$_SESSION[id_user]."\"ORDER BY id DESC;");
        
        while ($donnees = $reponse->fetch())
        {
            echo("<a href='gallery_pic.php?id=".$donnees[id]."&user=".$donnees[user_id]."'><img id='user_pic' width=50% src='".$donnees[data_picture]."' /></a>");
            echo("<br/>");
        }
        $reponse->closeCursor();
        ?>
        
    </div>
        
        
    </div>
    

        

    <script src="webcam.js"></script> 
 
</html>