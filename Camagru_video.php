<?php session_start(); 
if(isset($_POST[Back_to_camera]))
{
    unset($_SESSION[upload_file]);
    unset($_POST[Back_to_camera]);
    unset($_SESSION[filtre]);
}
if(isset($_POST[filtre]))
{
    unset($_SESSION[filtre]);
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
        
        <div style="height: 400px; text-align: left;">
                <div style="position: absolute;">
                    <video class="drophere" id="videoElement" autoplay="true"></video>
                </div>
                
                <?php if(isset($_POST[filtre])){?>
                <input type="hidden" id="f_left" name="f_left" value="0"/>
                <input type="hidden" id="f_top" name="f_top" value="0"/>
                <img class="dragme" style="position: relative; left: 0px; top: 0px;" src="<?php echo($_POST[filtre]); ?>"/>
                <?php 
                }?>
            
        </div>
        
        <form id="form_fusion" method="post" action="fusion_image.php">
<!--        <button id="buttonElement" alt="takepic_button" 
<?php //if(!isset($_POST[filtre])){echo("disabled='disabled'");}?>
>Prendre la photo</button>-->
            <input type="hidden" id="hidden_img" name="hidden_img" >
            <input type="hidden" id="filtre" name="filtre" value="<?php echo($_POST[filtre]) ?>"/>  
            <input type="hidden" id="pic_display_left" name="pic_display_left" value="0"/>
            <input type="hidden" id="pic_display_top" name="pic_display_top" value="0"/>
            <input type="hidden" id="dest_width" name="dest_width" value="0"/>
            <input type="hidden" id="dest_height" name="dest_height" value="0"/>  
            <input type="submit" name="takepic_button" id="buttonElement" alt="takepic_button" <?php if(!isset($_POST[filtre])){echo("disabled='disabled'");}?> value="Prendre la photo"/>
        </form>
        
        
        
        <form method="post">
<!--
            <input type="hidden" id="hidden_img" name="hidden_img" >
            <input type="hidden" id="filtre" name="filtre" value="<?php echo($_POST[filtre]) ?>"/>
-->
<!--
                <input type="hidden" id="pic_display_left" name="pic_display_left" value="0"/>
                <input type="hidden" id="pic_display_top" name="pic_display_top" value="0"/>
                <input type="hidden" id="dest_width" name="dest_width" value="0"/>
                <input type="hidden" id="dest_height" name="dest_height" value="0"/>
-->
            <input type="hidden" name="img_to_save" value="<?php echo($_SESSION[filtre]) ?>">
            <input id="button_save" type="submit" name="save_pic" value="Sauvegarder" alt="sauvegarder la photo" <?php if(!isset($_SESSION[filtre])){echo("disabled='disabled'");}?>>
        </form>
        
        <?php
            if(isset($_POST[img_to_save]))
            {
                $_SESSION['nb_like'] = 0;
                date_default_timezone_set('Europe/Paris');
                $_SESSION['created'] = date('Y-m-d h:i:s');
                
                $bdd = include("database.php");
                $requete = "INSERT INTO pictures (user_id, user_mail, nb_like, data_picture, created) VALUES (
                '".$_SESSION['id_user']."',
                '".$_SESSION['user_mail']."', '".$_SESSION['nb_like']."',
                '".$_POST[img_to_save]."',
                '".$_SESSION['created']."');";
                //        MYSQL
                //    $bdd->prepare($requete)->execute();
                $reponse = $bdd->prepare($requete);
                $result = $reponse->execute();
                $reponse->closeCursor();
                unset($_SESSION[filtre]);
            }
 
        ?>
        
        <div class="id_rendu">
