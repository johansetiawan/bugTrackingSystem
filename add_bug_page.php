			<?php 
					$title="Roger Bug Tracker - Report a Bug";
					include('include/head.php');
                    include('include/content/add_bug_controller.php'); 
					 
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
            <option value="title">C++</option>
            <option value="developer">Java</option>
            <option value="status">Python</option>
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