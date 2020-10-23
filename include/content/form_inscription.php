<?php
  include "classes.php";
  if (isset($_SESSION['user'])) {
        header('Location: index.php');
      }
  if (isset($_POST['submit'])) { 
        $fullname =mysqli_real_escape_string($base,$_POST["firstname"]);
        $email =mysqli_real_escape_string($base,$_POST["email"]);
        $password =mysqli_real_escape_string($base,$_POST['password1']);
        $repassword =mysqli_real_escape_string($base,$_POST['password2']);
        $usertype =mysqli_real_escape_string($base,$_POST['usertype']);


        if (!empty($fullname) && !empty($email) && !empty($email) && !empty($password) && !empty($repassword)) {

              $reqnumemail = "SELECT count(user_id) FROM user WHERE EMAIL LIKE '".$email."'";
              $result = $base->query($reqnumemail);  
              $numemail = $result->fetch_row(); 
  
              if ($numemail['0'] == 0) {

                   if ($password == $repassword) {
                       
                        $req = "INSERT INTO `user` (`full_name`, `EMAIL`, `password`,`user_type`) VALUES ('$fullname','$email', '$password','$usertype')";
                        $rq = mysqli_query($base,$req);
                        die("<p class='alert success'>Account created</p><br><center><a href='login.php'>Login</a> - <a href='index.php'>Home</a></center>");

                  }else{
                      echo "<p class='alert error'><b>Attention !</b> password not the same </p>";
                  }

              }else{
                  echo "<p class='alert error'><b>Attention !</b> email already exist</p>";
              }
        }else{
          echo "<p class='alert error'><b>Attention !</b> fill up all required field</p>";
        }
      }

?>

<form  method='post' action="" >
<table > 
  <tr>
    <td colspan="2"><h3>Sign Up</h3> </td> 
  </tr>
  <tr> <td colspan="2"><br>  </td></tr> 
  <tr>
    <td><p>Full Name :* <p> </td>
    <td><input name="firstname" type="text"  /></td> 
  </tr>
  <tr>
    <td><p>user type  : <p></td>
    <td>
      <select name="usertype">
        <option value="Reporter">Reporter</option>
        <option value="Triager">Triager</option>
        <option value="Developer">Developer</option>
        <option value="Reviewer">Reviewer</option>
      </select> 
    </td>
  </tr>
  
 
  <tr> 
    <td><p> E-mail*  : <p></td> 
    <td><input name="email" type="email" /></td> 
  </tr>
  <tr>
    <td><p>Password*  : <p></td>  
    <td>
      <input name="password1" type="password" />
    </td> 
  </tr>
  <tr>
    <td><p>Re-Password* : <p></td>
    <td>
      <input name="password2"  type="password"  />
    </td> 
  </tr>  
  <tr>
    <td colspan="2"><input type="submit" name="submit" value="Submit Query" /></td>
  </tr>  
  <tr>
    <td colspan="2"><span> * required</span></td>
  </tr>

</table> 
</form>