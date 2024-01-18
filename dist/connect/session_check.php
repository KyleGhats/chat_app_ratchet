<?php 
session_start();
include("variables.php");
$dirFileName = basename(dirname($_SERVER['PHP_SELF']));
// GET IP ADDRESS
if (in_array($_SERVER['REMOTE_ADDR'], $localhostTrue)){
    $ip = "49.150.164.88";
} else {
    $ip = getenv('REMOTE_ADDR');
}
// CHECK IF LOCALHOST
if (in_array($_SERVER['REMOTE_ADDR'], $localhostTrue)){ 
    // LOCALHOST TRUE
    $localhost_status = true;
    if ($dirFileName == "dist") {
        $localhost_status_index = true;
    } else {
        $localhost_status_index = false;        
    }
} else {
    // NOT LOCALHOST
    $localhost_status = false;
    if ($_SERVER['PHP_SELF'] == "index.php" || $_SERVER['PHP_SELF'] == "/index.php" || $dirFileName == "blinc") {
        $index_status = true;
    } else {
        $index_status = true;
    }
}
// EXECUTE OPTIONS
if ($localhost_status == true && $localhost_status_index == true) {
    $in_concat = true;
} else if ($localhost_status == true && $localhost_status_index == false) {
    $in_concat = false;
} else if ($localhost_status == false && $index_status == true) {
    $in_concat = true;
} else if ($localhost_status == false && $index_status == false) {
    $in_concat = false;
}

?>