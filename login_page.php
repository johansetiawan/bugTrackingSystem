      <?php 
          $title="Roger Bug Tracker - Login";
          include('include/head.php');
include('include/content/login_controller.php');

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
        $result = $login_controller->verify_login($email,$password); 
		if($result==1){
		$data = "SELECT * FROM `user` WHERE `email` LIKE '".$email."'";
        $datauser = $this->base->query($data)->fetch_array(MYSQLI_ASSOC);
        $_SESSION['user'] = $datauser;
        if ($_SESSION['user']['user_type'] == "Reporter") {
              header('Location: home_page.php');
        }else{
              header('Location: home_page2.php');
        }
		}
		else{
			echo "<p class='alert error'><b>Login Fail!</b></p>";				  				  
		}
        }else{
            echo "<p class='alert error'><b>Attention !</b> Please do not leave blanks</p>";
        }
		
	}

 }

		$login_page = new login_page($base);
		if (isset($_SESSION['user'])) {
        header('Location: index.php');
      }

      if (isset($_POST['submit'])) {
          
			$email = $_POST['login'];
			$password = $_POST['password'];            
			$login_page->login($email,$password);
      }
      ?>

        <!--<div class="divleft"></div>-->
        <div class="content"> 
                <form action="login_page.php" method="post" style="max-width: 100%;">
        <table>
        <tr>
          <td><input type="text" name="login" placeholder="Username / Email"></input></td>
        </tr>
        <tr>
          <td><input type="password" name="password" placeholder="Password"></input></td>
        </tr>
        <tr>
          <td><input type="submit" name="submit" value="login"></td> 
        </tr>
      </table>
</form>
</div>
        <div class="divright"> 
          <?php include('include/divright/user.php');  ?>
        </div> 
        <?php include('include/footer.php'); ?>