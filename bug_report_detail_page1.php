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
					$title="Roger Bug Tracker - ".$dataproduit['title'];
					include('include/head.php'); 
					 
			?>
    		<!--<div class="divleft"></div>-->
    		<div class="content"> <?php include('include/content/bug_report_detail_controller1.php'); ?>
<article> 
	<?php  if (isset($_SESSION['user'])) {
					if ($_SESSION['user']['user_type'] == "Triager") { ?> 
			<div class="paneloption">
				<a href="delete_produit.php?num=<?php echo $dataproduit['id'];?>" class="delete"><i class="ion ion-trash-a"></i></a>
				<a href="bug_report_detail_controller1.php?num=<?php echo $dataproduit['id'];?>" class="edit"><i class="ion ion-edit"></i></a>
			</div>
			<?php } } ?>
    
	<h1><?php echo $dataproduit['title']; ?></h1>
	<div class="cont">
		<b>Time posted : </b><?php echo $dataproduit['ts_created']; ?><br><br>
		<b>Description :</b><br><p><?php echo $dataproduit['description']; ?></p>
	</div>
    
    
    <div class="cont">
        <b><h1>Solutions:</h1></b><br>
        <?php  while($comment = $comments->fetch_array()) {?>
            <b><?php echo $comment['comment']; ?></b> <br><?php echo $comment['ts_created']; ?><br><br>
        <?php }?>
    </div>
    <div class="cont">
        <b><h1>Add Comments:</h1></b><br>
        <form method="post" action="" style="border:none;">
    <div class="cont" style="margin-top: -30px;margin-left: -30px;">
		<p><textarea name="comment" style="min-width:200%; max-width:200%;"></textarea></p>
		<input type="hidden" name="uid" value="<?php echo $_SESSION['user']['user_id'] ?>">
		<input type="submit" name="submit" value="post">
	</div>
</form>
    </div>
</article></div>
    		<div class="divright">
    			<?php include('include/divright/user.php');  ?>
    		</div> 
    		<?php include('include/footer.php'); ?>