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
				$reporterid = $_SESSION['user']['user_id'];
                $nomproduit = mysqli_real_escape_string($base,$_POST['nomproduit']);
                $descproduit = mysqli_real_escape_string($base,nl2br($_POST['descproduit']));
                $feature = mysqli_real_escape_string($base,nl2br($_POST['keyword']));
                $versiono = mysqli_real_escape_string($base,nl2br($_POST['versiono']));
                $priority = mysqli_real_escape_string($base,nl2br($_POST['priority']));
				$report_bug_page = new report_bug_page();
				$report_bug_page->report_a_bug($base,$reporterid,$nomproduit,$descproduit,$feature,$versiono,$priority);
				
				
				/*$bug_report = new bug_report();
				$bug_report->create_bug_report($base);*/
      }
  ?>
    <form action="addproduit.php" method="post">
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