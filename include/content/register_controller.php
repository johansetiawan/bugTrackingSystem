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
		$register_page = new register_page();
		$register_page->register_user($base,$email,$password,$fullname,$usertype,$repassword);	
        }else{
          echo "<p class='alert error'><b>Attention !</b> fill up all required field</p>";
        }
      }

?>
