<?php
    include("classes.php");
	$generate_report_page = new generate_report_page();
	$dev = $generate_report_page->generate_best_developer($base);
	$mon=$generate_report_page->generate_no_of_bugs_reported_monthly($base);
	$wee=$generate_report_page->generate_no_of_bugs_reports_resolved_weekly($base);
	$rep=$generate_report_page->generate_best_reporter($base);
	
?>

