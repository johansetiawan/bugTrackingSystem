
  <?php
        include "classes.php";


 
 
class login_controller{
	
	protected $base=NULL;
	
	function __construct($base)
	{
		$this->base=$base;
	}
	
	
	public function verify_login($email,$password)
	{       
			  $user = new user($this->base,NULL,NULL,NULL,NULL,NULL);
			  return $result = $user->verify_user($email,$password);			  
				  
	}

}
  ?>
