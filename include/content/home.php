<?php 
	if(isset($_SESSION['user']))
	{
		echo "Welcome, ".htmlentities($_SESSION['user']['full_name']."!", ENT_QUOTES, 'UTF-8');
        if($_SESSION['user']['user_type'] == "Triager")
        {
            
		  echo "<br/>Please click <b><a href='generate_report_page.php'>here</a></b> to generate reports.";
        }
        if($_SESSION['user']['user_type'] == "admin")
        {
            
		  echo "<br/>Please click <b><a href='user_list_page.php'>here</a></b> to view user list.";
        }
	}
	else
	{
		echo "Welcome!<br/>Please login to continue.";
	}
    
?>
