<?php
    include("classes.php");
	$generate_report_page = new generate_report_page();
	$dev = $generate_report_page->generate_best_developer($base);
	$mon=$generate_report_page->generate_no_of_bugs_reported_monthly($base);
	$wee=$generate_report_page->generate_no_of_bugs_reports_resolved_weekly($base);
	
	//$bestdev = "SELECT * FROM user inner join user_developer on user.user_id=developer_id order by bugs_fixed DESC LIMIT 1";
    $bestrev = "SELECT * FROM user inner join user_reviewer on user.user_id=reviewer_id order by bugs_resolved DESC LIMIT 1";
    $bestrep = "SELECT * FROM user inner join user_reporter on user.user_id=reporter_id order by bugs_reported DESC LIMIT 1";
    //$monthly = "SELECT count(*) as count FROM `bug_report` WHERE MONTH(ts_created) = 10";
    //$weekly= "SELECT count(*) as count FROM `bug_report` WHERE WEEKOFYEAR(ts_closed)=WEEKOFYEAR(CURDATE())";

    //$dev = $base->query($bestdev)->fetch_array();
    $rep = $base->query($bestrep)->fetch_array();
    //$mon = $base->query($monthly)->fetch_array();
    //$wee = $base->query($weekly)->fetch_array();
?>

<div style="width: 50%;">
    <table>
        <tr>
            <th>
                Best Developer :
            </th>
            <th>
                <?php echo $dev['full_name'];?>
            </th>
        </tr>
        <tr>
            <th>
                Best Reporter :
            </th>
            <th>
                <?php echo $rep['full_name'];?>
            </th>
        </tr>
        <tr>
            <th>
                Bug reported last month :
            </th>
            <th>
                <?php echo $mon['count'];?>
            </th>
        </tr>
        <tr>
            <th>
                Bug reported resolved in a week :
            </th>
            <th>
                <?php echo $wee['count'];?>
            </th>
        </tr>
    </table>
</div>