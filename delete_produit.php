<?php 
include('config.php');
include('include/content/classes.php');  




if (isset($_GET['num'])) {
	$bug_report_id = $_GET['num'];
	$bug_report_list_page = new bug_report_list_page();
	$bug_report_list_page->delete_bug_report($base,$bug_report_id);	
}else{
    header('Location: bug_report_list_page.php');
} 

?> 