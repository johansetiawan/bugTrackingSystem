<?php

class bug_report{
	
private $base = NULL;
private $bug_report_id =NULL;
private $reporter_id = NULL;
private $triager_id = NULL;
private $developer_id = NULL;
private $reviewer_id =NULL;
private $title =NULL;
private $description =NULL;
private $keyword =NULL;
private $version_no =NULL;
private $status =NULL;
private $priority =NULL;
private $ts_created =NULL;
private $ts_closed =NULL;
private $ts_modified =NULL;

function __construct($base, $bug_report_id, $reporter_id, $triager_id, $developer_id, $reviewer_id, $title, $description, $keyword, $version_no, $status, $priority, $ts_created, $ts_closed, $ts_modified){
	$this->base=$base;
	$this->bug_report_id=$bug_report_id;
	$this->reporter_id=$reporter_id;
	$this->triager_id=$triager_id;
	$this->developer_id=$developer_id;
	$this->developer_id=$developer_id;
	$this->reviewer_id=$reviewer_id;
	$this->title=$title;
	$this->description=$description;
	$this->keyword=$keyword;
	$this->version_no=$version_no;
	$this->status=$status;
	$this->priority=$priority;
	$this->ts_created=$ts_created;
	$this->ts_closed=$ts_closed;
	$this->ts_modified=$ts_modified;	
}

public function set_bug_report_id($value)
{
	$this->bug_report_id = $value;
}
public function set_reporter_id($value)
{
	$this->reporter_id = $value;
}
public function set_triager_id($value)
{
	$this->triager_id = $value;
}
public function set_developer_id($value)
{
	$this->developer_id = $value;
}
public function set_reviewer_id($value)
{
	$this->reviewer_id = $value;
}
public function set_title($value)
{
	$this->title = $value;
}
public function set_description($value)
{
	$this->description = $value;
}
public function set_keyword($value)
{
	$this->keyword = $value;
}
public function set_version_no($value)
{
	$this->version_no = $value;
}
public function set_status($value)
{
	$this->status = $value;
}
public function set_priority($value)
{
	$this->priority = $value;
}
public function set_ts_created($value)
{
	$this->ts_created = $value;
}
public function set_ts_closed($value)
{
	$this->ts_closed = $value;
}
public function set_ts_modified($value)
{
	$this->ts_modified = $value;
}



public function get_bug_report_id()
{
	return $this->bug_report_id;
}
public function get_reporter_id()
{
	return $this->reporter_id;
}
public function get_triager_id()
{
	return $this->triager_id;
}
public function get_developer_id()
{
	return $this->developer_id;
}
public function get_reviewer_id()
{
	return $this->reviewer_id;
}
public function get_title()
{
	return $this->title;
}
public function get_description()
{
	return $this->description;
}
public function get_keyword()
{
	return $this->keyword;
}
public function get_version_no()
{
	return $this->version_no;
}
public function get_status()
{
	return $this->status;
}
public function get_priority()
{
	return $this->priority;
}
public function get_ts_created()
{
	return $this->ts_created;
}
public function get_ts_closed()
{
	return $this->ts_closed;
}
public function get_ts_modified()
{
	return $this->ts_modified;
}

public function retrieve_all_bug_reports($base){      
		$allproduit = "SELECT * FROM `bug_report`";
		$produits = $base->query($allproduit);
		return $produits;
}	

public function retrieve_bug_report_by_keyword($base,$keyword){      
		$allproduit = "SELECT * FROM `bug_report` where  keyword = '$keyword'";
		$produits = $base->query($allproduit);
		return $produits;
}	

public function retrieve_bug_report_by_status($base,$status){      
		$allproduit = "SELECT * FROM `bug_report` where  status = '$status'";
		$produits = $base->query($allproduit);
		return $produits;
}

public function retrieve_bug_report_by_title($base,$title){      
		$allproduit = "SELECT * FROM `bug_report` where  title = '$title'";
		$produits = $base->query($allproduit);
		return $produits;
}			

public function retrieve_bug_report_by_assignee($base,$assignee){      
		$allproduit = "SELECT * FROM `user` as a inner join `bug_report` as b on b.developer_id = a.user_id where a.full_name = '$assignee'";
		$produits = $base->query($allproduit);
		return $produits;
}	

public function retrieve_all_bug_report_assigned_to_me($base,$developer_id){      
		$allproduit = "SELECT * FROM `bug_report` where developer_id = ".$developer_id;
		$produits = $base->query($allproduit);
		return $produits;
}


public function bug_report_details($base,$bug_report_id){
	$data = "SELECT * FROM `bug_report` WHERE `bug_id` LIKE '".$bug_report_id."'";
	return $dataproduit = $base->query($data)->fetch_array(MYSQLI_ASSOC);
}


public function count_no_of_bugs_reported_monthly($base){      
		$monthly = "SELECT count(*) as count FROM `bug_report` WHERE MONTH(ts_created) = 10";
		return $base->query($monthly)->fetch_array();
}

public function count_no_of_bugs_reports_resolved_weekly($base){      
		$weekly= "SELECT count(*) as count FROM `bug_report` WHERE WEEKOFYEAR(ts_closed)=WEEKOFYEAR(CURDATE())";
		return $base->query($weekly)->fetch_array();
}

public function create_new_bug_report($base, $reporter_id, $title, $description, $keyword, $version_no, $priority){
	 if (!empty($title) && !empty($description)&& !empty($keyword)&& !empty($version_no)&& !empty($priority)) {			  
			  $addpro = "INSERT INTO `bug_report` (`reporter_id`, `title`,`description`,`keyword`,`version_no`,`priority`) VALUES ('$reporter_id','$title','$description','$keyword','$version_no','$priority')";
			  $rq = mysqli_query($base,$addpro);
			  return 1;			  
        }else{
			return 0;           
        }		
}

public function modify_bug_report_status_triager($base,$status,$triager_id,$bug_report_id,$ts){
	if($status=='closed')
	$editpro = "UPDATE bug_report SET status='".$status."',triager_id ='".$triager_id."',ts_closed='".$ts."' WHERE bug_id=".$bug_report_id."";
	else if($status=='invalid'||$status=='duplicate')
	$editpro = "UPDATE bug_report SET status='".$status."',triager_id ='".$triager_id."',ts_modified='".$ts."',ts_closed='".$ts."' WHERE bug_id=".$bug_report_id."";
	else
	$editpro = "UPDATE bug_report SET status='".$status."',triager_id ='".$triager_id."',ts_modified='".$ts."' WHERE bug_id=".$bug_report_id."";
    if($status == "closed")
    {
        $addpoint = "UPDATE user_triager set bugs_closed = bugs_closed+1 WHERE triager_id =".$triager_id."";
        $upd = mysqli_query($base,$addpoint);
    }
	$rq = mysqli_query($base,$editpro);
}

public function modify_bug_report_status_developer($base,$status,$developer_id,$bug_report_id,$ts_modified){
	$editpro = "UPDATE bug_report SET status='fixed',ts_modified='".$ts_modified."' WHERE bug_id=".$bug_report_id."";
    $addpoint = "UPDATE user_developer set bugs_fixed = bugs_fixed+1 WHERE developer_id =".$developer_id."";
    $upd = mysqli_query($base,$addpoint);
	$rq = mysqli_query($base,$editpro);	
}

public function modify_bug_report_status_reviewer($base,$status,$reviewer_id,$bug_report_id,$ts_modified){
	$editpro = "UPDATE bug_report SET status='reviewed',ts_modified='".$ts_modified."' WHERE bug_id=".$bug_report_id."";
    $addpoint = "UPDATE user_reviewer set bugs_resolved = bugs_resolved+1 WHERE reviewer_id =".$reviewer_id."";
    $upd = mysqli_query($base,$addpoint);
	$rq = mysqli_query($base,$editpro);
}

public function modify_bug_report_assignee($base,$developer_id,$bug_report_id){
	$editpro = "UPDATE bug_report SET developer_id='".$developer_id."' WHERE bug_id=".$bug_report_id."";
	$rq = mysqli_query($base,$editpro);
}

}

?>