<?php
/**
 * Created by PhpStorm.
 * User: Milind Gour
 * Date: 9/25/15
 * Time: 4:09 PM
 */


$content = "Some content in the file";

$written = file_put_contents('testfile.txt', $content);

if ($written) {
    echo 'file written successfully';
}
else {
    echo 'file write failed';
}