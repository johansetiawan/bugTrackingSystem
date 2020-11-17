			<?php 
                     include('config.php');  
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

            ?> 

			<?php 
					$title="Roger Bug Tracker - Edit: ".$dataproduit['title'];
					include('include/head.php'); 
					 
			?>
			
    		<div class="content"> <?php include('include/content/bug_report_detail_controller.php'); ?> </div>
    		<div class="divright">
    			<?php include('include/divright/user.php');  ?>
    		</div> 
    		<?php include('include/footer.php'); ?>