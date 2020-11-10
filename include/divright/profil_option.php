<?php require_once __DIR__.'/../content/classes.php';?>

<?php
	function logout() {
		if(isset($_POST['logout'])) {
			$home_page = new home_page();
			$home_page->log_out();
		}
	}
	
	if (isset($_GET['logout'])) {
		logout();
	}
?>

<div class="menulist">
	<a href="index.php"> <i class="ion ion-home"></i> Home</a> 
	<a href="list_produit.php"> <i class="ion ion-android-cart"></i> List</a>
    <a href="addproduit.php"> <i class="ion ion-wand"></i> Add Bug</a>
    <a href="edit_infos.php"> <i class="ion ion-edit"></i> Edit Profile</a>
	<a href="index.php?logout=true"><i class="ion ion-power"></i> Logout</a>
</div>