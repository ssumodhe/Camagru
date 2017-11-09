<?php
  session_start();

    unset($_SESSION['id_user']);
    unset($_SESSION['user_mail']);

    unset($_SESSION['id_picture']);
    unset($_SESSION['pic_id']);
    unset($_SESSION['nb_like']);
    unset($_SESSION['name']);
    unset($_SESSION['created']);
    unset($_SESSION['nb_pic_display']);
    unset($_SESSION['page']);
    unset($_SESSION['next_p']);
    unset($_SESSION['prev_p']);
    unset($_SESSION['stop_page']);

    unset($_SESSION['upload_file']);
    unset($_SESSION['log']);

    unset($_SESSION[db_table_to_edit]);
    unset($_SESSION[edit_id]);
        

header('Location: index.php');

?>