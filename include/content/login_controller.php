
  <?php
        include "classes.php";
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
