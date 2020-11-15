<?php
/*$connect = true;
$fileconf = "app/app.config";
$env = json_decode(file_get_contents($fileconf)); 
$base= mysqli_connect($env->localhost, $env->root, $env->NULL, $env->roger_db);*/



session_start();
	

    class Calculator{
        public function sum($n1, $n2){
            return $n1 + $n2;
        }
    }
	


//	mysqli_select_db($base,"roger_db");

use PHPUnit\Framework\TestCase;
 
 /*   class CalculatorTest extends TestCase {
 
        public function testIsSumCorrect(){
            $calc = new Calculator();
            $result = $calc->sum(1,2.5);
            $expected = 3.5;
            $this->assertSame($expected,$result);       
        }
 
    }*/
	
	class testlogin extends TestCase{
	
		public function testlogin(){
			$base= mysqli_connect('localhost', 'root', '', 'roger_db');
			$test_user=new login_controller();
			$test = $test_user->verify_login($base,"3@roger.com","3@rogerpassword");
			//$user_id=$user->get_user_id();
			//$password=$user->get_password();
			//$full_name=$user->get_full_name();
			//$user_type=$user->type();
			//$expected_user_id="1";
			$expected=1;
			//$expected_password="password";
			//$expected_full_name="Test User";
			//$expected_user_type="tester";
			//$this->assertSame($expected_user_id,$user_id);
			$this->assertSame($expected,$test);
			//$this->assertSame($expected_password,$password);
			//$this->assertSame($expected_full_name,$full_name);
			//$this->assertSame($expected_user_type,$user_type);			
			
		}
        public function testlogout(){
            $test_user=new home_page();
            $test = $test_user->log_out();
			$expected=1;
			$this->assertSame($expected,$test);
        }
        
       /* public function testbug_report(){
            $base= mysqli_connect('localhost', 'root', '', 'roger_db');
            $test_report=new report_bug_controller();
            $test = $test_report->validate_bug_report($base,"1","title","desc","key","1","1");
			$expected=1;
			$this->assertSame($expected,$test);
        }
        
        public function testcomment(){
            $base= mysqli_connect('localhost', 'root', '', 'roger_db');
            $test_report=new bug_comment_controller();
            $test = $test_report->set_comment($base,"1","1","1","comment","2020-10-14 23:08:54");
			$expected=1;
			$this->assertSame($expected,$test);
        }*/
        public function register(){
            $base= mysqli_connect('localhost', 'root', '', 'roger_db');
            $test_report=new register_controller();
            $test = $test_report->validate_user_info($base,"email@1.com","password","name","Triager","password");
			$expected=1;
			$this->assertSame($expected,$test);
        }
		
		
	}
	
	class bug_comment_controller{
	public function set_comment($base,$comment_id,$user_id,$bug_report_id,$comment,$ts_created){
        try{
		$user_comment = new comment($base,$comment_id,$user_id,$bug_report_id,$comment,$ts_created);
		$addpro = "INSERT INTO comment(comment, bug_id,user_id) VALUES ('$comment', '$bug_report_id','$user_id' )";
        $rq = mysqli_query($base,$addpro);
        return 1;
            
        }
        catch (Exception $e)
        {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
            return 0;
        }
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
						//$register_page->display_success();
                       return 1;

                  }else{
                       return 0;
					  //$register_page->display_error();                      
                  }

              }else{
                  return 0;
				  //$register_page->display_error(); 
              }
}

	
}

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
 
class report_bug_controller{
	
	public function validate_bug_report($base, $reporter_id, $title, $description, $keyword, $version_no, $priority){
		 if (!empty($title) && !empty($description)&& !empty($keyword)&& !empty($version_no)&& !empty($priority)) {
			  $bug_report=new bug_report($base, NULL, $reporter_id, NULL, NULL, NULL, $title, $description, $keyword, $version_no, NULL, $priority, NULL, NULL, NULL);
			  $addpro = "INSERT INTO `bug_report` (`reporter_id`, `title`,`description`,`keyword`,`version_no`,`priority`) VALUES ('$reporter_id','$title','$description','$keyword','$version_no','$priority')";
			  $rq = mysqli_query($base,$addpro);
			  die("<p class='alert success'>.$addpro Success ! bug have been added !</p><br><center><a href='addproduit.php'>add another bug</a> - <a href='list_produit.php'>bug list</a></center>"); 
             return 1;
        }else{
            echo "<p class='alert error'><b>Attention !</b> error</p>";
             return 0;
        }	
	}
	
}	

class home_controller{
		
	public function end_session()
	{
		 session_destroy();
		 return 1;
		 //$login_UI = new login_UI(NULL);
		 //$login_UI->redirect_login();
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

class home_page{
	
	public function display_user_details($base,$user_id){
		$home_controller = new home_controller();
		return $home_controller->get_user_details($base,$user_id);
	}
	
	public function log_out()
	{
		 $home_controller = new home_controller();
		 return $home_controller->end_session();         
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

class login_controller{
	
	
	
	 public function verify_login($base,$email,$password)
	{       
			  $data = "SELECT * FROM `user` WHERE `email` LIKE '".$email."'";
			  $datauser = $base->query($data)->fetch_array(MYSQLI_ASSOC);
			  $user_id =$datauser['user_id'];
			  $user_email = $datauser['email'];
			  $user_password = $datauser['password'];
			  $full_name = $datauser['full_name'];
			  $user_type =$datauser['user_type'];
			  $reqnumlogin = "SELECT count(user_id) FROM user WHERE email LIKE '".$user_email."'";
              $result = $base->query($reqnumlogin);  
              $numLOGIN = $result->fetch_row(); 
  
              if ($numLOGIN['0'] == 1) {
				  $login_UI = new login_UI($base);
                  if ($password == $user_password) {
					return 1;
					
                    }else{
                        return 0;
                    }
                }else{
                 return 0;
                }

	}

	public function redirect_home($email)
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
	
}
	?>