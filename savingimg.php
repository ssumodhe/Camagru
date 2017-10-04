<?php
if(isset($_POST['m'])
   {
       echo ("img received<br/>");
       $photo = imagecreatefromstring($_POST['m']);
       echo ("<img src=\"".$photo."\"/>");
   }
   else
   {
       echo ("EPIC FAIL YET AGAIN!!");
   }
?>