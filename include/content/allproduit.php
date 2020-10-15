<?php
	
    $allproduit = "SELECT * FROM `bug`";
    $produits = $base->query($allproduit); 
?>

<?php  while($produit = $produits->fetch_array()) {?>   
		<div class="plist">
			<?php  if (isset($_SESSION['user'])) {
					if ($_SESSION['user']['user_type'] == "1") { ?> 
			<div class="paneloption">
				<a href="delete_produit.php?num=<?php echo $produit['id'];?>" class="delete"><i class="ion ion-trash-a"></i></a>
				<a href="editproduit.php?num=<?php echo $produit['id'];?>" class="edit"><i class="ion ion-edit"></i></a>
			</div>
			<?php } } ?>
			<a href="produit.php?num=<?php echo $produit['bug_id'];?>"><h3><?php echo $produit['title']; ?></h3></a>
			<p>
				<b class="plistop">DateTime : </b><?php echo $produit['ts_created']; ?>DT<br>
				<b class="plistop">Description : </b> <?php echo $produit['description']; ?> <br>
                <b class="plistop">Reporter Id : </b> <?php echo $produit['reporter_id']; ?> 
			</p> 
		</div> 
<?php }?>