<?php
/**
 * Created by PhpStorm.
 * User: Milind Gour
 * Date: 9/19/15
 * Time: 7:56 PM
 */
include 'ascent.php';


function getResponseString() {
    if (!isset($_POST['submit'])) {
        return 'Welcome to upload new schedule';
    }
    if (!isset($_POST['regionId']) || $_POST['regionId'] == 0) {
        return 'You must select a valid region';
    }
    if (!isset($_FILES['file'])) {
        return 'You must select a .csv file';
    }
    $region = $_POST['regionId'];
    $file = $_FILES['file'];
    $originalName = $file['name'];
    $serverFilePath = 'tmp_files/'.$originalName;

    if (file_exists($serverFilePath)) {
        return 'Not updated. A file with this filename has already been uploaded.';
    }

    move_uploaded_file($file['tmp_name'], $serverFilePath);
    $contents = file_get_contents($serverFilePath);
    if (!$contents)
        return 'Error uploading the file';

    $ascent = new ASCENT();
    $status = $ascent->insertIntoScheduleByCSVContents($contents, $region);

    if ($status)
        return 'Successfully updated the schedule';

    return 'Error updating the schedule';
}

function getRegionList() {
    $string = "<option value='0'>select region...</option>";
    $ascent = new ASCENT();

    $result = $ascent->getRegionListArray();
    for ($i = 0; $i < sizeof($result); $i++) {
        $string .= "<option value='".$result[$i]['region_id']."'>".$result[$i]['region_name']."</option>";
    }

    return $string;
}

?>

<!DOCTYPE html>
    <html>
        <head>
            <title> Upload Schedule </title>
            <link rel="stylesheet" href="resources/styles.css" />

        </head>
        <body>
        <div class="tableContainer">
            <form method="post" action="#" enctype="multipart/form-data">
                <table>
                    <tr class="thead tcenter"><td colspan="2">Upload New Schedule</td></tr>
                    <tr><td class="ttitle">Data file (.csv)</td><td class="tvalue"><input class="tctrl" type="file" name="file" accept=".csv" required/></td></tr>
                    <tr><td class="ttitle">Region</td><td class="tvalue"><select class="tctrl" name="regionId" required><?=getRegionList(); ?></select></td></tr>
                    <tr><td class="tcenter" colspan="2"><button class="tsubmit" type="submit" name="submit">Upload Schedule</button> </td></tr>
                    <tr><td colspan="2"><div class="response" id="resp"><?=getResponseString();?></div></td></tr>
                </table>
            </form>
        </div>
        </body>
    </html>