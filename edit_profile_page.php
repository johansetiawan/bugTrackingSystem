      <?php 
          $title="edit profile";
          include('include/head.php'); 
            include('include/content/edit_profile_controller.php');
	  if (isset($_SESSION['user'])) {
        ///  
      }else{  
          header('Location:login_page.php');
      } 
	  $edit_profile_page = new edit_profile_page();
      if (isset($_POST['submit'])) {
        
			  $password = mysqli_real_escape_string($base,$_POST['password1']);  
              $email = mysqli_real_escape_string($base,$_POST['email']); 
              $user_id = $_SESSION['user']['user_id'];
			  
			  $edit_profile_page->edit_profile($base,$user_id,$email,$password);
	}
      ?>

        <!--div class="divleft"></div-->
        <div class="content"> 
<form  method='post' action="" >
<table >  
  <tr> <td colspan="2"><br>  </td></tr> 
  <tr>
    <td><p> Full Name* : <p> </td>
    <td><?php echo $_SESSION['user']['full_name'];?></td> 
  </tr>  
  <tr>
    <td><p>Email  : <p></td>  
    <td> <input name="email" type="email" value="<?php echo $_SESSION['user']['email'];?>"/> </td> 
  </tr>
  <tr>
    <td><p>Password*  : <p></td>  
    <td>
      <input name="password1" type="text" value="<?php echo $_SESSION['user']['password'];?>"/>
    </td> 
  </tr>  
  <tr>
    <td colspan="2"><input type="submit" name="submit" value="Update" /></td>
  </tr>  

</table> 
</form>
</div>
        <div class="divright">
          <?php include('include/divright/user.php');  ?>
        </div> 
        <?php include('include/footer.php'); ?>