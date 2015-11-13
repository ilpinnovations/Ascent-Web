<?php
/**
 * Created by PhpStorm.
 * User: Milind Gour
 * Date: 9/23/15
 * Time: 3:01 PM
 */

require_once 'ascent.php';

$ascent = new ASCENT();
//echo $ascent->insertEmployee(962118, 'MkG', 1, 'g_g@tcs.com');
//echo $ascent->getSessionList('2015-09-9', 1);
//echo $ascent->storeFeedback(258,962118,4,'');
//$query = "SELECT sched_date, region_name, sched_activity, emp_id, emp_name, feed_rating, feed_comment FROM ascent_db.report_view WHERE sched_date = '2015-09-09' AND sched_region = 1";
//echo $ascent->queryToFile($query);
$fileContents = file_get_contents('./tmp_files/Ascent28sep -.csv', 2);
echo $ascent->insertIntoScheduleByCSVContents($fileContents, 2);