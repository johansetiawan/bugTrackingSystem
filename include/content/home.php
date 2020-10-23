<?php 
	if(isset($_SESSION['user']))
	{
		echo "Welcome, ".htmlentities($_SESSION['user']['full_name']."!", ENT_QUOTES, 'UTF-8');
		echo "<br/>Please click <b><a href='list_produit.php'>here</a></b> to view the latest bug reports.";
	}
	else
	{
		echo "Welcome!<br/>Please login to continue.";
	}
?>