<!--        <canvas style="visibility:hidden;" id="canvasElement"></canvas>-->
<!--        <canvas id="canvasElement"></canvas>-->
        <?php
        if(!isset($_SESSION[filtre]))
            echo("<canvas id=\"canvasElement\"></canvas>");
        else if(isset($_SESSION[filtre])){
                    echo("<img id=\"canvasElement\" style=\"position: relative;\" src=\"".$_SESSION[filtre]."\"/><br/>");
//                    unset($_SESSION[filtre]);
                }
            ?><!-- A virer-->
    </div>
        
        <!-- ------------- -->
        <!-- Partie Filtre -->
         
            <div id="form_filtre">
            <form  id="filtre" method="post" action="">
                
                <input type='image' name='filtre' value='emoji_kitty.png'  src='emoji_kitty.png'/>
                <input type='image' name='filtre' value='png/corne-de-licorne.png'  src='png/corne-de-licorne.png'/>
                <input type='image' name='filtre' value='png/lunette.png' width=200px src='png/lunette.png'/>
                <input type='image' name='filtre' value='png/barbe.png'  width=100px src='png/barbe.png'/>
                <input type='image' name='filtre' value='png/afro-hair.png' width=200px src='png/afro-hair.png'/>
                <input type='image' name='filtre' value='png/hair-blond.png' width=200px src='png/hair-blond.png'/>
                <input type='image' name='filtre' value='png/hair-red.png' width=200px src='png/hair-red.png'/>
                <input type='image' name='filtre' value='png/hair-short.png' width=200px src='png/hair-short.png'/>
                <input type='image' name='filtre' value='png/hair-side.png' width=200px src='png/hair-side.png'/>
                <input type='image' name='filtre' value='png/emma-watson.png' width=200px src='png/emma-watson.png'/>
            </form>
            </div>
        <!-- ------------------- -->
        <!-- ------------------- -->

    
        
        
    </div>
        <!-- ------------------- -->
        <!-- Partie photo upload -->
        <!-- ------------------- -->
    <?php }
    else
    {?>
        <div class="id_photo">
            <div style="height: 400px; text-align: left;">
                <div style="position: absolute;">
                    <img class="drophere" src="<?php echo($_SESSION[upload_file]) ?>"/>
                </div>
                <?php if(isset($_POST[filtre])){?>
                
                    <input type="hidden" id="f_left" name="f_left" value="0"/>
                    <input type="hidden" id="f_top" name="f_top" value="0"/>
                    <img class="dragme" style="position: relative; left: 0px; top: 0px;" src="<?php echo($_POST[filtre]) ?>"/>
                
                <?php 
                }?>
            
            </div>

            <?php
          
//            if(isset($_POST['upload_img']))
//            {
//                $_SESSION['nb_like'] = 0;
//                date_default_timezone_set('Europe/Paris');
//                $_SESSION['created'] = date('Y-m-d h:i:s');
//                
//                $bdd = include("database.php");
//                $requete = "INSERT INTO pictures (user_id, user_mail, nb_like, data_picture, created) VALUES (
//                '".$_SESSION['id_user']."',
//                '".$_SESSION['user_mail']."', '".$_SESSION['nb_like']."',
//                '".$_POST['upload_img']."',
//                '".$_SESSION['created']."');";
//                //        MYSQL
//                //    $bdd->prepare($requete)->execute();
//                $reponse = $bdd->prepare($requete);
//                $result = $reponse->execute();
//                $reponse->closeCursor();
//                unset($_SESSION[filtre]);
//                unset($_POST['upload_img']);
//            }
        ?>
            <div>
            <form method="post" action="fusion_image.php">
                <input type="hidden" id="upload_img" name="upload_img" value="<?php echo($_SESSION[upload_file]) ?>"/>
                <input type="hidden" id="filtre" name="filtre" value="<?php echo($_POST[filtre]) ?>"/>
                <input type="hidden" id="pic_display_left" name="pic_display_left" value="0"/>
                <input type="hidden" id="pic_display_top" name="pic_display_top" value="0"/>
                <input type="hidden" id="dest_width" name="dest_width" value="0"/>
                <input type="hidden" id="dest_height" name="dest_height" value="0"/>
                <input id="button_save" type="submit" name="save_pic" value="Sauvegarder" alt="sauvegarder la photo" <?php if(!isset($_POST[filtre])){echo("disabled='disabled'");}?>>
            </form>
            </div>
 
        <!-- ------------- -->
        <!-- Partie Filtre -->
         
            <div id="form_filtre">
<!--            <form  id="filtre" method="get" action="fusion_image.php">-->
            <form  id="filtre" method="post" action="">
                
                <input type='image' name='filtre' value='emoji_kitty.png'  src='emoji_kitty.png'/>
                <input type='image' name='filtre' value='png/corne-de-licorne.png'  src='png/corne-de-licorne.png'/>
                <input type='image' name='filtre' value='png/lunette.png' width=200px src='png/lunette.png'/>
                <input type='image' name='filtre' value='png/barbe.png'  width=100px src='png/barbe.png'/>
                <input type='image' name='filtre' value='png/afro-hair.png' width=200px src='png/afro-hair.png'/>
                <input type='image' name='filtre' value='png/hair-blond.png' width=200px src='png/hair-blond.png'/>
                <input type='image' name='filtre' value='png/hair-red.png' width=200px src='png/hair-red.png'/>
                <input type='image' name='filtre' value='png/hair-short.png' width=200px src='png/hair-short.png'/>
                <input type='image' name='filtre' value='png/hair-side.png' width=200px src='png/hair-side.png'/>
                <input type='image' name='filtre' value='png/emma-watson.png' width=200px src='png/emma-watson.png'/>
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
    <script src="dragndrop.js"></script> 
 
</html>