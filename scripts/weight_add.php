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

if (isset($_POST["weight"])) {
    $current_weight = $_REQUEST["weight"];
    $sql = ("INSERT INTO weight (`weight`,`id`) VALUES ('$current_weight','$id')");
    $actual_weight = mysqli_query($link, $sql);
}