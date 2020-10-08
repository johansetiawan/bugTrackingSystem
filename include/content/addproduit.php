
  <?php
      if (isset($_SESSION['user'])) {
        if ($_SESSION['user']['ROLE'] == "1" || $_SESSION['user']['ROLE'] == "2" ) {
          ///
        }else{
          header('Location:index.php');
        }   
      }else{  
          header('Location:login.php');
      } 

      if (isset($_POST['submit'])) {
        if (!empty($_POST['nomproduit']) && !empty($_POST['descproduit'])) {
              
              $nomproduit = mysqli_real_escape_string($base,$_POST['nomproduit']);
              $descproduit = mysqli_real_escape_string($base,nl2br($_POST['descproduit'])); 
              $imgproduit = (empty($imgproduit)) ? "urldefult" : $imgproduit ;

              //echo $_POST['descproduit'].'<hr>'.$descproduit;
              //die();

              $addpro = "INSERT INTO `produit` (`nom`, `description`) VALUES ('$nomproduit','$descproduit')";
              $rq = mysqli_query($base,$addpro);
            die("<p class='alert success'>Success ! bug have been added !</p><br><center><a href='addproduit.php'>add another bug</a> - <a href='list_produit.php'>bug list</a></center>"); 
        }else{
            echo "<p class='alert error'><b>Attention !</b> error</p>";
        }
      }
  ?>
    <form action="" method="post">
        <table>
        <tr>
          <td colspan="2">Question : </td>
          <td colspan="2"><input type="text" name="nomproduit" placeholder="summarize your bug in a few words"></input></td>
        </tr>
        <tr>
          <td>Description : </td>
          <td colspan="3"><textarea  name="descproduit" ></textarea></td>
        </tr>
        <tr>
          <td colspan="4"><input type="submit" name="submit" value="post"></td> 
        </tr>
      </table>
</form>