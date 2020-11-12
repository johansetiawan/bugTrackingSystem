
 <?php

 
 
 class login_UI{
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
		header("location:login.php?logout=true");
	}
 }
 
 
class login_controller{
	
	protected $base=NULL;
	
	function __construct($base)
	{
		$this->base=$base;
	}
	
	
	public function verify_login($email,$password)
	{       
			  $data = "SELECT * FROM `user` WHERE `email` LIKE '".$email."'";
			  $datauser = $this->base->query($data)->fetch_array(MYSQLI_ASSOC);
			  $user_id =$datauser['user_id'];
			  $user_email = $datauser['email'];
			  $user_password = $datauser['password'];
			  $full_name = $datauser['full_name'];
			  $user_type =$datauser['user_type'];
			  $user = new user($this->base,$user_id,$email,$user_password,$full_name,$user_type);
			  $result = $user->verify_user($email,$password);
			  $login_UI = new login_UI($this->base);
			  if($result==1){
				$home_page=new home_page;
				$home_page->redirect_home($this->base,$user_email);
			  }
			 else if($result==NULL){
			$login_UI->display_fail();				  				  
			 }
				  
	}

}
 
 
class user{
	
protected $base = NULL;
protected $user_id =NULL;
protected $email = NULL;
protected $password = NULL;
protected $full_name = NULL;
protected $user_type =NULL;


function __construct($base,$user_id,$email,$password,$full_name,$user_type)
{
	$this->base = $base;
	$this->user_id = $user_id;
	$this->email = $email;
	$this->password = $password;
	$this->full_name = $full_name;
	$this->user_type = $user_type;
}

public function set_user_id($value)
{
	$this->user_id = $value;
}
public function set_email($value)
{
	$this->email = $value;
}
public function set_password($value)
{
	$this->password = $value;
}
public function set_full_name($value)
{
	$this->full_name = $value;
}
public function set_user_type($value)
{
	$this->version_no = $value;
}



public function get_user_id()
{
	return $this->user_id;
}
public function get_email()
{
	return $this->email;
}
public function get_password()
{
	return $this->password;
}
public function get_full_name()
{
	return $this->full_name;
}
public function get_user_type()
{
	return $this->user_type;
}

public function delete_user_from_user_list()
{
	$this->base->query("DELETE FROM user WHERE user_id=".$this->user_id."");	
}

	public function verify_user($email,$password)
	{       
			  $data = "SELECT * FROM `user` WHERE `email` LIKE '".$email."'";
			  $datauser = $this->base->query($data)->fetch_array(MYSQLI_ASSOC);
			  $user_id =$datauser['user_id'];
			  $user_email = $datauser['email'];
			  $user_password = $datauser['password'];
			  $full_name = $datauser['full_name'];
			  $user_type =$datauser['user_type'];
			  $reqnumlogin = "SELECT count(user_id) FROM user WHERE email LIKE '".$user_email."'";
              $result = $this->base->query($reqnumlogin);  
              $numLOGIN = $result->fetch_row(); 			  
              if ($numLOGIN['0'] == 1) {
				  
                  if ($password == $user_password) {
					return 1;					
                    }else{
                        return NULL;
                    }
                }else{
				 return NULL;
                }
	}


	public function retrieve_user_details($base,$user_id){
		
		$data = "SELECT * FROM `user` WHERE `user_id` LIKE '".$user_id."'";
		$datauser = $base->query($data)->fetch_array(MYSQLI_ASSOC);
		return $datauser;
	}


	
}

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

public function get_no_of_bug_report_fixedl(){
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


class user_triager extends user{
	
protected $bug_report_closed=NULL;

function __construct($base,$user_id,$email,$password,$full_name,$user_type)
{
	$this->base = $base;
	$this->user_id = $user_id;
	$this->email = $email;
	$this->password = $password;
	$this->full_name = $full_name;
	$this->user_type = $user_type;
}

public function get_no_of_bug_report_closed(){
	return $this->bug_report_closed;
}

public function set_no_of_bug_report_closed($value){
	$this->$bug_report_closed=$value;
}

}


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

}

