<?php
	include('Entity/comment.php');



class bug_comment_controller{
	public function set_comment($base,$comment_id,$user_id,$bug_report_id,$comment,$ts_created){
		$user_comment = new comment($base,$comment_id,$user_id,$bug_report_id,$comment,$ts_created);
		return $result=$user_comment->create_comment($base,$comment_id,$user_id,$bug_report_id,$comment,$ts_created);		
	}
	
	public function get_comments($base,$bug_id){
		$comment = new comment($base,NULL,NULL,NULL,NULL,NULL);
		return $comment->retrieve_all_comments($base,$bug_id);
	}
	
}
?>
