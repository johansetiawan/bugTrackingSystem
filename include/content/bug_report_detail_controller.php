
  <?php
    include("classes.php");
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
  
  