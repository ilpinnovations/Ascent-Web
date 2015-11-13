<?php
/**
 * Created by PhpStorm.
 * User: Milind Gour
 * Date: 9/18/15
 * Time: 5:38 PM
 */

require_once 'ascent.php';
$ascent = new ASCENT();
$err_response = $ascent->toJSONString('SERVER', false, 'Invalid request sent');
///////////////////////////////////////////////////////////////////////////////////////////////
// main code //////////////////////////////////////////////////////////////////////////////////

// Step 1: Check for main parameter (action) in the request
if (!CHK('action')) {
    echo $err_response;
    return;
}

// Step 2: Check for the required parameters for different types of the requests and execute them
$isValidRequest = true;
switch (getVar('action')) {
    case 'register':
        $isValidRequest = CHK('empId') && CHK('empName') && CHK('regionId') && CHK('emailId');
        if ($isValidRequest) {
            echo $ascent->insertEmployee(getVar('empId'),getVar('empName'),getVar('regionId'),getVar('emailId'));
        }
        break;
    case 'getRegion':
        $isValidRequest = true;
        if ($isValidRequest) {
            echo $ascent->getRegionList();
        }
        break;
    case 'getSchedule':
        $isValidRequest = CHK('date') && CHK('regionId');
        if ($isValidRequest) {
            echo $ascent->getSchedule(getVar('date'),getVar('regionId'));
        }
        break;
    case 'setFeedback':
        $isValidRequest = CHK('schedId') && CHK('empId') && CHK('rating') && CHK('comments');
        if ($isValidRequest) {
            echo $ascent->storeFeedback(getVar('schedId'),getVar('empId'),getVar('rating'),getVar('comments'));
        }
        break;
    default:
        $isValidRequest = false;
        break;
}

if (!$isValidRequest) {
    echo $err_response;
    return;
}

///////////////////////////////////////////////////////////////////////////////////////////////

function CHK($vname) {
    return isset($_REQUEST[$vname]);
}
function getVar($name) {
    return $_REQUEST[$name];
}