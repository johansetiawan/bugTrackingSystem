<?php
	if (isset($_SESSION['user'])) {
        if ($_SESSION['user']['user_type'] == "Developer") {
          
            $allproduit = "SELECT * FROM `bug` where developer_id = ".$_SESSION['user']['user_id'];
        }
        else if ($_SESSION['user']['user_type'] == "Reviewer"){
            $allproduit = "SELECT * FROM `bug` where status='fixed'";
        }
        else{
            $allproduit = "SELECT * FROM `bug`";
        }   
      }
    $produits = $base->query($allproduit); 
?>

<?php  while($produit = $produits->fetch_array()) {?>   
		<div class="plist">
			<?php  if (isset($_SESSION['user'])) {
					if ($_SESSION['user']['user_type'] == "Triager" || $_SESSION['user']['user_type'] == "Developer" || $_SESSION['user']['user_type'] == "Reviewer") { ?> 
			<div class="paneloption">
				<a href="delete_produit.php?num=<?php echo $produit['bug_id'];?>" class="delete"><i class="ion ion-trash-a"></i></a>
				<a href="editproduit.php?num=<?php echo $produit['bug_id'];?>" class="edit"><i class="ion ion-edit"></i></a>
			</div>
			<?php } } ?>
			<a href="produit.php?num=<?php echo $produit['bug_id'];?>"><h3><?php echo $produit['title']; ?></h3></a>
			<p>
				<b class="plistop">DateTime : </b><?php echo $produit['ts_created']; ?>DT<br>
				<b class="plistop">Description : </b> <?php echo $produit['description']; ?> <br>
                <b class="plistop">Reporter Id : </b> <?php echo $produit['reporter_id']; ?> <br>
                <b class="plistop">developer Id : </b> <?php echo $produit['developer_id']; ?> <br>
                <b class="plistop">Status : </b> <?php echo $produit['status']; ?> 
			</p> 
		</div> 
<?php }?>