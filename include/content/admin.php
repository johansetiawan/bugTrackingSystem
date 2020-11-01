<?php
include"classes.php";
$user_id = $_SESSION['user']['user_id'];
$home_page = new home_page();
$datauser=$home_page->display_user_details($base,$user_id);


?>
<article>   
		<div class="paneloption" style="display:block;width: 120px;">
			<a href="edit_infos.php" class="delete"><i class="ion ion-wrench"></i></a> 
			<a href="addproduit.php" class="option"><i class="ion ion-ios-plus-outline"></i></a> 
			<a href="list_produit.php" class="option"><i class="ion ion-ios-list-outline"></i></a> 
		</div>
		<div class="cont">
			<h2><?php echo $datauser['full_name']." "?> <span class="tag"><i class="ion ion-chevron-left"></i> <?php echo $datauser['email']; ?> <i class="ion ion-chevron-right"></i></span></h2> <br>
			<p>
				<b>E-mail : </b><?php echo $datauser['email']; ?><br>
				<b>type : </b><?php echo $datauser['user_type']; ?><br>
				<br>
			</p>
		</div>
	</article>