
  <?php
    include("classes.php");

class bug_report_detail_controller{
	
	public function get_bug_report_details($base,$bug_report_id){
			$bug_report = new bug_report($base,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
			return $bug_report->bug_report_details($base,$bug_report_id);			
	}
		
	public function set_bug_report_status_triager($base,$status,$triager_id,$bug_report_id,$ts){
		$bug_report = new bug_report($base,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
		$bug_report->modify_bug_report_status_triager($base,$status,$triager_id,$bug_report_id,$ts);
		header("bug_report_list_page.php");
	}
	
	public function set_bug_report_status_developer($base,$status,$developer_id,$bug_report_id,$ts_modified){
		$bug_report = new bug_report($base,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
		$bug_report->modify_bug_report_status_developer($base,$status,$developer_id,$bug_report_id,$ts_modified);		
		header("bug_report_list_page.php");
	}
		
	public function set_bug_report_status_reviewer($base,$status,$reviewer_id,$bug_report_id,$ts_modified){
		$bug_report = new bug_report($base,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
		$bug_report->modify_bug_report_status_reviewer($base,$status,$reviewer_id,$bug_report_id,$ts_modified);
		header("bug_report_list_page.php");
	}
	
	public function set_bug_report_assignee($base,$developer_id,$bug_report_id){
		$bug_report = new bug_report($base,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
		$bug_report->modify_bug_report_assignee($base,$developer_id,$bug_report_id);	
		header("bug_report_list_page.php");
	}
		
}

  ?>
  
  