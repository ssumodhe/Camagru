<?php session_start(); 
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
        
        <!-- --------- -->
        <!-- SUPPR LIK -->
        <!-- --------- -->
        <?php
        if(isset($_POST[lik_suppr_id]))
            {
                $bdd = include("config/database.php");
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
            $bdd = include("config/database.php");
            $req = $bdd->query('SELECT COUNT (id) as Nbid FROM likes');
            $donnees = $req->fetch();
            $req->closeCursor();
        echo ("<pre>Table Likes (".$donnees['Nbid'].")</pre>");
        unset($donnees);
        ?>
        <table>
            <tr>
                <th>id</th>
                <th>e-mail</th>
                <th>id_photo</th>
                <th>created</th>
            </tr>

        <?php 
        $bdd = include("config/database.php");
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
                <form action='im_admin_modif.php' method='post'>");
                echo("<input type='hidden' name='db_table_to_edit' value='likes'/>");
                echo("<input id='del_button' type='image' name='edit_id' value='".$donnees[id]."' width=22px height=22px src='img/edit_button.png'/>");
                echo("</form></td>");
            echo("</tr>");
         }
        $reponse->closeCursor();
        unset($donnees);
        ?>
        </table>
        
</body>
    
    
    
    <footer>
     
        
        
        <?php include("Camagru_footer.php"); ?>
    </footer>
</html>