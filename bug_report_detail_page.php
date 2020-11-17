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
                    include('include/content/bug_report_detail_page.php'); 
					 
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