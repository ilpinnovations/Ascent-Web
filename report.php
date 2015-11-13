<?php
/**
 * Created by PhpStorm.
 * User: Milind Gour
 * Date: 9/19/15
 * Time: 7:56 PM
 */
include 'ascent.php';

function functionModeExecution() {

    if (isset($_GET['date']) && isset($_GET['region']) && !isset($_GET['session'])) {

        // date and region are given, but not session, throw json with list of sessions;
        $date = $_GET['date'];
        $region = $_GET['region'];

        $ascent = new ASCENT();
        $sessionList = $ascent->getSessionList($date, $region);
        echo $sessionList;
        exit;
    }

}

functionModeExecution();


function getRegionList() {
    $string = "";
    $ascent = new ASCENT();

    $result = $ascent->getRegionListArray();
    for ($i = 0; $i < sizeof($result); $i++) {
        $string .= "<option value='".$result[$i]['region_id']."'>".$result[$i]['region_id'].". ".$result[$i]['region_name']."</option>";
    }

    return $string;
}


?>

<!DOCTYPE html>
    <html>
        <head>
            <title> Upload Schedule </title>
            <link rel="stylesheet" href="resources/styles.css" />
            <script type="application/javascript" src="resources/jquery-2.1.4.min.js"></script>
            <script type="application/javascript" src="resources/report.js"></script>
        </head>
        <body>
        <div class="tableContainer">
            <form method="get" action="download.php" enctype="application/x-www-form-urlencoded">
                <table>
                    <tr class="thead tcenter"><td colspan="2">Generate Report</td></tr>
                    <tr><td class="ttitle">Date*</td><td class="tvalue"><input class="tctrl" id="idDate" type="date" name="idDate" value="<?php echo date('Y-m-d'); ?>"  /></td></tr>
                    <tr><td class="ttitle">Region</td><td class="tvalue"><select class="tctrl" id="idRegion" name="idRegion"><option value="0">All</option><?=getRegionList(); ?></select></td></tr>
                    <tr><td class="ttitle">Session</td><td class="tvalue"><select class="tctrl" id="idSession" name="idSession"><option value="0">All</option></select></td></tr>
                    <tr><td class="tcenter" colspan="2"><button class="tsubmit" type="submit" name="submit">Download</button> </td></tr>
<!--                    <tr><td colspan="2"><div class="response" id="resp">--><?//=getResponseString();?><!--</div></td></tr>-->
                </table>
            </form>
        </div>
        </body>
    </html>