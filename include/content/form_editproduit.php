
  <?php
      if (isset($_SESSION['user'])) {
        if ($_SESSION['user']['ROLE'] == "1") {
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

              $editpro = "UPDATE produit SET nom='".$nomproduit."', description='".$descproduit."' WHERE id=".$dataproduit['id']."";
              $rq = mysqli_query($base,$editpro);
            header('Location:list_produit.php');
         }else{
            echo "<p class='alert error'><b>Attention !</b> error</p>";
        }
      }
  ?>
  <form method="post" action="">
<article>
	<h1><input type="text" name="nomproduit" value="<?php echo $dataproduit['nom']; ?>"></h1>
	
	<div class="cont">
		<b>Description :</b><br>
		<p style="margin-left: -80px;"><textarea  name="descproduit" ><?php echo $dataproduit['description']; ?></textarea></p>
	</div> 
	<input type="submit" name="submit" value="Modify">
</article>
</form>