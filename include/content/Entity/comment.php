<?php

class comment{
private $base = NULL;
protected $comment_id = NULL;
protected $user_id = NULL;
protected $bug_report_id=NULL;
protected $comment=NULL;
protected $ts_created=NULL;


function __construct($base,$comment_id,$user_id,$bug_report_id,$comment,$ts_created){
	$this->base=$base;
	$this->comment_id=$comment_id;
	$this->user_id=$user_id;
	$this->bug_report_id=$bug_report_id;
	$this->comment=$comment;
	$this->ts_created=$ts_created;
	
}

public function get_comment_id(){
	return $this->comment_id;
}

public function set_comment_id($value){
	$this->comment_id=$value;
}

public function get_comment_user_id(){
	return $this->user_id;
}

public function set_comment_user_id($value){
	$this->user_id=$value;
}

public function get_comment_bug_report_id(){
	return $this->bug_report_id;
	
}

public function set_comment_bug_report_id($value){
	
	$this->bug_report_id=$value;
}

public function get_comment(){
	return $this->comment;
	
}

public function set_comment($value){

	$this->comment=$value;
}

public function get_ts_created(){
	return $this->ts_created;
	
}

public function set_ts_created($value){
	
	$this->ts_created=$value;
}

public function create_comment($base,$comment_id,$user_id,$bug_report_id,$comment,$ts_created){
		if (!empty($_POST['comment'])) {
			  $addpro = "INSERT INTO comment(comment, bug_id,user_id) VALUES ('$comment', '$bug_report_id','$user_id' )";
			  $rq = mysqli_query($base,$addpro);
			  return 1;
         }else{
            return 0;
        }
}

public function retrieve_all_comments($base,$bug_id){
		$allcomments = "SELECT * FROM `comment` where bug_id = $bug_id" ;
		return $base->query($allcomments);
}

}

?>