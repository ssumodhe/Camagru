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

?>
<!DOCTYPE HTML>
<html>
    <head>
        <?php include("Camagru_header.php"); ?>
    </head>
    
    
    <body>
        <?php include("Camagru_menu.php"); ?>
        
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
                unset($_POST[usr_suppr_id]);
            }
        ?>
        
        <!-- ------------- -->
        <!-- Tableau USERS -->
        <!-- ------------- -->
        <pre>Table Users</pre>
        <table>
            <tr>
                <th>id</th>
                <th>login</th>
                <th>e-mail</th>
                <th>created</th>
            </tr>

        <?php 
        $bdd = include("database.php");
        $reponse = $bdd->query("SELECT * FROM users ORDER BY id;");
        
        while ($donnees = $reponse->fetch())
        {
            echo("<tr>");
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
         }
        ?>
        </table>
        
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
                unset($_POST[pic_suppr_id]);
            }
        ?>
        
        <!-- ---------------- -->
        <!-- Tableau PICTURES -->
        <!-- ---------------- -->
        <pre>Table Pictures</pre>
        <table>
            <tr>
                <th>id</th>
                <th>login</th>
                <th>e-mail</th>
                <th>nb_like</th>
                <th>photo</th>
                <th>created</th>
            </tr>

        <?php 
        $bdd = include("database.php");
        $reponse = $bdd->query("SELECT * FROM pictures ORDER BY id;");
        
        while ($donnees = $reponse->fetch())
        {
            echo("<tr>");
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
         }
        ?>
        </table>
        
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
                unset($_POST[com_suppr_id]);
            }
        ?>
        
        <!-- ---------------- -->
        <!-- Tableau COMMENTS -->
        <!-- ---------------- -->
        <pre>Table Comments</pre>
        <table>
            <tr>
                <th>id</th>
                <th>login</th>
                <th>e-mail</th>
                <th>id_photo</th>
                <th>comment</th>
                <th>created</th>
            </tr>

        <?php 
        $bdd = include("database.php");
        $reponse = $bdd->query("SELECT * FROM comments ORDER BY id;");
        
        while ($donnees = $reponse->fetch())
        {
            echo("<tr>");
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
         }
        ?>
        </table>
        
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
                unset($_POST[lik_suppr_id]);
            }
        ?>
        
        <!-- ---------------- -->
        <!-- Tableau COMMENTS -->
        <!-- ---------------- -->
        <pre>Table Comments</pre>
        <table>
            <tr>
                <th>id</th>
                <th>e-mail</th>
                <th>id_photo</th>
                <th>created</th>
            </tr>

        <?php 
        $bdd = include("database.php");
        $reponse = $bdd->query("SELECT * FROM likes ORDER BY id;");
        
        while ($donnees = $reponse->fetch())
        {
            echo("<tr>");
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
         }
        ?>
        </table>
    </body>
    
    <footer>
        <?php include("Camagru_footer.php"); ?>
    </footer>
</html>