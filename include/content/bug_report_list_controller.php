<?php
include "classes.php";
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
