
 <?php

 
    include('Entity/user.php');
    include('Entity/user_administrator.php');
    include('Entity/user_developer.php');
    include('Entity/user_reporter.php');
    include('Entity/user_reviewer.php');
    include('Entity/user_triager.php');
    include('Entity/bug_report.php');
    include('Entity/comment.php');
 
 



class home_page{
	
	public function display_user_details($base,$user_id){
		$home_controller = new home_controller();
		return $home_controller->get_user_details($base,$user_id);
	}
	
	public function log_out()
	{
		 $home_controller = new home_controller();
		 $home_controller->end_session();
	}
	
	public function redirect_home($base,$email)
	{
		$data = "SELECT * FROM `user` WHERE `email` LIKE '".$email."'";
        $datauser = $base->query($data)->fetch_array(MYSQLI_ASSOC);
        $_SESSION['user'] = $datauser;
        if ($_SESSION['user']['user_type'] == "Reporter") {
              header('Location: home_page.php');
        }else{
              header('Location: user.php');
        }		
	}
	
	
}



 class login_page{
	 private $base = NULL;
	 
	 function __construct($base)
	 {
		 $this->base=$base;
	 }
	 
	 public function login($email,$password)
	{
        $login_controller = new login_controller($this->base);
		if (!empty($email) && !empty($password)) {
         $login_controller->verify_login($email,$password);     			
        }else{
            echo "<p class='alert error'><b>Attention !</b> Please do not leave blanks</p>";
        }
	}

	public function display_fail()
	{
		echo "<p class='alert error'><b>Login Fail!</b></p>";
	}
	 
	public function redirect_login()
	{
		header("location:login_page.php?logout=true");
	}
 }
class bug_report_list_page{
	
	public function display_bug_reports($base){
		$bug_report_list_controller = new bug_report_list_controller(); 
		return $bug_report_list_controller->get_bug_reports($base);    		
	}
	
	public function search_bug_report_by_keyword($base,$keyword){
		$bug_report_list_controller = new bug_report_list_controller(); 
		return $bug_report_list_controller->get_bug_report_by_keyword($base,$keyword);    		
	}
	
	public function search_bug_report_by_status($base,$status){
		$bug_report_list_controller = new bug_report_list_controller(); 
		return $bug_report_list_controller->get_bug_report_by_status($base,$status);    		
	}
	
	public function search_bug_report_by_title($base,$title){
		$bug_report_list_controller = new bug_report_list_controller(); 
		return $bug_report_list_controller->get_bug_report_by_title($base,$title);    		
	}
	
	public function search_bug_report_by_assignee($base,$assignee){
		$bug_report_list_controller = new bug_report_list_controller(); 
		return $bug_report_list_controller->get_bug_report_by_assignee($base,$assignee);    		
	}
	
	public function find_bug_reports_assigned_to_me($base,$developer_id){
		$bug_report_list_controller = new bug_report_list_controller(); 
		return $bug_report_list_controller->find_bug_reports_assigned_to_me($base,$developer_id);    		
	}
	
	public function delete_bug_report($base,$bug_report_id){
		$bug_report_list_controller = new bug_report_list_controller();
		$bug_report_list_controller->remove_bug_report($base,$bug_report_id);
	}
			
	public function redirect_bug_report_list(){
		header('Location: bug_report_list_page.php');	
	}
	
}

class report_bug_page{
	
	public function report_a_bug($base, $reporter_id, $title, $description, $keyword, $version_no, $priority){
		$report_bug_controller = new report_bug_controller();
		$report_bug_controller->validate_bug_report($base, $reporter_id, $title, $description, $keyword, $version_no, $priority);		
	}
	
	public function display_success(){
		die("<p class='alert success'>Success ! bug have been added !</p><br><center><a href='add_bug_page.php'>add another bug</a> - <a href='bug_report_list_page.php'>bug list</a></center>"); 
	}
	
	public function display_error(){
		 echo "<p class='alert error'><b>Attention !</b> error</p>";
	}

}

class bug_report_detail_page{
	
