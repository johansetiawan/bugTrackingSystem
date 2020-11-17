<?php
    class user_reporter extends user{

protected $roles=NULL;
protected $bugs_reported=NULL;
function __construct($base,$user_id,$email,$password,$full_name,$user_type)
{
	$this->base = $base;
	$this->user_id = $user_id;
	$this->email = $email;
	$this->password = $password;
	$this->full_name = $full_name;
	$this->user_type = $user_type;
}

public function get_roles(){
	return $this->roles;
}

public function set_roles($value){
	$this->$roles=$value;
}

public function get_no_of_bugs_reported(){
	return $this->bugs_reported;
}

public function set_no_of_bugs_reported($value){
	$this->$bugs_reported=$value;
}

public function find_best_reporter($base){
	$bestdev = "SELECT * FROM user inner join user_reporter on user.user_id=reporter_id order by bugs_reported DESC LIMIT 1";
	return $dev = $base->query($bestdev)->fetch_array();
}

}
?>