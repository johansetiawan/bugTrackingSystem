<?php
	include("classes.php");
    $id = $dataproduit['bug_id'];
	
    $bug_comment_page = new bug_comment_page();
	$comments = $bug_comment_page->display_comments($base,$id);

if (isset($_POST['submit'])) {
		$descproduit = mysqli_real_escape_string($base,nl2br($_POST['comment']));
		$uid = mysqli_real_escape_string($base,nl2br($_POST['uid']));	
        $ts_created = date("Y-m-d H:i:s");
		$bug_comment_page->comment($base,NULL,$uid,$id,$descproduit,$ts_created);
		/*if (!empty($_POST['comment'])) {
              $descproduit = mysqli_real_escape_string($base,nl2br($_POST['comment']));
			  $uid = mysqli_real_escape_string($base,nl2br($_POST['uid']));							
			  echo "<meta http-equiv='refresh' content='0'>";
         }else{
            echo "<p class='alert error'><b>Attention !</b> error</p>";
        }*/
      }
?>
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
</article>