	public function display_bug_report_detail($base,$bug_report_id){
		$bug_report_detail_controller = new bug_report_detail_controller();
		return $bug_report_detail_controller->get_bug_report_details($base,$bug_report_id);
		
	}
	
	public function change_bug_report_status_triager($base,$status,$triager_id,$bug_report_id,$ts){
		$bug_report_detail_controller = new bug_report_detail_controller();
		$bug_report_detail_controller->set_bug_report_status_triager($base,$status,$triager_id,$bug_report_id,$ts);		
	}
	
	public function change_bug_report_status_developer($base,$status,$developer_id,$bug_report_id,$ts_modified){
		$bug_report_detail_controller = new bug_report_detail_controller();
		$bug_report_detail_controller->set_bug_report_status_developer($base,$status,$developer_id,$bug_report_id,$ts_modified);		
	}
	
	public function change_bug_report_status_reviewer($base,$status,$reviewer_id,$bug_report_id,$ts_modified){
		$bug_report_detail_controller = new bug_report_detail_controller();
		$bug_report_detail_controller->set_bug_report_status_reviewer($base,$status,$reviewer_id,$bug_report_id,$ts_modified);		
	}
	
	
	public function assign_developer($base,$developer_id,$bug_report_id){
		$bug_report_detail_controller = new bug_report_detail_controller();
		$bug_report_detail_controller->set_bug_report_assignee($base,$developer_id,$bug_report_id,);		
	}	
	
}
class bug_comment_page{
	public function comment($base,$comment_id,$user_id,$bug_report_id,$comment,$ts_created){
	$bug_comment_controller = new bug_comment_controller();
	$bug_comment_controller->set_comment($base,$comment_id,$user_id,$bug_report_id,$comment,$ts_created);		
	}
	
	public function display_comments($base,$bug_id){
		$bug_comment_controller = new bug_comment_controller($base,$bug_id);
		return $bug_comment_controller->get_comments($base,$bug_id);	
	}
	
	public function refresh_page(){
		echo "<meta http-equiv='refresh' content='0'>";
	}
	
	public function display_error(){
		echo "<p class='alert error'><b>Attention !</b> error</p>";
	}
	
}
class edit_profile_page{
	public function edit_profile($base,$user_id,$email,$password){
	$edit_profile_controller = new edit_profile_controller();
	$edit_profile_controller->change_profile_details($base,$user_id,$email,$password);
	}
	
	public function display_fail(){
		echo "<p class='alert error'><b>Attention !</b> put something ah sial</p>";
	}
}

	class generate_report_page{
	public function generate_best_developer($base){
		$generate_report_controller = new generate_report_controller();
		return $generate_report_controller->get_best_developer($base);
	}
	
	public function generate_best_reporter($base){
		$generate_report_controller = new generate_report_controller();
		return $generate_report_controller->get_best_reporter($base);
	}
	
	public function generate_no_of_bugs_reported_monthly($base){
		$generate_report_controller = new generate_report_controller();
		return $generate_report_controller->get_no_of_bugs_reported_monthly($base);		
	}
	
	public function generate_no_of_bugs_reports_resolved_weekly($base){
		$generate_report_controller = new generate_report_controller();
		return $generate_report_controller->get_no_of_bugs_reports_resolved_weekly($base);		
	}
}
class register_page{



public function register_user($base,$email,$password,$full_name,$user_type,$repassword){
	$register_controller = new register_controller();
	$register_controller->validate_user_info($base,$email, $password,$full_name,$user_type,$repassword);
	
}

public function display_success(){	
	die("<p class='alert success'>Account created</p><br><center><a href='login_page.php'>Login</a> - <a href='index.php'>Home</a></center>");	
}

public function display_error(){
	
	echo "<p class='alert error'><b>Attention !</b> password field and confirm password field are not the same or email already exists</p>";	
}
	
}
class user_list_page{
	public function delete_user($base,$user_id){
	$user_list_controller = new user_list_controller();
	$user_list_controller->find_and_delete_user($base,$user_id);
	}	
}
 ?>