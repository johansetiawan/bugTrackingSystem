
 <?php
class user{
	
private $user_id =NULL;
private $email = NULL;
private $password = NULL;
private $full_name = NULL;
private $user_type =NULL;


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

public function login($base)
{
            $loguser = mysqli_real_escape_string($base,$_POST['login']);
            $passuser = mysqli_real_escape_string($base,$_POST['password']);
			$this->email = $_POST['login'];
			$this->password = $_POST['password'];

        if (!empty($loguser) && !empty($passuser)) {
              
              $reqnumlogin = "SELECT count(user_id) FROM user WHERE email LIKE '".$this->email."'";
              $result = $base->query($reqnumlogin);  
              $numLOGIN = $result->fetch_row(); 
  
              if ($numLOGIN['0'] == 1) {

                  $findpass = "SELECT `password` FROM `user` WHERE `email` LIKE '". $this->email."'";
                  $realpass = $base->query($findpass)->fetch_object()->password;  
                  $userpass = $this->password;
                  if ($userpass == $realpass) {

                        $data = "SELECT * FROM `user` WHERE `email` LIKE '".$this->email."'";
                        $datauser = $base->query($data)->fetch_array(MYSQLI_ASSOC);
                        $_SESSION['user'] = $datauser;
                        if ($_SESSION['user']['user_type'] == "Reporter") {
                            header('Location: admin.php');
                        }else{
                            header('Location: user.php');
                        }

                    }else{
                        echo "<p class='alert error'><b>Attention !</b> wrong ah sial</p>";
                    }
                }else{
                  echo "<p class='alert error'><b>Attention !</b> no connection</p>";
                }
        }else{
            echo "<p class='alert error'><b>Attention !</b> put something ah sial</p>";
          }
}

}
	 
	 
 ?>