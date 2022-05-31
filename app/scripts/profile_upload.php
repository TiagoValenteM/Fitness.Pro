<?php
// load session.php that validates if the user is logged in
// if the user is not logged in, redirects to login page
require_once '../session.php';
// connects to the database 'fitnesspro'
include("../config.php");

// getting data from the user that is logged in
$user = mysqli_real_escape_string($link, $_SESSION['user']);
$result = mysqli_query($link,"SELECT * FROM users WHERE email='$user'");
$data = mysqli_fetch_assoc($result);
$id = $data['id'];

// profile photo upload to the databases
if (isset($_FILES["upload"])) {
    $stmt = $link->prepare("INSERT INTO `profile_img` (`img_name`, `img_data`,`id`) VALUES (?,?, '$id')");
    $stmt->execute([$_FILES["upload"]["name"], file_get_contents($_FILES["upload"]["tmp_name"])]);
}