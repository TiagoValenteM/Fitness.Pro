<?php
// load session.php that validates if the user is logged in
// if the user is not logged in, redirects to login page
require_once '../session.php';
// connects to the database 'fitnesspro'
include("../config.php");
$data = getLoggedUserData($link);
$id = $data['id'];

function CurrentWeight($link, $id, $data){
    $select_weight = mysqli_query($link,"SELECT * FROM weight WHERE id='$id' ORDER BY `date` DESC LIMIT 1 ");
    $current_weight = mysqli_fetch_assoc($select_weight);
    $value = isset($current_weight['id']);
    if ($value != 0) {
        $mass = $current_weight['weight'];
    } else {
        $mass = $data["initial_weight"];
    }
    return $mass;
}
function BMI($data, $mass){
    $height = $data['height']/100; // <-- divide by 100 because it requires meters

    $height2 = ($height * $height);
    $bmi = $mass / $height2;
    return round($bmi,2);
}
function BMIClasses($bmi){
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
    return $output;
}

$mass = CurrentWeight($link,$id,$data);
$bmi = BMI($data, $mass);
$output = BMIClasses($bmi);




