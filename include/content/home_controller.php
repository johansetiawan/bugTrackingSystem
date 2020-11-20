<?php
include('Entity/user.php');

class home_controller{
	
	public function get_user_details($base,$user_id){		
		$user = new user($base,NULL,NULL,NULL,NULL,NULL);
		return $user->retrieve_user_details($base,$user_id);
	}
	
	public function end_session()
	{
		 session_destroy();
		 header("location:login_page.php?logout=true");
	}
	
}
?>
