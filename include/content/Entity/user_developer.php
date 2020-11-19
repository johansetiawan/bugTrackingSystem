<?php
class user_developer extends user{

protected $bug_report_fixed=NULL;
protected $expertise=NUll;

function __construct($base,$user_id,$email,$password,$full_name,$user_type)
{
	$this->base = $base;
	$this->user_id = $user_id;
	$this->email = $email;
	$this->password = $password;
	$this->full_name = $full_name;
	$this->user_type = $user_type;
}

public function get_no_of_bug_report_fixed(){
	return $this->bug_report_fixed;
}

public function set_no_of_bug_report_fixed(){
	$this->$bug_report_fixed=$value;
}

public function get_expertise(){
	return $this->expertise;
}

public function set_expertise($value){
	$this->$expertise=$value;
}

public function find_best_developer($base){
	$bestdev = "SELECT * FROM user inner join user_developer on user.user_id=developer_id order by bugs_fixed DESC LIMIT 1";
	return $dev = $base->query($bestdev)->fetch_array();
}

}
?>