<?php
include "classes.php";





class bug_report_list_controller{
	
	public function get_bug_reports($base){		
		$bug_report = new bug_report($base,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
		return $bug_report->retrieve_all_bug_reports($base);
	}
	
	
	public function get_bug_report_by_keyword($base,$keyword){		
		$bug_report = new bug_report($base,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
		return $bug_report->retrieve_bug_report_by_keyword($base,$keyword);
	}
	
	public function get_bug_report_by_status($base,$status){		
		$bug_report = new bug_report($base,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
		return $bug_report->retrieve_bug_report_by_status($base,$status);
	}
	
	public function get_bug_report_by_title($base,$title){		
		$bug_report = new bug_report($base,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
		return $bug_report->retrieve_bug_report_by_title($base,$title);
	}
	
	public function get_bug_report_by_assignee($base,$assignee){		
		$bug_report = new bug_report($base,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
		return $bug_report->retrieve_bug_report_by_assignee($base,$assignee);
	}
	
	public function find_bug_reports_assigned_to_me($base,$developer_id){
		$bug_report = new bug_report($base,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
		return $bug_report->retrieve_all_bug_report_assigned_to_me($base,$developer_id); 		
	}
	

}

?>
