<?php
// load session.php that validates if the user is logged in
// if the user is not logged in, redirects to login page
require_once '../session.php';
// connects to the database 'fitnesspro'
include("../config.php");
$data = getLoggedUserData($link);
$id = $data['id'];

function WeightUpdate($link, $id, $current_weight){
    $sql = ("INSERT INTO weight (`weight`,`id`) VALUES ('$current_weight','$id')");
    $actual_weight = mysqli_query($link, $sql);
}

if (isset($_POST["weight"])) {
    $current_weight = $_REQUEST["weight"];
    WeightUpdate($link, $id, $current_weight);
}