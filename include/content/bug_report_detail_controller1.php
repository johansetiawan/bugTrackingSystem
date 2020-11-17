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
