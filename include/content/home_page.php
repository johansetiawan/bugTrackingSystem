<?php
include"classes.php";
$user_id = $_SESSION['user']['user_id'];
$home_page = new home_page();
$datauser=$home_page->display_user_details($base,$user_id);


?>
