
  <?php
      include("classes.php");
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

