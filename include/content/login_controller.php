
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