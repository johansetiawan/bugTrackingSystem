      <?php 
          $title="home";
          include('include/head.php'); 
      ?>

        <!--<div class="divleft"></div>-->
        <div class="content"> <?php include('include/content/user.php'); ?> 
	<article>   
		<div class="paneloption" style="display:block;">
			<a href="edit_profile_page.php" class="delete"><i class="ion ion-wrench"></i></a> 
		</div>
		<div class="cont">
			<h2><?php echo $datauser['full_name']." "?> <span class="tag"><i class="ion ion-chevron-left"></i> <?php echo $datauser['email']; ?> <i class="ion ion-chevron-right"></i></span></h2> <br>
			<p>
				<b>E-mail : </b><?php echo $datauser['email']; ?><br>
				<b>Role : </b><?php echo $datauser['user_type']; ?><br>
			</p>
		</div>
	</article>
</div>
        <div class="divright">
          <?php include('include/divright/user.php');  ?>
        </div> 
        <?php include('include/footer.php'); ?>