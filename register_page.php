      <?php 
          $title="Roger Bug Tracker - Sign Up";
          include('include/head.php'); 
      ?> 

        <!--<div class="divleft"></div>-->
        <div class="content"> <?php include('include/content/register_controller.php'); ?> 
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