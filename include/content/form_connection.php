
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