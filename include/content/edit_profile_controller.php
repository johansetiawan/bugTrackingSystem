
  <?php
      include("classes.php");




class edit_profile_controller{
	public function change_profile_details($base,$user_id,$email,$password){
	$user = new user($base,NULL,NULL,NULL,NULL,NULL);
	return $result=$user->set_profile_details($base,$user_id,$email,$password);	
}
}
  ?>

