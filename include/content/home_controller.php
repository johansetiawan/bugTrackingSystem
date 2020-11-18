<?php

include('classes.php');

class home_controller{
		
	public function end_session()
	{
		 session_destroy();
		 $login_page = new login_page(NULL);
		 $login_page->redirect_login();
	}
	
	public function get_user_details($base,$user_id){		
		$user = new user($base,NULL,NULL,NULL,NULL,NULL);
		return $user->retrieve_user_details($base,$user_id);
	}
	
	
}
?>
