<?php
// load session.php that validates if the user is logged in
// if the user is not logged in, redirects to login page
require_once '../session.php';
// connects to the database 'fitnesspro'
include("../config.php");
$data = getLoggedUserData($link);
$id = $data['id'];

function IdealWeight($height, $gender){
    if($gender == "m") {
        $divide = 4;
    } elseif($gender == "f"){
        $divide = 2;
    }
    $ideal_weight= $height-100 -($height-150)/$divide;
    return round($ideal_weight,2);
}
function GetGender($link, $id){
    $selection = mysqli_query($link,"SELECT * FROM users WHERE id='$id'");
    $gender = mysqli_fetch_assoc($selection);
    return $gender['gender'];
}
function GetHeight($link, $id){
    $selection = mysqli_query($link,"SELECT * FROM users WHERE id='$id'");
    $height = mysqli_fetch_assoc($selection);
    return $height['height'];
}

$gender = GetGender($link, $id);
$height = GetHeight($link, $id);
$ideal_weight = IdealWeight($height, $gender);