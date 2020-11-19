<?php 
	$title="Roger Bug Tracker - Report a Bug";
	include('include/head.php');
    include('include/content/add_bug_controller.php'); 
                    
    class add_bug_page{
	
	public function report_a_bug($base, $reporter_id, $title, $description, $keyword, $version_no, $priority){
		$add_bug_controller = new add_bug_controller();
		$result = $add_bug_controller->validate_bug_report($base, $reporter_id, $title, $description, $keyword, $version_no, $priority);
		if($result==1){
		die("<p class='alert success'>Success ! bug have been added !</p><br><center><a href='add_bug_page.php'>add another bug</a> - <a href='bug_report_list_page.php'>bug list</a></center>"); 
		}
		else{
			echo "<p class='alert error'><b>Attention !</b> error</p>";
		}
	}

	}
	  if (isset($_SESSION['user'])) {
        if ($_SESSION['user']['user_type'] == "Reporter" ) {
          ///
        }else{
          header('Location:index.php');
        }   
      }else{  
          header('Location:login_page.php');
      } 

	  $add_bug_page = new add_bug_page();
      if (isset($_POST['submit'])) {
				$reporterid = $_SESSION['user']['user_id'];
                $nomproduit = mysqli_real_escape_string($base,$_POST['nomproduit']);
                $descproduit = mysqli_real_escape_string($base,nl2br($_POST['descproduit']));
                $feature = mysqli_real_escape_string($base,nl2br($_POST['keyword']));
                $versiono = mysqli_real_escape_string($base,nl2br($_POST['versiono']));
                $priority = mysqli_real_escape_string($base,nl2br($_POST['priority']));
				
				$add_bug_page->report_a_bug($base,$reporterid,$nomproduit,$descproduit,$feature,$versiono,$priority);
				
				
				/*$bug_report = new bug_report();
				$bug_report->create_bug_report($base);*/
      }
					 
			?>

    		<!--<div class="divleft"></div>-->
    		<div class="content"> 
<form action="add_bug_page.php" method="post">
        <table>
        <tr>
          <td colspan="2">Title : </td>
          <td colspan="2"><input type="text" name="nomproduit" placeholder="Summarize your bug in a few words"></input></td>
        </tr>
        <tr>
          <td>Description : </td>
          <td colspan="3"><textarea  name="descproduit" placeholder="Describe how to recreate the bug"></textarea></td>
        </tr>
        <tr>
          <td colspan="2">Keyword : </td>
          <td><select id="keyword" name="keyword">
            <option value="C++">C++</option>
            <option value="Java">Java</option>
            <option value="Python">Python</option>
            </select></td>
        </tr>
        <tr>
          <td colspan="2">Version Number : </td>
          <td colspan="2"><input type="text" name="versiono" placeholder="v1.0.0a"></input></td>
        </tr>
        <tr>
          <td colspan="2">Priority : </td>
          <td colspan="2"><input type="text" name="priority" placeholder="1, 2, 3, 4, 5"></input></td>
        </tr>
        <tr>
          <td colspan="4"><input type="submit" name="submit" value="Submit Report"></td> 
        </tr>
      </table>
</form>
</div>
    		<div class="divright">
    			<?php include('include/divright/user.php');  ?>
    		</div> 
    		<?php include('include/footer.php'); ?>