<?php
/*$connect = true;
$fileconf = "app/app.config";
$env = json_decode(file_get_contents($fileconf)); 
$base= mysqli_connect($env->localhost, $env->root, $env->NULL, $env->roger_db);*/




	

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
        
        public function testbug_report(){
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
        }
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

class home_page{
	
	public function display_user_details($base,$user_id){
		$home_controller = new home_controller();
		return $home_controller->get_user_details($base,$user_id);
	}
	
	public function log_out()
	{
		 $home_controller = new home_controller();
		 $home_controller->end_session();
         return 1;
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