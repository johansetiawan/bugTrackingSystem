      <?php 
          $title="edit profile";
          include('include/head.php'); 
      ?>

        <!--div class="divleft"></div-->
        <div class="content"> <?php include('include/content/edit_profile_controller.php'); ?> 
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