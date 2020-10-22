
  <?php
        include "classes.php";
      if (isset($_SESSION['user'])) {
        header('Location: index.php');
      }

      if (isset($_POST['submit'])) {
          
            $user = new user();
			$user->login($base);
      }
  ?>
    <form action="login.php" method="post">
        <table>
        <tr>
          <td>Login : </td>
          <td><input type="text" name="login" placeholder="enter id"></input></td>
        </tr>
        <tr>
          <td>password : </td>
          <td><input type="password" name="password" placeholder="enter password"></input></td>
        </tr>
        <tr>
          <td colspan="2"><input type="submit" name="submit" value="login"></td> 
        </tr>
      </table>
</form>