<?php
	  include "classes.php";
      if (isset($_SESSION['user'])) {
        if ($_SESSION['user']['user_type'] == "Reporter" ) {
          ///
        }else{
          header('Location:index.php');
        }   
      }else{  
          header('Location:login_page.php');
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
    