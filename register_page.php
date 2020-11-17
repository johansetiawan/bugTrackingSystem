      <?php 
          $title="Roger Bug Tracker - Sign Up";
          include('include/head.php'); 
include('include/content/register_controller.php');


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
		$register_page = new register_page();
		$register_page->register_user($base,$email,$password,$fullname,$usertype,$repassword);	
        }else{
          echo "<p class='alert error'><b>Attention !</b> fill up all required field</p>";
        }
      }

      ?> 

        <!--<div class="divleft"></div>-->
        <div class="content">
<form  method='post' action="" style="padding-left: 30%;padding-right: 30%;">
<table> 
  <tr>
    <td colspan="10"><h3>Sign Up</h3> </td> 
  </tr>
  <tr></tr> 
  <tr>
    <td colspan="1"><p>Full Name :* <p> </td>
    <td colspan="9"><input name="firstname" type="text"/></td> 
  </tr>
  <tr>
    <td><p>User Type : <p></td>
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
    <td><p> E-mail* : <p></td> 
    <td><input name="email" type="email" /></td> 
  </tr>
  <tr>
    <td><p>Password* : <p></td>  
    <td>
      <input name="password1" type="password" />
    </td> 
  </tr>
  <tr>
    <td><p>Confirm Password* : <p></td>
    <td>
      <input name="password2"  type="password"  />
    </td> 
  </tr>
  <tr>
  <td style="text-align:center;">* required</td>
  </tr>
  <tr>
    <td colspan="2" style="text-align: right;"><input type="submit" name="submit" value="Register!" /></td>
  </tr>
</table> 
</form>
</div>
        <div class="divright">
          <?php include('include/divright/user.php');  ?>
        </div> 
        <?php include('include/footer.php'); ?>