
  <?php
        include "classes.php";
		$login_UI = new login_UI($base);
		if (isset($_SESSION['user'])) {
        header('Location: index.php');
      }

      if (isset($_POST['submit'])) {
          
			$email = $_POST['login'];
			$password = $_POST['password'];            
			$login_UI->login($email,$password);
      }
  ?>
    <form action="login.php" method="post" style="max-width: 100%;">
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