class user_administrator extends user{

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

}


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
              header('Location: admin.php');
        }else{
              header('Location: user.php');
        }		
	}
	
	
}


class home_controller{
		
	public function end_session()
	{
		 session_destroy();
		 $login_UI = new login_UI(NULL);
		 $login_UI->redirect_login();
	}
	
	public function get_user_details($base,$user_id){
		
		$data = "SELECT * FROM `user` WHERE `user_id` LIKE '".$user_id."'";
		$datauser = $base->query($data)->fetch_array(MYSQLI_ASSOC);
		$user_id =$datauser['user_id'];
		$user_email = $datauser['email'];
		$user_password = $datauser['password'];
		$full_name = $datauser['full_name'];
		$user_type =$datauser['user_type'];
		$user = new user($base,$user_id,$user_email,$user_password,$full_name,$user_type);
		return $user->retrieve_user_details($base,$user_id);
	}
	
	
}


class register_page{



public function register_user($base,$email,$password,$full_name,$user_type,$repassword){
	$register_controller = new register_controller();
	$register_controller->validate_user_info($base,$email, $password,$full_name, $user_type,$repassword);
	
}

public function display_success(){	
	die("<p class='alert success'>Account created</p><br><center><a href='login.php'>Login</a> - <a href='index.php'>Home</a></center>");	
}

public function display_error(){
	
	echo "<p class='alert error'><b>Attention !</b> password is not the same or email already exists</p>";	
}
	
}


class register_controller{

	
public function validate_user_info($base,$email, $password,$full_name, $user_type,$repassword){
	  $register_page=new register_page;
	  $reqnumemail = "SELECT count(user_id) FROM user WHERE EMAIL LIKE '".$email."'";
              $result = $base->query($reqnumemail);  
              $numemail = $result->fetch_row(); 
  
              if ($numemail['0'] == 0) {

                   if ($password == $repassword) {
						$user = new user($base,NULL,$email,$password,$full_name,$user_type);                     
						$req = "INSERT INTO `user` (`full_name`, `EMAIL`, `password`,`user_type`) VALUES ('$full_name','$email', '$password','$user_type')";
                        $rq = mysqli_query($base,$req);						
						$register_page->display_success();                      

                  }else{
					  $register_page->display_error();                      
                  }

              }else{
				  $register_page->display_error(); 
              }
}

	
}

class edit_profile_page{
	public function edit_profile($base,$password,$email,$user_id){
		$edit_profile_controller=new edit_profile_controller();
		$edit_profile_controller->validate_info($base,$password,$email,$user_id);
	}
	
	
	
	
}


class edit_profile_controller{
	public function validate_info($base,$password,$email,$user_id){
		$data = "SELECT * FROM `user` WHERE `user_id` LIKE '".$user_id."'";
		$datauser = $base->query($data)->fetch_array(MYSQLI_ASSOC);
		$user_id =$datauser['user_id'];
		$user_email = $datauser['email'];
		$user_password = $datauser['password'];
		$full_name = $datauser['full_name'];
		$user_type =$datauser['user_type'];
		$user = new user($base,$user_id,$user_email,$user_password,$full_name,$user_type);
		$user->set_email=$email;
		$user->set_password=$password;
		$new_email=$user->get_email();
		$new_password=$user->get_password();
		
		$editpro = "UPDATE user SET email='$new_email',PASSWORD='$new_password' WHERE user_id='$user_id'";
        echo "<p class='alert error'><b>Attention !</b> $editpro</p>";
        //die($editpro);
        $rq = mysqli_query($base,$editpro);

        $data = "SELECT * FROM `user` WHERE `user_id` LIKE '".$_SESSION['user']['user_id']."'";
        $datauser = $base->query($data)->fetch_array(MYSQLI_ASSOC);
        $_SESSION['user'] = $datauser;

        if ($user_type == "Reporter") {
            header('Location: admin.php');
        }else{
            header('Location: user.php');
        }
		
				
	}
		
}


