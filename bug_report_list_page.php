			<?php 
					$title="Roger Bug Tracker - Bug List";
					include('include/head.php'); 
include('include/content/bug_report_list_controller.php');
$allproduit ="";

if (isset($_SESSION['user'])) {
    $bug_report_list_page=new bug_report_list_page();
	$produits=$bug_report_list_page->display_bug_reports($base);
}

if (isset($_POST['submit'])) {
    //$user = new user();
    $type = mysqli_real_escape_string($base,$_POST['type']);
	$search = mysqli_real_escape_string($base,$_POST['search']);

    if($type=='title'){
        $bug_report_list_page=new bug_report_list_page();
		$produits=$bug_report_list_page->search_bug_report_by_title($base,$search);
    }
	
    if($type=='developer'){
        $bug_report_list_page=new bug_report_list_page();
		$produits=$bug_report_list_page->search_bug_report_by_assignee($base,$search);
    }
	
    if($type=='status'){
        $bug_report_list_page=new bug_report_list_page();
		$produits=$bug_report_list_page->search_bug_report_by_status($base,$search);
    }
    if($type=='keyword'){
        $bug_report_list_page=new bug_report_list_page();
		$produits=$bug_report_list_page->search_bug_report_by_keyword($base,$search);
    }
    //echo $allproduit;
    //$produits = $base->query($allproduit);
}
if(isset($_POST['show']))
{
    $developer_id=$_SESSION['user']['user_id'];
	$bug_report_list_page=new bug_report_list_page();
	$produits=$bug_report_list_page->find_bug_reports_assigned_to_me($base,$developer_id);
	/*$allproduit = "SELECT * FROM `bug_report` where developer_id = ".$developer_id;
    $produits = $base->query($allproduit);*/
}
					 
			?>

    		<!--<div class="divleft"></div>-->
    		<div class="content">  
<div>
    <form method="post" action="bug_report_list_page.php" style="max-width: 50%;">
        <table>
            <tr>
                <td>
                    <input type="text" name="search" placeholder="Search"></input>
            </td>
        <td rowspan="2">
            <input type="submit" id="submit" value="Search" name ="submit">
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
<form method="post" action="bug_report_list_page.php">
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
        <a href="bug_report_detail_page.php?num=<?php echo $produit['bug_id'];?>" class="edit"><i class="ion ion-edit"></i></a>
    </div>
    <?php } } ?>
    <a href="bug_report_detail_page1.php?num=<?php echo $produit['bug_id'];?>"><h3><?php echo $produit['title']; ?></h3></a>
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
</div>
    		<div class="divright">
    			<?php include('include/divright/user.php');  ?>
    		</div> 
    		<?php include('include/footer.php'); ?>