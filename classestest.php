<?php

session_start();
	

    class Calculator{
        public function sum($n1, $n2){
            return $n1 + $n2;
        }
    }
	

use PHPUnit\Framework\TestCase;
 

	
	class test extends TestCase{
	
		public function test_register(){
            $base= mysqli_connect('localhost', 'root', '', 'roger_db');
            $test_user=new user($base,NULL,"test","test","test","test");
            $result = $test_user->insert_user("test");
			$expected=1;
			$this->assertSame($expected,$result);
        }
		
		public function test_login(){
			$base= mysqli_connect('localhost', 'root', '', 'roger_db');
			$test_user=new user($base,NULL,NULL,NULL,NULL,NULL);
			$result = $test_user->verify_user("1@roger.com","1@rogerpassword");
			$expected=1;
			$this->assertSame($expected,$result);
		}
        
        public function test_bug_report(){
            $base= mysqli_connect('localhost', 'root', '', 'roger_db');
            $test_report=new bug_report($base,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
            $result = $test_report->create_new_bug_report($base,"1", "title", "desc", "title", "1", "1");
			$expected=1;
			$this->assertSame($expected,$result);
        }
        
        public function testcomment(){
            $base= mysqli_connect('localhost', 'root', '', 'roger_db');
            $test_comment=new comment($base,NULL,NULL,NULL,NULL,NULL);;
            $result = $test_comment->create_comment($base,"1","1","1","comment","2020-10-14 23:08:54");
			$expected=1;
			$this->assertSame($expected,$result);
        }	
				
        public function test_logout(){
            $test_user=new home_page();
            $result = $test_user->log_out();
			$expected=1;
			$this->assertSame($expected,$result);
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


class home_controller{
		
	public function end_session()
	{
		 session_destroy();
		 return 1;
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


public function count_no_of_bugs_reported_monthly($base){      
		$monthly = "SELECT count(*) as count FROM `bug_report` WHERE MONTH(ts_created) = 10";
		return $base->query($monthly)->fetch_array();
}

public function count_no_of_bugs_reports_resolved_weekly($base){      
		$weekly= "SELECT count(*) as count FROM `bug_report` WHERE WEEKOFYEAR(ts_closed)=WEEKOFYEAR(CURDATE())";
		return $base->query($weekly)->fetch_array();
}

public function create_new_bug_report($base, $reporter_id, $title, $description, $keyword, $version_no, $priority){
	 if (!empty($title) && !empty($description)&& !empty($keyword)&& !empty($version_no)&& !empty($priority)) {			  
			  $addpro = "INSERT INTO `bug_report` (`reporter_id`, `title`,`description`,`keyword`,`version_no`,`priority`) VALUES ('$reporter_id','$title','$description','$keyword','$version_no','$priority')";
			  $rq = mysqli_query($base,$addpro);
			  return 1;			  
        }else{
			return 0;           
        }		
}

public function modify_bug_report_status_triager($base,$status,$triager_id,$bug_report_id,$ts){
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
}

public function modify_bug_report_status_developer($base,$status,$developer_id,$bug_report_id,$ts_modified){
	$editpro = "UPDATE bug_report SET status='fixed',ts_modified='".$ts_modified."' WHERE bug_id=".$bug_report_id."";
    $addpoint = "UPDATE user_developer set bugs_fixed = bugs_fixed+1 WHERE developer_id =".$developer_id."";
    $upd = mysqli_query($base,$addpoint);
	$rq = mysqli_query($base,$editpro);	
}

public function modify_bug_report_status_reviewer($base,$status,$reviewer_id,$bug_report_id,$ts_modified){
	$editpro = "UPDATE bug_report SET status='reviewed',ts_modified='".$ts_modified."' WHERE bug_id=".$bug_report_id."";
    $addpoint = "UPDATE user_reviewer set bugs_resolved = bugs_resolved+1 WHERE reviewer_id =".$reviewer_id."";
    $upd = mysqli_query($base,$addpoint);
	$rq = mysqli_query($base,$editpro);
}

public function modify_bug_report_assignee($base,$developer_id,$bug_report_id){
	$editpro = "UPDATE bug_report SET developer_id='".$developer_id."' WHERE bug_id=".$bug_report_id."";
	$rq = mysqli_query($base,$editpro);
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

public function delete_user_from_user_list($user_id)
{
	$user_type=$this->base->query("SELECT * FROM user WHERE user_id=".$user_id."");
	$user_type=$user_type->fetch_array();
	if($user_type['user_type']=='Developer')
	{
		$this->base->query("DELETE FROM user_developer WHERE developer_id=".$user_id."");	
	}
	else if($user_type['user_type']=='Reporter')
	{
		$this->base->query("DELETE FROM user_reporter WHERE reporter_id=".$user_id."");	
	}
	else if($user_type['user_type']=='Triager')
	{
		$this->base->query("DELETE FROM user_triager WHERE triager_id=".$user_id."");	
	}
	else if($user_type['user_type']=='Reviewer')
	{
		$this->base->query("DELETE FROM user_reviewer WHERE reviewer_id=".$user_id."");	
	}
	$this->base->query("DELETE FROM user WHERE user_id=".$user_id."");	
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
                        return 0;
                    }
                }else{
				 return 0;
                }
	}


	public function retrieve_user_details($base,$user_id){
		
		$data = "SELECT * FROM `user` WHERE `user_id` LIKE '".$user_id."'";
		$datauser = $base->query($data)->fetch_array(MYSQLI_ASSOC);
		return $datauser;
	}

	public function set_profile_details($base,$user_id,$email,$password){
		if (!empty($email) && !empty($password)) {
              //echo $_POST['descproduit'].'<hr>'.$descproduit; 
              $editpro = "UPDATE user SET email='$email',PASSWORD='$password' WHERE user_id='$user_id'";
              echo "<p class='alert error'><b>Attention !</b> $editpro</p>";
             //die($editpro);
              $rq = mysqli_query($base,$editpro);

              $data = "SELECT * FROM `user` WHERE `user_id` LIKE '".$_SESSION['user']['user_id']."'";
              $datauser = $base->query($data)->fetch_array(MYSQLI_ASSOC);
              $_SESSION['user'] = $datauser;
			  return 1;
         }else{
			 return 0;
        }
		
		
	}
	
	public function insert_user($confirm_password){
		$reqnumemail = "SELECT count(user_id) FROM user WHERE EMAIL LIKE '".$this->email."'";
        $result = $this->base->query($reqnumemail);  
        $numemail = $result->fetch_row(); 
		 if ($numemail['0'] == 0) {

                   if ($this->password == $confirm_password) {
						$req = "INSERT INTO `user` (`full_name`, `EMAIL`, `password`,`user_type`) VALUES ('".$this->full_name."','".$this->email."', '".$this->password."','".$this->user_type."')";
						$rq = mysqli_query($this->base,$req);											
						return 1;                      
                  }else{
					  return 0;                      
                  }

              }else{
				  return 0; 
              }
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

public function create_comment($base,$comment_id,$user_id,$bug_report_id,$comment,$ts_created){
		if (!empty($comment)) {
			  $addpro = "INSERT INTO comment(comment, bug_id,user_id) VALUES ('$comment', '$bug_report_id','$user_id' )";
			  $rq = mysqli_query($base,$addpro);
			  return 1;
         }else{
            return 0;
        }
}

}
	?>