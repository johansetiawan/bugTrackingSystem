<?php
    include("classes.php");
	$generate_report_page = new generate_report_page();
	$dev = $generate_report_page->generate_best_developer($base);
	$mon=$generate_report_page->generate_no_of_bugs_reported_monthly($base);
	$wee=$generate_report_page->generate_no_of_bugs_reports_resolved_weekly($base);
	$rep=$generate_report_page->generate_best_reporter($base);
	
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