
  <?php
      if (isset($_SESSION['user'])) {
        ///  
      }else{  
          header('Location:login.php');
      } 

      if (isset($_POST['submit'])) {
        if (!empty($_POST['email']) && !empty($_POST['password1'])) {
              
              
			  $password = mysqli_real_escape_string($base,$_POST['password1']);  
              $email = mysqli_real_escape_string($base,$_POST['email']); 
              $user_id = $_SESSION['user']['user_id'];
			  
			  
			  
              //echo $_POST['descproduit'].'<hr>'.$descproduit; 

              $editpro = "UPDATE user SET email='$email',PASSWORD='$password' WHERE user_id='$user_id'";
              echo "<p class='alert error'><b>Attention !</b> $editpro</p>";
             //die($editpro);
              $rq = mysqli_query($base,$editpro);

              $data = "SELECT * FROM `user` WHERE `user_id` LIKE '".$_SESSION['user']['user_id']."'";
              $datauser = $base->query($data)->fetch_array(MYSQLI_ASSOC);
              $_SESSION['user'] = $datauser;

          		if ($_SESSION['user']['user_type'] == "Reporter") {
                    header('Location: admin.php');
                }else{
                    header('Location: user.php');
                }
         }else{
            echo "<p class='alert error'><b>Attention !</b> put something ah sial</p>";
        }
      }
  ?>

<form  method='post' action="" >
<table >  
  <tr> <td colspan="2"><br>  </td></tr> 
  <tr>
    <td><p> Full_Name* : <p> </td>
    <td><?php echo $_SESSION['user']['full_name'];?></td> 
  </tr>  
  <tr>
    <td><p>email  : <p></td>  
    <td> <input name="email" type="email" value="<?php echo $_SESSION['user']['email'];?>"/> </td> 
  </tr>
  <tr>
    <td><p>Password*  : <p></td>  
    <td>
      <input name="password1" type="text" value="<?php echo $_SESSION['user']['password'];?>"/>
    </td> 
  </tr>  
  <tr>
    <td colspan="2"><input type="submit" name="submit" value="Modifier" /></td>
  </tr>  

</table> 
</form>