class bug_report{
	
private $base = NULL;
private $bug_report_id =NULL;
private $reporter_id = NULL;
private $triager_id = NULL;
private $developer_id = NULL;
private $reviewer_id =NULL;
private $title =NULL;
private $description =NULL;
private $keyword =NULL;
private $version_no =NULL;
private $status =NULL;
private $priority =NULL;
private $ts_created =NULL;
private $ts_closed =NULL;
private $ts_modified =NULL;

function __construct($base, $bug_report_id, $reporter_id, $triager_id, $developer_id, $reviewer_id, $title, $description, $keyword, $version_no, $status, $priority, $ts_created, $ts_closed, $ts_modified){
	$this->base=$base;
	$this->bug_report_id=$bug_report_id;
	$this->reporter_id=$reporter_id;
	$this->triager_id=$triager_id;
	$this->developer_id=$developer_id;
	$this->developer_id=$developer_id;
	$this->reviewer_id=$reviewer_id;
	$this->title=$title;
	$this->description=$description;
	$this->keyword=$keyword;
	$this->version_no=$version_no;
	$this->status=$status;
	$this->priority=$priority;
	$this->ts_created=$ts_created;
	$this->ts_closed=$ts_closed;
	$this->ts_modified=$ts_modified;	
}

public function set_bug_report_id($value)
{
	$this->bug_report_id = $value;
}
public function set_reporter_id($value)
{
	$this->reporter_id = $value;
}
public function set_triager_id($value)
{
	$this->triager_id = $value;
}
public function set_developer_id($value)
{
	$this->developer_id = $value;
}
public function set_reviewer_id($value)
{
	$this->reviewer_id = $value;
}
public function set_title($value)
{
	$this->title = $value;
}
public function set_description($value)
{
	$this->description = $value;
}
public function set_keyword($value)
{
	$this->keyword = $value;
}
public function set_version_no($value)
{
	$this->version_no = $value;
}
public function set_status($value)
{
	$this->status = $value;
}
public function set_priority($value)
{
	$this->priority = $value;
}
public function set_ts_created($value)
{
	$this->ts_created = $value;
}
public function set_ts_closed($value)
{
	$this->ts_closed = $value;
}
public function set_ts_modified($value)
{
	$this->ts_modified = $value;
}



public function get_bug_report_id()
{
	return $this->bug_report_id;
}
public function get_reporter_id()
{
	return $this->reporter_id;
}
public function get_triager_id()
{
	return $this->triager_id;
}
public function get_developer_id()
{
	return $this->developer_id;
}
public function get_reviewer_id()
{
	return $this->reviewer_id;
}
public function get_title()
{
	return $this->title;
}
public function get_description()
{
	return $this->description;
}
public function get_keyword()
{
	return $this->keyword;
}
public function get_version_no()
{
	return $this->version_no;
}
public function get_status()
{
	return $this->status;
}
public function get_priority()
{
	return $this->priority;
}
public function get_ts_created()
{
	return $this->ts_created;
}
public function get_ts_closed()
{
	return $this->ts_closed;
}
public function get_ts_modified()
{
	return $this->ts_modified;
}

public function create_bug_report($base){
   if (!empty($_POST['nomproduit']) && !empty($_POST['descproduit'])&& !empty($_POST['keyword'])&& !empty($_POST['versiono'])&& !empty($_POST['priority'])) {
              
              $reporterid = $_SESSION['user']['user_id'];
              $nomproduit = mysqli_real_escape_string($base,$_POST['nomproduit']);
              $descproduit = mysqli_real_escape_string($base,nl2br($_POST['descproduit']));
              $feature = mysqli_real_escape_string($base,nl2br($_POST['keyword']));
              $versiono = mysqli_real_escape_string($base,nl2br($_POST['versiono']));
              $priority = mysqli_real_escape_string($base,nl2br($_POST['priority']));


              $addpro = "INSERT INTO `bug_report` (`reporter_id`, `title`,`description`,`keyword`,`version_no`,`priority`) VALUES ('$reporterid','$nomproduit','$descproduit','$feature','$versiono','$priority')";
              $rq = mysqli_query($base,$addpro);
            die("<p class='alert success'>Success ! bug have been added !</p><br><center><a href='addproduit.php'>add another bug</a> - <a href='list_produit.php'>bug list</a></center>"); 
        }else{
            echo "<p class='alert error'><b>Attention !</b> error</p>";
        }
}

public function retrieve_all_bug_reports($base){      
		$allproduit = "SELECT * FROM `bug_report`";
		$produits = $base->query($allproduit);
		return $produits;
}	

public function retrieve_bug_report_by_keyword($base,$keyword){      
		$allproduit = "SELECT * FROM `bug_report` where  keyword = '$keyword'";
		$produits = $base->query($allproduit);
		return $produits;
}	

public function retrieve_bug_report_by_status($base,$status){      
		$allproduit = "SELECT * FROM `bug_report` where  status = '$status'";
		$produits = $base->query($allproduit);
		return $produits;
}

public function retrieve_bug_report_by_title($base,$title){      
		$allproduit = "SELECT * FROM `bug_report` where  title = '$title'";
		$produits = $base->query($allproduit);
		return $produits;
}			

public function retrieve_bug_report_by_assignee($base,$assignee){      
		$allproduit = "SELECT * FROM `user` as a inner join `bug_report` as b on b.developer_id = a.user_id where a.full_name = '$assignee'";
		$produits = $base->query($allproduit);
		return $produits;
}	

public function retrieve_all_bug_report_assigned_to_me($base,$developer_id){      
		$allproduit = "SELECT * FROM `bug_report` where developer_id = ".$developer_id;
		$produits = $base->query($allproduit);
		return $produits;
}

public function remove_bug_report_from_database($base,$bug_report_id){	
    $data = "SELECT * FROM `bug_report` WHERE `bug_id` LIKE '".$bug_report_id."'";
    $dataproduit = $base->query($data)->fetch_array(MYSQLI_ASSOC);
    if (!empty($dataproduit)) {
        $base->query("DELETE FROM bug_report WHERE bug_id=".$bug_report_id."");
    } 
}

public function bug_report_details($base,$bug_report_id){
	$data = "SELECT * FROM `bug_report` WHERE `bug_id` LIKE '".$bug_report_id."'";
	return $dataproduit = $base->query($data)->fetch_array(MYSQLI_ASSOC);
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
		header('Location: list_produit.php');	
	}
	
}


