<?php require_once __DIR__.'/../content/classes.php';?>
<div class="menulist">
	<a href="index.php"> <i class="ion ion-home"></i> Home</a>
	<a href="addproduit.php"> <i class="ion ion-wand"></i> Report a Bug</a>
	<a href="list_produit.php"> <i class="ion ion-android-cart"></i> Bug Report List</a>
	<a href="edit_infos"> <i class="ion ion-power"></i> Edit Profile</a>
    <?php 
		  $user = new user();
		  $user->logout();
	?>
</div>