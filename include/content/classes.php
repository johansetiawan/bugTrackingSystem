
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
            echo "<p class='alert error'><b>Attention !</b> put something ah sial</p>";
          }
	}

	public function display_fail()
	{
		echo "<p class='alert error'><b>Login Fail!</b></p>";
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
			  if($user_type == "Reviewer")
			  $user_reviewer = new user_reviewer($this->base,$user_id,$email,$user_password,$full_name,$user_type);
		      else if($user_type=="Developer")
			  $user_developer = new user_developer($this->base,$user_id,$email,$user_password,$full_name,$user_type);
		      else if($user_type=="Triager")
			  $user_triager = new user_triager($this->base,$user_id,$email,$user_password,$full_name,$user_type);
		      else if($user_type=="Reporter")
			  $user_reporter = new user_reporter($this->base,$user_id,$email,$user_password,$full_name,$user_type);
			  $reqnumlogin = "SELECT count(user_id) FROM user WHERE email LIKE '".$user_email."'";
              $result = $this->base->query($reqnumlogin);  
              $numLOGIN = $result->fetch_row(); 
  
              if ($numLOGIN['0'] == 1) {
				  $login_UI = new login_UI($this->base);
                  if ($password == $user_password) {
					$this->redirect_home($user_email);
                    }else{
                        $login_UI->display_fail();
                    }
                }else{
                 $login_UI->display_fail();
                }

	}

	public function redirect_home($email)
	{
		$data = "SELECT * FROM `user` WHERE `email` LIKE '".$email."'";
        $datauser = $this->base->query($data)->fetch_array(MYSQLI_ASSOC);
        $_SESSION['user'] = $datauser;
        if ($_SESSION['user']['user_type'] == "Reporter") {
              header('Location: admin.php');
        }else{
              header('Location: user.php');
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
/*
public function logout()
{
    echo '<a href="login.php?logout=true"> <i class="ion ion-power"></i> Logout</a>';
}
*//*
public function search_bug_report_by_title($base){
		$search = mysqli_real_escape_string($base,$_POST['search']);
        $type = mysqli_real_escape_string($base,$_POST['type']);
        
        $allproduit = "SELECT * FROM `bug_report` where  title = '$search'";
        
		return $allproduit;
}

public function search_bug_report_by_assignee($base){
		$search = mysqli_real_escape_string($base,$_POST['search']);
        $type = mysqli_real_escape_string($base,$_POST['type']);
		
        $allproduit = "SELECT * FROM `user` as a inner join `bug_report` as b on b.developer_id = a.user_id where a.full_name = '$search'";
		
		return $allproduit;
}

public function search_bug_report_by_status($base){
		$search = mysqli_real_escape_string($base,$_POST['search']);
        $type = mysqli_real_escape_string($base,$_POST['type']);
        
        $allproduit = "SELECT * FROM `bug_report` where  status = '$search'";
        
		return $allproduit;
}

public function search_bug_report_by_keyword($base){
		$search = mysqli_real_escape_string($base,$_POST['search']);
        $type = mysqli_real_escape_string($base,$_POST['type']);
        
        $allproduit = "SELECT * FROM `bug_report` where  keyword = '$search'";
        
		return $allproduit;
}
*/
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


class home_page{
	
	public function log_out()
	{
		 $home_controller = new home_controller();
		 $home_controller->end_session();
	}
	
	
}


class home_controller{
		
	public function end_session()
	{
		 session_destroy();
		 $this->redirect_login();
	}
	
	public function redirect_login()
	{
		header("location:login.php?logout=true");
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
                        if($user_type == "Reviewer")
						$user_reviewer = new user_reviewer($base,NULL,$email,$password,$full_name,$user_type);
						else if($user_type=="Developer")
						$user_developer = new user_developer($base,NULL,$email,$password,$full_name,$user_type);
						else if($user_type=="Triager")
						$user_triager = new user_triager($base,NULL,$email,$password,$full_name,$user_type);
						else if($user_type=="Reporter")
						$user_reporter = new user_reporter($base,NULL,$email,$password,$full_name,$user_type);                        
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

public function redirect_login(){}
	
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
            die("<p class='alert success'>.$addpro Success ! bug have been added !</p><br><center><a href='addproduit.php'>add another bug</a> - <a href='list_produit.php'>bug list</a></center>"); 
        }else{
            echo "<p class='alert error'><b>Attention !</b> error</p>";
        }
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

}
	

class bug_report_list_page{
	
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
	
}


class bug_report_list_controller{
	
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
}	
	 
 ?>