class bug_report_list_controller{
	
	public function get_bug_reports($base){		
		$bug_report = new bug_report($base,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
		return $bug_report->retrieve_all_bug_reports($base);
	}
	
	
	public function get_bug_report_by_keyword($base,$keyword){		
		$bug_report = new bug_report($base,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
		return $bug_report->retrieve_bug_report_by_keyword($base,$keyword);
	}
	
	public function get_bug_report_by_status($base,$status){		
		$bug_report = new bug_report($base,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
		return $bug_report->retrieve_bug_report_by_status($base,$status);
	}
	
	public function get_bug_report_by_title($base,$title){		
		$bug_report = new bug_report($base,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
		return $bug_report->retrieve_bug_report_by_title($base,$title);
	}
	
	public function get_bug_report_by_assignee($base,$assignee){		
		$bug_report = new bug_report($base,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
		return $bug_report->retrieve_bug_report_by_assignee($base,$assignee);
	}
	
	public function find_bug_reports_assigned_to_me($base,$developer_id){
		$bug_report = new bug_report($base,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
		return $bug_report->retrieve_all_bug_report_assigned_to_me($base,$developer_id); 		
	}
	

}


class report_bug_page{
	
	public function report_a_bug($base, $reporter_id, $title, $description, $keyword, $version_no, $priority){
		$report_bug_controller = new report_bug_controller();
		$report_bug_controller->validate_bug_report($base, $reporter_id, $title, $description, $keyword, $version_no, $priority);		
	}

}

class report_bug_controller{
	
	public function validate_bug_report($base, $reporter_id, $title, $description, $keyword, $version_no, $priority){
		 if (!empty($title) && !empty($description)&& !empty($keyword)&& !empty($version_no)&& !empty($priority)) {
			  $bug_report=new bug_report($base, NULL, $reporter_id, NULL, NULL, NULL, $title, $description, $keyword, $version_no, NULL, $priority, NULL, NULL, NULL);
			  $addpro = "INSERT INTO `bug_report` (`reporter_id`, `title`,`description`,`keyword`,`version_no`,`priority`) VALUES ('$reporter_id','$title','$description','$keyword','$version_no','$priority')";
			  $rq = mysqli_query($base,$addpro);
			  die("<p class='alert success'>.$addpro Success ! bug have been added !</p><br><center><a href='addproduit.php'>add another bug</a> - <a href='list_produit.php'>bug list</a></center>"); 
        }else{
            echo "<p class='alert error'><b>Attention !</b> error</p>";
        }	
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

class bug_report_detail_controller{
	
	public function get_bug_report_details($base,$bug_report_id){
			$bug_report = new bug_report($base,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
			return $bug_report->bug_report_details($base,$bug_report_id);				
	}
		
	public function set_bug_report_status_triager($base,$status,$triager_id,$bug_report_id,$ts){
		$bug_report = new bug_report($base,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
		$bug_report->set_status($status);	
		$bug_report->set_triager_id($triager_id);
		if($status=='closed')
		$editpro = "UPDATE bug_report SET status='".$status."',triager_id ='".$triager_id."',ts_closed='".$ts."' WHERE bug_id=".$bug_report_id."";
		else if($status=='invalid'||$status=='duplicate')
		$editpro = "UPDATE bug_report SET status='".$status."',triager_id ='".$triager_id."',ts_modified='".$ts."',ts_closed='".$ts."' WHERE bug_id=".$bug_report_id."";
		else
		$editpro = "UPDATE bug_report SET status='".$status."',triager_id ='".$triager_id."',ts_modified='".$ts."' WHERE bug_id=".$bug_report_id."";
        if($status == "closed")
        {
            $addpoint = "UPDATE user_triager set bugs_closed = bugs_closed+1 WHERE triager_id =".$triager_id."";
            $upd = mysqli_query($base,$addpoint);
        }
		$rq = mysqli_query($base,$editpro);
		$bug_report_list_page=new bug_report_list_page();
		$bug_report_list_page->redirect_bug_report_list();
	}
	
	public function set_bug_report_status_developer($base,$status,$developer_id,$bug_report_id,$ts_modified){
		$bug_report = new bug_report($base,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
		$bug_report->set_status($status);	
		$editpro = "UPDATE bug_report SET status='fixed',ts_modified='".$ts_modified."' WHERE bug_id=".$bug_report_id."";
        $addpoint = "UPDATE user_developer set bugs_fixed = bugs_fixed+1 WHERE developer_id =".$developer_id."";
        $upd = mysqli_query($base,$addpoint);
		$rq = mysqli_query($base,$editpro);		
		$bug_report_list_page=new bug_report_list_page();
		$bug_report_list_page->redirect_bug_report_list();
	}
		
	public function set_bug_report_status_reviewer($base,$status,$reviewer_id,$bug_report_id,$ts_modified){
		$bug_report = new bug_report($base,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
		$bug_report->set_status($status);	
		$bug_report->set_reviewer_id($reviewer_id);
		$editpro = "UPDATE bug_report SET status='reviewed',ts_modified='".$ts_modified."' WHERE bug_id=".$bug_report_id."";
        $addpoint = "UPDATE user_reviewer set bugs_resolved = bugs_resolved+1 WHERE reviewer_id =".$reviewer_id."";
        $upd = mysqli_query($base,$addpoint);
		$rq = mysqli_query($base,$editpro);
		$bug_report_list_page=new bug_report_list_page();
		$bug_report_list_page->redirect_bug_report_list();
	}
	
	public function set_bug_report_assignee($base,$developer_id,$bug_report_id){
		$bug_report = new bug_report($base,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
		$bug_report->set_developer_id($developer_id);
		$editpro = "UPDATE bug_report SET developer_id='".$developer_id."' WHERE bug_id=".$bug_report_id."";
		$rq = mysqli_query($base,$editpro);	
		$bug_report_list_page=new bug_report_list_page();
		$bug_report_list_page->redirect_bug_report_list();
	}
		
}

class generate_report_page{
	public function generate_best_developer($base){
		$generate_report_controller = new generate_report_controller();
		return $generate_report_controller->get_best_developer($base);
	}
}



class generate_report_controller{
	public function get_best_developer($base){
		$user_developer = new user_developer($base,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
		return $user_developer->find_best_developer($base);		
	}
}

class bug_comment_page{
	public function comment($base,$comment_id,$user_id,$bug_report_id,$comment,$ts_created){
	$bug_comment_controller = new bug_comment_controller();
	$bug_comment_controller->set_comment($base,$comment_id,$user_id,$bug_report_id,$comment,$ts_created);		
	}
	
	
}


class bug_comment_controller{
	public function set_comment($base,$comment_id,$user_id,$bug_report_id,$comment,$ts_created){
		$user_comment = new comment($base,$comment_id,$user_id,$bug_report_id,$comment,$ts_created);
		$addpro = "INSERT INTO comment(comment, bug_id,user_id) VALUES ('$comment', '$bug_report_id','$user_id' )";
        $rq = mysqli_query($base,$addpro);
	}
	
	
}


class comment{
private $base = NULL;
protected $comment_id = NULL;
protected $user_id = NULL;
protected $bug_report_id=NULL;
protected $comment=NULL;
protected $ts_created=NULL;


function __construct($base,$comment_id,$user_id,$bug_report_id,$comment,$ts_created){
	$this->base=$base;
	$this->comment_id=$comment_id;
	$this->user_id=$user_id;
	$this->bug_report_id=$bug_report_id;
	$this->comment=$comment;
	$this->ts_created=$ts_created;
	
}

public function get_comment_id(){
	return $this->comment_id;
}

public function set_comment_id($value){
	$this->comment_id=$value;
}

public function get_comment_user_id(){
	return $this->user_id;
}

public function set_comment_user_id($value){
	$this->user_id=$value;
}

public function get_comment_bug_report_id(){
	return $this->bug_report_id;
	
}

public function set_comment_bug_report_id($value){
	
	$this->bug_report_id=$value;
}

public function get_comment(){
	return $this->comment;
	
}

public function set_comment($value){

	$this->comment=$value;
}

public function get_ts_created(){
	return $this->ts_created;
	
}

public function set_ts_created($value){
	
	$this->ts_created=$value;
}


}


class user_list_page{
	public function delete_user($base,$user_id){
	$user_list_controller = new user_list_controller();
	$user_list_controller->find_and_delete_user($base,$user_id);
	}	
}


class user_list_controller{
	public function find_and_delete_user($base,$user_id){
	$user = new user($base,$user_id,NULL,NULL,NULL,NULL);
	$user->delete_user_from_user_list();
		
	}
	
}


	 
 ?>