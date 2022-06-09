<?php
// load session.php that validates if the user is logged in
// if the user is not logged in, redirects to login page
require_once '../session.php';
// connects to the database 'fitnesspro'
include("../config.php");
$data = getLoggedUserData($link);
$id = $data['id'];

if (isset($_POST["submit"]) && isset($_COOKIE['exercise_id']))  {
    // getting the id from each exercise
    $exercise_id = $_COOKIE['exercise_id'];
    // setting variables to insert into the table
    $exercise_default = mysqli_query($link,"SELECT * FROM exercises_default WHERE exercise_id='$exercise_id'");
    $exercise_fetch = mysqli_fetch_assoc($exercise_default);
    $exercise_type = $_REQUEST["exercise_type"];
    $img_data = $_REQUEST["img_data"];
    $kcal_hour = $_REQUEST["kcal_hour"];
    // inserting information
    $insert = ("INSERT INTO exercises_default (`exercise_type`,`img_data`,`kcal_hour`) VALUES ('$exercise_type','$img_data','$kcal_hour')");
    $inserted = mysqli_query($link, $insert);

    // remove cookie
    setcookie("exercise_id", "", time()-3600);
}
