<?php
  include "classes.php";




class register_controller{
	
public function validate_user_info($base,$email, $password,$full_name, $user_type,$repassword){
	$register_page=new register_page;
	  
	$user = new user($base,NULL,$email,$password,$full_name,$user_type);
	$result=$user->insert_user($repassword);
			
	if($result==1){
		$register_page->display_success();                      
    }else{
		$register_page->display_error();                      
    }
	
}

	
}
?>
