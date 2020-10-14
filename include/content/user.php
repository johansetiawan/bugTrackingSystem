<?php 
	 if (isset($_SESSION['user'])) { 

	 	if ($_SESSION['user']['user_type']== "Reporter") {

	 		header('Location: admin.php');
	 	}
	 	
      }else{
        header('Location: login.php');
      }
      
	//var_dump($_SESSION) 
?>
	
	<article>   
		<div class="paneloption" style="display:block;">
			<a href="edit_infos.php" class="delete"><i class="ion ion-wrench"></i></a> 
		</div>
		<div class="cont">
			<h2><?php echo $_SESSION['user']['fullname']." "?> <span class="tag"><i class="ion ion-chevron-left"></i> <?php echo $_SESSION['user']['email']; ?> <i class="ion ion-chevron-right"></i></span></h2> <br>
			<p>
				<b>E-mail : </b><?php echo $_SESSION['user']['email']; ?><br>
				<b>Role : </b><?php echo $_SESSION['user']['user_type']; ?><br>
			</p>
		</div>
	</article>