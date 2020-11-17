			<?php 
                     include('config.php');  
                    include('include/content/bug_report_detail_controller.php'); 
                    if (isset($_GET['num'])) {
                        $idproduit = $_GET['num'];
                        $data = "SELECT * FROM `bug_report` WHERE `bug_id` LIKE '".$idproduit."'";
                        $dataproduit = $base->query($data)->fetch_array(MYSQLI_ASSOC);
                        if (empty($dataproduit)) {
                           header('Location: bug_report_list_page.php');
                         } 
                    }else{
                        header('Location: bug_report_list_page.php');
                    }
        
                    
	date_default_timezone_set('Asia/Singapore');
	$idproduit = $_GET['num'];
	
	$bug_report_detail_page=new bug_report_detail_page();
	$dataproduit = $bug_report_detail_page->display_bug_report_detail($base,$idproduit);
	$alldev = "SELECT * FROM user where user_type ='Developer'";
    $devs = $base->query($alldev);
	
      if (isset($_SESSION['user'])) {
        if ($_SESSION['user']['user_type'] == "Triager" || $_SESSION['user']['user_type'] == "Developer" || $_SESSION['user']['user_type'] == "Reviewer") {
          ///
        }else{
          header('Location:index.php');
        }   
      }else{  
          header('Location:login_page.php');
      } 
	 if (isset($_POST['developer_submit'])){
			$bug_report_id=$dataproduit['bug_id'];
			$developer_id = mysqli_real_escape_string($base,nl2br($_POST['devid']));
			$bug_report_detail_page=new bug_report_detail_page();
			$bug_report_detail_page->assign_developer($base,$developer_id,$bug_report_id);  	
			header('Location:bug_report_list_page.php');
		}
			
      if (isset($_POST['submit'])) {           
            $status = mysqli_real_escape_string($base,nl2br($_POST['status']));
			$bug_report_id=$dataproduit['bug_id'];

              //echo $_POST['descproduit'].'<hr>'.$descproduit;
              //die();
		  
		 if ($_SESSION['user']['user_type'] == "Triager"){
			  $triager_id = $_SESSION['user']['user_id'];
			  $ts = date('Y-m-d H:i:s');
			  $bug_report_detail_page=new bug_report_detail_page();
			  $bug_report_detail_page->change_bug_report_status_triager($base,$status,$triager_id,$bug_report_id,$ts);           	  
          }
		  
          else if($_SESSION['user']['user_type'] == "Developer")
          {			  
			  $developer_id = $_SESSION['user']['user_id'];
			  $ts_modified = date('Y-m-d H:i:s');
			  $bug_report_detail_page=new bug_report_detail_page();
			  $bug_report_detail_page->change_bug_report_status_developer($base,$status,$developer_id,$bug_report_id,$ts_modified);			  
              
          }
          else if($_SESSION['user']['user_type'] == "Reviewer")
          {			
			 $reviewer_id = $_SESSION['user']['user_id'];
			 $ts_modified = date('Y-m-d H:i:s');
			  $bug_report_detail_page=new bug_report_detail_page();			  
			  $bug_report_detail_page->change_bug_report_status_reviewer($base,$status,$reviewer_id,$bug_report_id,$ts_modified);     
          }
          else
          {
              $editpro = "UPDATE bug_report SET status='".$status."' WHERE bug_id=".$bug_report_id."";
			  $rq = mysqli_query($base,$editpro);	
          }
              
             // $rq = mysqli_query($base,$editpro);
            //echo "<p class='alert error'><b>$editpro</b> error</p>";
        
      }
            ?> 

			<?php 
					$title="Roger Bug Tracker - Edit: ".$dataproduit['title'];
					include('include/head.php'); 
					 
			?>
			
    		<div class="content"> 
                <h1><?php echo $dataproduit['title']; ?></h1>
	<div class="cont">
		<b>Time posted : </b><?php echo $dataproduit['ts_created']; ?><br><br>
		<b>Description :</b><br><p><?php echo $dataproduit['description']; ?></p><br><br>
        <b>Version Number :</b> <?php echo $dataproduit['version_no']; ?><br><br>
        <b>Status :</b> <?php echo $dataproduit['status']; ?><br><br>
        <b>Priority :</b> <?php echo $dataproduit['priority']; ?><br><br>
	</div>
	<form method="post" action="">
	<?php if ($_SESSION['user']['user_type'] == "Triager"){ ?>
		<b>Devloper :</b>
        <select id="devid" name="devid">
            <?php
                while($dev = $devs->fetch_array()) {?>
                   <option value="<?php echo $dev['user_id'];?>"><?php echo $dev['full_name']; ?></option> 
            <?php }?>
        </select>
		<input type="submit" name="developer_submit" value="Change Developer">
	</form>
	<?php }?>
	
	<form method="post" action="">
	<div class="cont">
	<?php if ($_SESSION['user']['user_type'] == "Triager"){?>
		<b>Status :</b>
			<select id="status" name="status">
				<option value="open">Open</option>
				<option value="closed">Closed</option>
				<option value="fixed">Fixed</option> 
				<option value="reviewed">Reviewed</option> 
				<option value="invalid">Invalid</option> 
				<option value="duplicate">Duplicate</option> 
			</select>
		
	<?php }?>
	<input type="submit" name="submit" value="Update Status">
	</div> 
	</form>

</div>
    		<div class="divright">
    			<?php include('include/divright/user.php');  ?>
    		</div> 
    		<?php include('include/footer.php'); ?>