<!DOCTYPE HTML>
<html>
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
                $_SESSION['created'] = date('Y-m-d h:i:s');
                
                $bdd = include("database.php");
                $requete = "INSERT INTO pictures (user_id, user_mail, nb_like, data_picture, created) VALUES (
                '".$_SESSION['id_user']."',
                '".$_SESSION['user_mail']."', '".$_SESSION['nb_like']."',
                '".$_POST['hidden_img']."',
                '".$_SESSION['created']."');";
                $bdd->prepare($requete)->execute();
                
            }
 
        ?>
    </div>
    
    <div class="prev_pic">
        <?php
        $bdd = include("database.php");
        $reponse = $bdd->query("SELECT * FROM pictures WHERE user_mail=\"".$_SESSION[user_mail]."\"ORDER BY id DESC;");
        
        while ($donnees = $reponse->fetch())
        {
            echo("<a href='gallery_pic.php?id=".$donnees[id]."&user=".$donnees[user_id]."'><img id='user_pic' width=40% length=40% src='".$donnees[data_picture]."' />");
            echo("<br/>");
//            echo("<img width=40% length=40% src='".$donnees[data_picture]."' /><br/>");
        }
        ?>
        
    </div>
        
        
    <div class="id_rendu">
        <canvas id="canvasElement"></canvas>
    </div>
        

    <script src="webcam.js"></script> 
 
</html>