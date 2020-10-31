<?php require_once __DIR__.'/../content/classes.php';?>
<div class="menulist">
	<a href="index.php"> <i class="ion ion-home"></i> Home</a>
	<a href="addproduit.php"> <i class="ion ion-wand"></i> Report a Bug</a>
	<a href="list_produit.php"> <i class="ion ion-android-cart"></i> Bug Report List</a>
	<a href="edit_infos"> <i class="ion ion-power"></i> Edit Profile</a>
	<form action = "index.php" method = "post">
	<button input type = "submit" name = "logout"> <i class="ion ion-power"></i> Logout</button>
    <?php 
		  if(isset($_POST['logout'])){
		  $home_page = new home_page();
		  $home_page->log_out();
		  }
	?>
	</form>
</div>