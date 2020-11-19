<?php
include('Entity/user.php');




class user_list_controller{
	public function find_and_delete_user($base,$user_id){
	$user = new user($base,NULL,NULL,NULL,NULL,NULL);
	$user->delete_user_from_user_list($user_id);		
	}
	
}
?>