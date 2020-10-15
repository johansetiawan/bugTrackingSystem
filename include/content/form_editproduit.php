
  <?php
    $alldev = "SELECT * FROM user where user_type ='Developer'";
    $devs = $base->query($alldev); 
      if (isset($_SESSION['user'])) {
        if ($_SESSION['user']['user_type'] == "Triager") {
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

              //echo $_POST['descproduit'].'<hr>'.$descproduit;
              //die();

              $editpro = "UPDATE produit SET title='".$nomproduit."', description='".$descproduit."' WHERE id=".$dataproduit['id']."";
              $rq = mysqli_query($base,$editpro);
            header('Location:list_produit.php');
         }else{
            echo "<p class='alert error'><b>Attention !</b> error</p>";
        }
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
		<b>Devloper :</b><br>
        <select id="descproduit" name="descproduit">
            <?php
                while($dev = $devs->fetch_array()) {?>
                   <option value="<?php echo $dev['user_id'];?>"><?php echo $dev['full_name']; ?></option> 
                <?php }
            ?>
        </select>
	</div> 
	<input type="submit" name="submit" value="Modify">
</article>
</form>