<?php
/**
 * Created by PhpStorm.
 * User: Milind Gour
 * Date: 9/24/15
 * Time: 9:50 AM
 */


$isDate     = isset($_REQUEST['idDate']);
$isRegion   = isset($_REQUEST['idRegion']);
$isSession  = isset($_REQUEST['idSession']);


if (!$isDate) {
    die('Invalid request');
}
$date = $_REQUEST['idDate'];
//$sqlQuery = "SELECT sched_date, region_name, sched_activity, emp_id, emp_name, feed_rating, feed_comment FROM ascent_db.report_view WHERE sched_date = '$date'";
$sqlQuery = "SELECT * FROM ascent_db.report_view WHERE sched_date = '$date'";

$fileName = "AscentReport_$date";

if ($isRegion) {
    $region = $_REQUEST['idRegion'];

    if ($region > 0) {
        $fileName .= '_'.$region;
        $sqlQuery .= " AND sched_region = $region";
    }
    else
        $fileName .= '_All';
}

if ($isSession) {
    $session = $_REQUEST['idSession'];
    if ($session > 0) {
        $fileName .= '_'.$session;
        $sqlQuery .= " AND sched_id = $session";
    }
    else
        $fileName .= '_All';
}

require_once 'ascent.php';

$ascent = new ASCENT();

$fileName .= '.csv';

$data = $ascent->queryToFile($sqlQuery, $fileName);

if ($data) {

    header('Content-Type: application/octet-stream');
    header("Content-Transfer-Encoding: Binary");
    header("Content-disposition: attachment; filename=\"" . basename($fileName) . "\"");
    echo $data;
}
else
{
    die("Cannot create file. Error!");
}