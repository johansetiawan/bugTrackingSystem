<?php
	include("classes.php");



class bug_comment_controller{
	public function set_comment($base,$comment_id,$user_id,$bug_report_id,$comment,$ts_created){
		$user_comment = new comment($base,$comment_id,$user_id,$bug_report_id,$comment,$ts_created);
		$result=$user_comment->create_comment($base,$comment_id,$user_id,$bug_report_id,$comment,$ts_created);
		$bug_comment_page=new bug_comment_page();
		if($result==1){
			$bug_comment_page->refresh_page();
		}
		else{
			$bug_comment_page->display_error();
		}
	}
	
	public function get_comments($base,$bug_id){
		$comment = new comment($base,NULL,NULL,NULL,NULL,NULL);
		return $comment->retrieve_all_comments($base,$bug_id);
	}
	
}
?>
