<?php
	if (isset($_SESSION['user'])) {
        if ($_SESSION['user']['user_type'] == "admin") {
          
		    $allusers = "SELECT * FROM `user`";
		    $users = $base->query($allusers); 

        }else{
          header('Location:index.php');
        }   
      }else{  
          header('Location:login_page.php');
      }
?>
   