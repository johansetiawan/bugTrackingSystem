<?php 
	 if (isset($_SESSION['user'])) { 

	 	if ($_SESSION['user']['user_type']== "Reporter") {

	 		header('Location: home_page.php');
	 	}
	 	
      }else{
        header('Location: login_page.php');
      }
	  
	  include"classes.php";
	  $user_id = $_SESSION['user']['user_id'];
	  $home_page = new home_page();
	  $datauser=$home_page->display_user_details($base,$user_id);
      
	//var_dump($_SESSION) 
?>
	
