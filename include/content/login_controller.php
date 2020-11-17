
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
			  $result = $user->verify_user($email,$password);			  
			  if($result==1){
				$home_page=new home_page;
				$home_page->redirect_home($this->base,$email);
			  }
			 else{
				$login_page = new login_page($this->base);
				$login_page->display_fail();				  				  
			 }
				  
	}

}
  ?>
