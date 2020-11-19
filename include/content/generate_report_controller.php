<?php
    include('Entity/bug_report.php');
include('Entity/user.php');
    include('Entity/user_developer.php');
    include('Entity/user_reporter.php');



class generate_report_controller{
	public function get_best_developer($base){
		$user_developer = new user_developer($base,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
		return $user_developer->find_best_developer($base);		
	}
	
	public function get_best_reporter($base){
		$user_reporter = new user_reporter($base,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
		return $user_reporter->find_best_reporter($base);		
	}
	
	public function get_no_of_bugs_reported_monthly($base){
		$bug_report = new bug_report($base,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
		return $bug_report->count_no_of_bugs_reported_monthly($base);				
	}
	
	public function get_no_of_bugs_reports_resolved_weekly($base){
		$bug_report = new bug_report($base,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
		return $bug_report->count_no_of_bugs_reports_resolved_weekly($base);				
	}
	
}
?>

