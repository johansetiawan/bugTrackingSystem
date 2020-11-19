<?php
	  include "classes.php";



class add_bug_controller{
	
	public function validate_bug_report($base, $reporter_id, $title, $description, $keyword, $version_no, $priority){
		$bug_report=new bug_report($base, NULL, $reporter_id, NULL, NULL, NULL, $title, $description, $keyword, $version_no, NULL, $priority, NULL, NULL, NULL);
		return $result = $bug_report->create_new_bug_report($base, $reporter_id, $title, $description, $keyword, $version_no, $priority);
		$add_bug_page = new add_bug_page();
	}
	
}	
  ?>
    