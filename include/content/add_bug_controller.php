<?php
	  include "classes.php";



class report_bug_controller{
	
	public function validate_bug_report($base, $reporter_id, $title, $description, $keyword, $version_no, $priority){
		$bug_report=new bug_report($base, NULL, $reporter_id, NULL, NULL, NULL, $title, $description, $keyword, $version_no, NULL, $priority, NULL, NULL, NULL);
		$result = $bug_report->create_new_bug_report($base, $reporter_id, $title, $description, $keyword, $version_no, $priority);
		$report_bug_page = new report_bug_page();
		if($result==1){
			$report_bug_page->display_success();
		}
		else{
			$report_bug_page->display_error();
		}
	}
	
}	
  ?>
    