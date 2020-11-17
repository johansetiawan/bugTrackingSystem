<?php

class user_reviewer extends user{

protected $bug_report_resolved=NULL;

function __construct($base,$user_id,$email,$password,$full_name,$user_type)
{
	$this->base = $base;
	$this->user_id = $user_id;
	$this->email = $email;
	$this->password = $password;
	$this->full_name = $full_name;
	$this->user_type = $user_type;
}

public function get_no_of_bug_report_resolved(){
	return $this->$bug_report_resolved;
}

public function set_no_of_bug_report_resolved($value){
	$this->$bug_report_resolved=$value;
}

}

?>