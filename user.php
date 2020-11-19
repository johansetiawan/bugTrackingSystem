      <?php 
          $title="home";
          include('include/head.php'); 
			include('include/content/home_controller.php'); 

if (isset($_SESSION['user'])) { 

	 	if ($_SESSION['user']['user_type']== "Reporter") {

	 		header('Location: home_page.php');
	 	}
	 	
      }else{
        header('Location: login_page.php');
      }
	  class home_page{
	
	public function display_user_details($base,$user_id){
		$home_controller = new home_controller();
		return $home_controller->get_user_details($base,$user_id);
	}
	
	public function log_out()
	{
		 $home_controller = new home_controller();
		 $home_controller->end_session();
	}
	
}
	  $user_id = $_SESSION['user']['user_id'];
	  $home_page = new home_page();
	  $datauser=$home_page->display_user_details($base,$user_id);
      
	//var_dump($_SESSION) 
      ?>

        <!--<div class="divleft"></div>-->
        <div class="content">  
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