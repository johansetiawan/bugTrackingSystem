<?php 

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
?>