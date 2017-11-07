<?php session_start();
//$_SESSION[nb_pic_display] = 0;
//$_SESSION[page] = 1;
//$_SESSION[next_p] = 2;
if(!isset($_SESSION[log]))
{
    header("Location: index.php");
}
else if ($_SESSION[id_user] != "ze_admin")
{
    header("Location: home.php");
}
$nb_display = 10;
?>
<!DOCTYPE HTML>
<html>
    <head>
        <?php include("Camagru_header.php"); ?>
    </head>
    
    
    <body>
        <?php include("Camagru_menu.php"); ?>
        

        <!-- -------- -->
        <!-- REQUETES -->
        <!-- -------- -->
        <form method="post" action="">
            <label>Appliquer une requete :</label><br/>
            <textarea name="message" rows=4 cols=60></textarea><br/> 
            <input type="submit" value="Appliquer!" /><br/><br/>
        </form>
        <?php
            echo($_POST[message]);
            unset($_POST[message]);
        ?>
        
        
        <!-- ----------- -->
        <!-- SUPPR USERS -->
        <!-- ----------- -->
        <?php
        if(isset($_POST[usr_suppr_id]))
            {
                $bdd = include("database.php");
                $requete= "DELETE FROM users WHERE id=".$_POST[usr_suppr_id].";";
                //        MYSQL
                //    $bdd->prepare($requete)->execute();
                $reponse = $bdd->prepare($requete);
                $result = $reponse->execute();
                $reponse->closeCursor();
                unset($_POST[usr_suppr_id]);
            }
        ?>
        
        <!-- ------------- -->
        <!-- Tableau USERS -->
        <!-- ------------- -->
        <?php
            $bdd = include("database.php");
            $req = $bdd->query('SELECT COUNT (id) as Nbid FROM users');
            $donnees = $req->fetch();
            $req->closeCursor();
        echo ("<pre>Table Users (".$donnees['Nbid'].")</pre>");
        $nb_users = $donnees['Nbid'];
        unset($donnees);
        ?>
        <table>
            <tr>
                <th></th>
                <th>id</th>
                <th>login</th>
                <th>e-mail</th>
                <th>created</th>
            </tr>

        <?php 
        $bdd = include("database.php");
        $reponse = $bdd->query("SELECT * FROM users ORDER BY id DESC LIMIT ".$nb_display.";");
        $i = $nb_users;
        while ($donnees = $reponse->fetch())
        {
            echo("<tr>");
            echo("<td>".$i.")</td>");
            echo("<td>".$donnees[id]."</td>");
            echo("<td>".$donnees[login]."</td>");
            echo("<td>".$donnees[mail]."</td>");
            echo("<td>".$donnees[created]."</td>");
            echo("<td>
                <form action='' method='post'>");
                echo("<input id='del_button' type='image' name='usr_suppr_id' value='".$donnees[id]."' width=30px height=30px src='img/delete_bin.png'/>");
                echo("</form><td>");
            echo("<td>
                <form action='' method='post'>");
                echo("<input id='del_button' type='image' name='usr_edit_id' value='".$donnees[id]."' width=22px height=22px src='img/edit_button.png'/>");
                echo("</form></td>");
            echo("</tr>");
            $i--;
         }
        $reponse->closeCursor();
        ?>
        </table>
        
        <?php if($nb_users > $nb_display)
            echo("<div id='a_align_right'><a href='im_admin_users.php'>See more >></a></div>");    
        ?>
        
        <!-- --------- -->
        <!-- SUPPR PIC -->
        <!-- --------- -->
        <?php
        if(isset($_POST[pic_suppr_id]))
            {
                $bdd = include("database.php");
                $requete= "DELETE FROM pictures WHERE id=".$_POST[pic_suppr_id].";";
                //        MYSQL
                //    $bdd->prepare($requete)->execute();
                $reponse = $bdd->prepare($requete);
                $result = $reponse->execute();
                $reponse->closeCursor();
                $requete= "DELETE FROM comments WHERE id_picture=".$_POST[pic_suppr_id].";";
                //        MYSQL
                //    $bdd->prepare($requete)->execute();
                $reponse = $bdd->prepare($requete);
                $result = $reponse->execute();
                $reponse->closeCursor();
                $requete= "DELETE FROM likes WHERE id_picture=".$_POST[pic_suppr_id].";";
                //        MYSQL
                //    $bdd->prepare($requete)->execute();
                $reponse = $bdd->prepare($requete);
                $result = $reponse->execute();
                $reponse->closeCursor();
                unset($_POST[pic_suppr_id]);
            }
        ?>
        
        <!-- ---------------- -->
        <!-- Tableau PICTURES -->
        <!-- ---------------- -->
        <?php
            $bdd = include("database.php");
            $req = $bdd->query('SELECT COUNT (id) as Nbid FROM pictures');
            $donnees = $req->fetch();
            $req->closeCursor();
        echo ("<pre>Table Pictures (".$donnees['Nbid'].")</pre>");
        $nb_pictures = $donnees['Nbid'];
        unset($donnees);
        ?>
        <table>
            <tr>
                <th></th>
                <th>id</th>
                <th>login</th>
                <th>e-mail</th>
                <th>nb_like</th>
                <th>photo</th>
                <th>created</th>
            </tr>

        <?php 
        $bdd = include("database.php");
        $reponse = $bdd->query("SELECT * FROM pictures ORDER BY id DESC LIMIT ".$nb_display.";");
        $i = $nb_pictures;
        while ($donnees = $reponse->fetch())
        {
            echo("<tr>");
            echo("<td>".$i.")</td>");
            echo("<td><a href='gallery_pic.php?id=".$donnees[id]."&user=".$donnees[user_id]."'>".$donnees[id]."</a></td>");
            echo("<td>".$donnees[user_id]."</td>");
            echo("<td>".$donnees[user_mail]."</td>");
            echo("<td>".$donnees[nb_like]."</td>");
            echo("<td><div><img src='".$donnees[data_pic]."'/></div></td>");
            echo("<td>".$donnees[created]."</td>");
            echo("<td>
                <form action='' method='post'>");
                echo("<input id='del_button' type='image' name='pic_suppr_id' value='".$donnees[id]."' width=30px height=30px src='img/delete_bin.png'/>");
                echo("</form></td>");
            echo("<td>
                <form action='' method='post'>");
                echo("<input id='del_button' type='image' name='pic_edit_id' value='".$donnees[id]."' width=22px height=22px src='img/edit_button.png'/>");
                echo("</form></td>");
            echo("</tr>");
            $i--;
         }
        $reponse->closeCursor();
        ?>
        </table>
        
        <?php if($nb_pictures > $nb_display)
            echo("<div id='a_align_right'><a href='im_admin_pictures.php'>See more >></a></div>");    
        ?>
        
        <!-- --------- -->
        <!-- SUPPR COM -->
        <!-- --------- -->
        <?php
        if(isset($_POST[com_suppr_id]))
            {
                $bdd = include("database.php");
                $requete= "DELETE FROM comments WHERE id=".$_POST[com_suppr_id].";";
                //        MYSQL
                //    $bdd->prepare($requete)->execute();
                $reponse = $bdd->prepare($requete);
                $result = $reponse->execute();
                $reponse->closeCursor();
                unset($_POST[com_suppr_id]);
            }
        ?>
        
        <!-- ---------------- -->
        <!-- Tableau COMMENTS -->
        <!-- ---------------- -->
        <?php
            $bdd = include("database.php");
            $req = $bdd->query('SELECT COUNT (id) as Nbid FROM comments');
            $donnees = $req->fetch();
            $req->closeCursor();
        echo ("<pre>Table Comments (".$donnees['Nbid'].")</pre>");
        $nb_comments = $donnees['Nbid'];
        unset($donnees);
        ?>
        <table>
            <tr>
                <th></th>
                <th>id</th>
                <th>login</th>
                <th>e-mail</th>
                <th>id_photo</th>
                <th>comment</th>
                <th>created</th>
            </tr>

        <?php 
        $bdd = include("database.php");
        $reponse = $bdd->query("SELECT * FROM comments ORDER BY id DESC LIMIT ".$nb_display.";");
        
        $i = $nb_comments;
        while ($donnees = $reponse->fetch())
        {
            echo("<tr>");
            echo("<td>".$i.")</td>");
            echo("<td>".$donnees[id]."</td>");
            echo("<td>".$donnees[user_id]."</td>");
            echo("<td>".$donnees[user_mail]."</td>");
            echo("<td>".$donnees[id_picture]."</td>");
            echo("<td>".$donnees[comment]."</td>");
            echo("<td>".$donnees[created]."</td>");
            echo("<td>
                <form action='' method='post'>");
                echo("<input id='del_button' type='image' name='com_suppr_id' value='".$donnees[id]."' width=30px height=30px src='img/delete_bin.png'/>");
                echo("</form><td>");
            echo("<td>
                <form action='' method='post'>");
                echo("<input id='del_button' type='image' name='com_edit_id' value='".$donnees[id]."' width=22px height=22px src='img/edit_button.png'/>");
                echo("</form></td>");
            echo("</tr>");
            $i--;
         }
        $reponse->closeCursor();
        ?>
        </table>
        <?php if($nb_comments > $nb_display)
            echo("<div id='a_align_right'><a href='im_admin_comments.php'>See more >></a></div>");    
        ?>
        
        <!-- --------- -->
        <!-- SUPPR LIK -->
        <!-- --------- -->
        <?php
        if(isset($_POST[lik_suppr_id]))
            {
                $bdd = include("database.php");
                $requete= "DELETE FROM likes WHERE id=".$_POST[lik_suppr_id].";";
                //        MYSQL
                //    $bdd->prepare($requete)->execute();
                $reponse = $bdd->prepare($requete);
                $result = $reponse->execute();
                $reponse->closeCursor();
                unset($_POST[lik_suppr_id]);
            }
        ?>
        
        <!-- ------------- -->
        <!-- Tableau LIKES -->
        <!-- ------------- -->
        <?php
            $bdd = include("database.php");
            $req = $bdd->query('SELECT COUNT (id) as Nbid FROM likes');
            $donnees = $req->fetch();
            $req->closeCursor();
        echo ("<pre>Table Likes (".$donnees['Nbid'].")</pre>");
        $nb_likes = $donnees['Nbid'];
        unset($donnees);
        ?>
        <table>
            <tr>
                <th></th>
                <th>id</th>
                <th>e-mail</th>
                <th>id_photo</th>
                <th>created</th>
            </tr>

        <?php 
        $bdd = include("database.php");
        $reponse = $bdd->query("SELECT * FROM likes ORDER BY id DESC LIMIT ".$nb_display.";");
        $i = $nb_likes;
        while ($donnees = $reponse->fetch())
        {
            echo("<tr>");
            echo("<td>".$i.")</td>");
            echo("<td>".$donnees[id]."</td>");
            echo("<td>".$donnees[user_mail]."</td>");
            echo("<td>".$donnees[id_picture]."</td>");
            echo("<td>".$donnees[created]."</td>");
            echo("<td>
                <form action='' method='post'>");
                echo("<input id='del_button' type='image' name='lik_suppr_id' value='".$donnees[id]."' width=30px height=30px src='img/delete_bin.png'/>");
                echo("</form><td>");
            echo("<td>
                <form action='' method='post'>");
                echo("<input id='del_button' type='image' name='lik_edit_id' value='".$donnees[id]."' width=22px height=22px src='img/edit_button.png'/>");
                echo("</form></td>");
            echo("</tr>");
            $i--;
         }
        $reponse->closeCursor();
        ?>
        </table>
        <?php if($nb_likes > $nb_display)
            echo("<div id='a_align_right'><a href='im_admin_likes.php'>See more >></a></div>");    
        ?>
    </body>
    
    <footer>
        <?php include("Camagru_footer.php"); ?>
    </footer>
</html>