
  <?php
	  include "classes.php";
      if (isset($_SESSION['user'])) {
        if ($_SESSION['user']['user_type'] == "Reporter" ) {
          ///
        }else{
          header('Location:index.php');
        }   
      }else{  
          header('Location:login.php');
      } 

      if (isset($_POST['submit'])) {
        if (!empty($_POST['nomproduit']) && !empty($_POST['descproduit'])&& !empty($_POST['feature'])&& !empty($_POST['versiono'])&& !empty($_POST['priority'])) {
              
              $reporterid = $_SESSION['user']['user_id'];
              $nomproduit = mysqli_real_escape_string($base,$_POST['nomproduit']);
              $descproduit = mysqli_real_escape_string($base,nl2br($_POST['descproduit']));
              $feature = mysqli_real_escape_string($base,nl2br($_POST['keyword']));
              $versiono = mysqli_real_escape_string($base,nl2br($_POST['versiono']));
              $priority = mysqli_real_escape_string($base,nl2br($_POST['priority']));


              $addpro = "INSERT INTO `bug_report` (`reporter_id`, `title`,`description`,`keyword`,`version_no`,`priority`) VALUES ('$reporterid','$nomproduit','$descproduit','$feature','$versiono','$priority')";
              $rq = mysqli_query($base,$addpro);
            die("<p class='alert success'>.$addpro Success ! bug have been added !</p><br><center><a href='addproduit.php'>add another bug</a> - <a href='list_produit.php'>bug list</a></center>"); 
        }else{
            echo "<p class='alert error'><b>Attention !</b> error</p>";
        }
      }
  ?>
    <form action="" method="post">
        <table>
        <tr>
          <td colspan="2">Title : </td>
          <td colspan="2"><input type="text" name="nomproduit" placeholder="summarize your bug in a few words"></input></td>
        </tr>
        <tr>
          <td>Description : </td>
          <td colspan="3"><textarea  name="descproduit" ></textarea></td>
        </tr>
        <tr>
          <td colspan="2">keyword : </td>
          <td><select id="keyword" name="keyword">
            <option value="title">C++</option>
            <option value="developer">Java</option>
            <option value="status">Python</option>
            </select></td>
        </tr>
        <tr>
          <td colspan="2">version_no : </td>
          <td colspan="2"><input type="text" name="versiono" placeholder="version number"></input></td>
        </tr>
        <tr>
          <td colspan="2">priority : </td>
          <td colspan="2"><input type="text" name="priority" placeholder="priority"></input></td>
        </tr>
        <tr>
          <td colspan="4"><input type="submit" name="submit" value="post"></td> 
        </tr>
      </table>
</form>