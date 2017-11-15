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
        <?php $bdd = require("database.php"); ?>
        
        <?php 
        
        if(isset($_GET) && $_GET[select] != NULL && $_GET[new_value] != NULL)
        {
                        if($_GET[select] == "password")
                        {
                            $mdp = hash("sha512", $_GET[new_value]);
                            $_GET[new_value] = hash("md5", $mdp);
                            unset($mdp);
                        }
            $requete= "UPDATE ".$_SESSION[db_table_to_edit]." SET ".$_GET[select]."=\"".$_GET[new_value]."\" WHERE id=\"".$_SESSION['edit_id']."\";";
            //        MYSQL
            //    $bdd->prepare($requete)->execute();
            $reponse = $bdd->prepare($requete);
            $result = $reponse->execute();
            unset($_GET[new_value]);
            unset($_GET[select]);
            
            
        }
        
        if(isset($_POST[db_table_to_edit]) && isset($_POST[edit_id]))
        {
            $_SESSION[db_table_to_edit] = $_POST[db_table_to_edit];
            $_SESSION[edit_id] = $_POST[edit_id];
        unset($_POST[db_table_to_edit]);
        unset($_POST[edit_id]);
        }
        $reponse = $bdd->query("SELECT * FROM ".$_SESSION[db_table_to_edit]." WHERE id='".$_SESSION[edit_id]."';");
        $donnees = $reponse->fetch();
    
            echo("<br/>db_table : ".strtoupper($_SESSION[db_table_to_edit])."<br/>");
            $lescles = array_keys($donnees);
    
            echo("<table>");
            echo("<tr>");
            $i = 0;
            foreach($lescles as $key)
            {
                if($i % 2 == 0)
                    echo("<th>".$key."</th>");
                $i++;
            }
            echo("</tr>");
             echo("<tr>");
            $i = 0;
            foreach($lescles as $key)
            {
                if($i % 2 == 0)
                    echo("<td style='padding: 0 5px 0 5px; max-width: 300px; word-wrap: break-word;'>".$donnees[$key]."</td>");
                $i++;
            }
            echo("</tr>");
    
            echo("</table>");
            
            echo("<form action='' method='get'>");
            echo("<p>La section a modifier: </p>");
            echo("<select name='select' size='1'>");
            $i = 0;
            foreach($lescles as $key)
            {
                if($i % 2 == 0 && $key != "id")
                    echo("<option value='".$key."'>".$key."</option>");
                $i++;
            }
            echo("</select>");
            echo("<p>La nouvelle valeur: </p>");
            echo("<input type='text' name='new_value'/>");
            echo("<input type='submit' value='Submit!'/>");
            echo("</form>");
        $reponse->closeCursor();
        
        ?>
        
        
    </body>
    
    <footer>
        <?php include("Camagru_footer.php"); ?>
    </footer>
</html>