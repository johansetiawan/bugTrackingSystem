

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
	<a href="add_bug_page.php"> <i class="ion ion-wand"></i> Report a Bug</a>
	<a href="bug_report_list_page.php"> <i class="ion ion-android-cart"></i> Bug Report List</a>
	<a href="edit_profile_page.php"> <i class="ion ion-edit"></i> Edit Profile</a>
	<a href="index.php?logout=true"><i class="ion ion-power"></i> Logout</a>
</div>