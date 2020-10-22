<article>   
		<div class="paneloption" style="display:block;width: 120px;">
			<a href="edit_infos.php" class="delete"><i class="ion ion-wrench"></i></a> 
			<a href="addproduit.php" class="option"><i class="ion ion-ios-plus-outline"></i></a> 
			<a href="list_produit.php" class="option"><i class="ion ion-ios-list-outline"></i></a> 
		</div>
		<div class="cont">
			<h2><?php echo $_SESSION['user']['full_name']." "?> <span class="tag"><i class="ion ion-chevron-left"></i> <?php echo $_SESSION['user']['email']; ?> <i class="ion ion-chevron-right"></i></span></h2> <br>
			<p>
				<b>E-mail : </b><?php echo $_SESSION['user']['email']; ?><br>
				<b>type : </b><?php echo $_SESSION['user']['user_type']; ?><br>
				<br>
			</p>
		</div>
	</article>