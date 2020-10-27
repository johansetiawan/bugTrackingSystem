			<?php 
                     include('config.php');  
                    if (isset($_GET['num'])) {
                        $idproduit = $_GET['num'];
                        $data = "SELECT * FROM `bug_report` WHERE `bug_id` LIKE '".$idproduit."'";
                        $dataproduit = $base->query($data)->fetch_array(MYSQLI_ASSOC);
                        if (empty($dataproduit)) {
                           header('Location: list_produit.php');
                         } 
                    }else{
                        header('Location: list_produit.php');
                    }

            ?> 
			<?php 
					$title="Roger Bug Tracker - ".$dataproduit['title'];
					include('include/head.php'); 
					 
			?>
    		<!--<div class="divleft"></div>-->
    		<div class="content"> <?php include('include/content/viewproduit.php'); ?> </div>
    		<div class="divright">
    			<?php include('include/divright/user.php');  ?>
    		</div> 
    		<?php include('include/footer.php'); ?>