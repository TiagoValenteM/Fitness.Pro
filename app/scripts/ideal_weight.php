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

// getting user's gender
$selection = mysqli_query($link,"SELECT * FROM users WHERE id='$id'");
$gender = mysqli_fetch_assoc($selection);
$gender = $gender['gender'];

// getting user's height
$selection = mysqli_query($link,"SELECT * FROM users WHERE id='$id'");
$height = mysqli_fetch_assoc($selection);
$height = $height['height'];

//formula to calculate ideal weight
if($gender == "m") {
    $divide = 4;
} elseif($gender == "f"){
    $divide = 2;
}
    $ideal_weight= $height-100 -($height-150)/$divide;
    $ideal_weight = round($ideal_weight,2);