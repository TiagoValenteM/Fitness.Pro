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

// getting the most recent weight from database
$select_weight = mysqli_query($link,"SELECT * FROM weight WHERE id='$id' ORDER BY `date` DESC LIMIT 1 ");
$current_weight = mysqli_fetch_assoc($select_weight);
// checking if the user has a more recent weight than the initial value
$value= isset($current_weight['id']);

// formula to calculate BMI
if ($value != 0) {
    $mass = $current_weight['weight'];
} else {
    $mass = $data["initial_weight"];
}
    $height = $data['height']/100; // <-- divide by 100 because it requires meters

    $height2 = ($height * $height);
    $bmi = $mass / $height2;
    $bmi = round($bmi,2);

// BMI classes
    if ($bmi <= 18.5) {
        $output = "Underweight";

    } else if ($bmi > 18.5 and $bmi <= 24.9) {
        $output = "Appropriate weight";

    } else if ($bmi > 24.9 and $bmi <= 29.9) {
        $output = "Overweight";

    } else if ($bmi > 30.0 and $bmi <= 39.9) {
        $output = "Severe obesity";

    } else if ($bmi > 40.0 and $bmi <= 44.9) {
        $output = "Morbid obesity";

    } else if ($bmi > 45.0) {
        $output = "Super obesity";
    }

