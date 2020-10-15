
  <?php
    $alldev = "SELECT * FROM user where user_type ='Developer'";
    $devs = $base->query($alldev); 
      if (isset($_SESSION['user'])) {
        if ($_SESSION['user']['user_type'] == "Triager" || $_SESSION['user']['user_type'] == "Developer" || $_SESSION['user']['user_type'] == "Reviewer") {
          ///
        }else{
          header('Location:index.php');
        }   
      }else{  
          header('Location:login.php');
      } 

      if (isset($_POST['submit'])) {
        
              
              $devid = mysqli_real_escape_string($base,nl2br($_POST['devid']));
            $stat = mysqli_real_escape_string($base,nl2br($_POST['status']));

              //echo $_POST['descproduit'].'<hr>'.$descproduit;
              //die();
          if ($_SESSION['user']['user_type'] == "Triager"){
              $editpro = "UPDATE bug SET status='".$stat."',developer_id='".$devid."', triager_id ='".$_SESSION['user']['user_id']."' WHERE bug_id=".$dataproduit['bug_id']."";
          }
          else
          {
              $editpro = "UPDATE bug SET status='".$stat."' WHERE bug_id=".$dataproduit['bug_id']."";
          }
              
              $rq = mysqli_query($base,$editpro);
            //echo "<p class='alert error'><b>$editpro</b> error</p>";
            header('Location:list_produit.php');
        
      }
  ?>
  <form method="post" action="">
<article>
	<h1><?php echo $dataproduit['title']; ?></h1>
	<div class="cont">
		<b>Time posted : </b><?php echo $dataproduit['ts_created']; ?><br><br>
		<b>Description :</b><br><p><?php echo $dataproduit['description']; ?></p>
	</div>
	<div class="cont">
        <?php if ($_SESSION['user']['user_type'] == "Triager"){ ?>
		<b>Devloper :</b>
        <select id="devid" name="devid">
            <?php
                while($dev = $devs->fetch_array()) {?>
                   <option value="<?php echo $dev['user_id'];?>"><?php echo $dev['full_name']; ?></option> 
                <?php }
            ?>
        </select>
        <br><br>
        <?php } ?>
        <b>status :</b>
        <select id="status" name="status">
            <option value="open">open</option>
            <option value="fixed">fixed</option> 
            <option value="reviewed">reviewed</option> 
            <option value="closed">closed</option> 
        </select>
	</div> 
	<input type="submit" name="submit" value="Modify">
</article>
</form>