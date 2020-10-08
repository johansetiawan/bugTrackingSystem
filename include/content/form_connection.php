
  <?php

      if (isset($_SESSION['user'])) {
        header('Location: index.php');
      }

      if (isset($_POST['submit'])) {

            $loguser = mysqli_real_escape_string($base,$_POST['login']);
            $passuser = mysqli_real_escape_string($base,$_POST['password']);

        if (!empty($loguser) && !empty($passuser)) {
              

              $reqnumlogin = "SELECT count(ID) FROM abonne WHERE LOGIN LIKE '".$_POST['login']."'";
              $result = $base->query($reqnumlogin);  
              $numLOGIN = $result->fetch_row(); 
  
              if ($numLOGIN['0'] == 1) {

                  $findpass = "SELECT `PASSWORD` FROM `abonne` WHERE `LOGIN` LIKE '".$_POST['login']."'";
                  $realpass = $base->query($findpass)->fetch_object()->PASSWORD;  
                  $userpass = md5($_POST['password']);
                  if ($userpass == $realpass) {

                        $data = "SELECT * FROM `abonne` WHERE `LOGIN` LIKE '".$_POST['login']."'";
                        $datauser = $base->query($data)->fetch_array(MYSQLI_ASSOC);
                        $_SESSION['user'] = $datauser;
                        if ($_SESSION['user']['ROLE'] == "1") {
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