<?php
// load session.php that validates if the user is logged in
// if the user is not logged in, redirects to login page
require_once '../session.php';
// connects to the database 'fitnesspro'
include("../config.php");
$data = getLoggedUserData($link);
$id = $data['id'];

// photo upload to the database
if (isset($_FILES["upload"])) {
    $stmt = $link->prepare("INSERT INTO `profile_img` (`img_name`, `img_data`,`id`) VALUES (?,?, '$id')");
    $stmt->execute([$_FILES["upload"]["name"], file_get_contents($_FILES["upload"]["tmp_name"])]);
}