<?php
include "classes.php";
$allproduit ="";
if (isset($_SESSION['user'])) {
    $allproduit = "SELECT * FROM `bug_report`";
    $produits = $base->query($allproduit);
}

if (isset($_POST['submit'])) {
    $user = new user();
    $type = mysqli_real_escape_string($base,$_POST['type']);

    if($type=='title'){
        $allproduit=$user -> search_bug_report_by_title($base);
    }
    if($type=='developer'){
        $allproduit=$user -> search_bug_report_by_assignee($base);
    }
    if($type=='status'){
        $allproduit=$user -> search_bug_report_by_status($base);
    }
    if($type=='keyword'){
        $allproduit=$user -> search_bug_report_by_keyword($base);
    }
    echo $allproduit;
    $produits = $base->query($allproduit);
}
if(isset($_POST['show']))
{
    $allproduit = "SELECT * FROM `bug_report` where developer_id = ".$_SESSION['user']['user_id'];
    $produits = $base->query($allproduit);
}

?>
<div>
    <form method="post" action="" style="max-width: 50%;">
        <table>
            <tr>
                <td>
                    <input type="text" name="search" placeholder="Search"></input>
            </td>
        <td rowspan="2">
            <input type="submit" id="submit" value="Search">
        </td>
        </tr>
    <tr>
        <td>
            <select id="type" name="type">
                <option value="title">Title</option>
                <option value="developer">Developer</option>
                <option value="status">Status</option>
                <option value="keyword">Keyword</option>
            </select>
        </td>
    </tr>
    </table>
</form>
</div>
<?php if ($_SESSION['user']['user_type'] == "Developer")
{?>
<form method="post" action="">
<input type="submit" name="show" value="show assigned" />
</form>
<?php
}
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
        <b class="plistop">DateTime: </b> <?php echo $produit['ts_created']; ?>DT<br>
        <b class="plistop">Description: </b> <?php echo $produit['description']; ?> <br>
        <b class="plistop">Reporter Id: </b> <?php echo $produit['reporter_id']; ?> <br>
        <b class="plistop">Developer Id: </b> <?php echo $produit['developer_id']; ?> <br>
        <b class="plistop">Status: </b> <?php echo $produit['status']; ?> <br>
        <b class="plistop">Keyword: </b> <?php echo $produit['keyword']; ?> 
    </p> 
</div> 
<?php }?>