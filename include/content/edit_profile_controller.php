
  <?php
      include("classes.php");




class edit_profile_controller{
	public function change_profile_details($base,$user_id,$email,$password){
	$user = new user($base,NULL,NULL,NULL,NULL,NULL);
	$result=$user->set_profile_details($base,$user_id,$email,$password);
	if($result==1){
	$home_page=new home_page();
	$home_page->redirect_home($base,$email);
         }else{
            $edit_profile_page=new edit_profile_page();
			$edit_profile_page->display_fail();
        }
	}
	
}
  ?>

