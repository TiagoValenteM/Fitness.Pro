<?php
// load session.php that validates if the user is logged in
// if the user is not logged in, redirects to login page
require_once '../session.php';
// connects to the database 'fitnesspro'
include("../config.php");
$data = getLoggedUserData($link);
$id = $data['id'];

function SelectExercise($link, $exercise_id){
    $exercise_default = mysqli_query($link,"SELECT * FROM exercises_default WHERE exercise_id='$exercise_id'");
    $exercise_fetch = mysqli_fetch_assoc($exercise_default);
    return $exercise_fetch;
}
function UserNewWorkout($link,$exercise_id,$status,$place,$people,$date_done,$total_time,$total_kcal,$id){
    $exercise_insert = ("INSERT INTO exercises (`exercise_id`,`status`,`place`,`people`,`date_done`,`total_time`,`total_kcal`,`user_id`) VALUES ('$exercise_id','$status','$place','$people','$date_done','$total_time','$total_kcal','$id')");
    $exercise_inserted = mysqli_query($link, $exercise_insert);
}

if (isset($_POST["submit"]) && isset($_COOKIE['exercise_id']))  {
    // getting the id from each exercise
    $exercise_id = $_COOKIE['exercise_id'];
    $exercise_fetch = SelectExercise($link, $exercise_id);
    // getting form's information
    $status = $_REQUEST["status"];
    $people = $_REQUEST["people"];
    $place = $_REQUEST["place"];
    $date_done = $_REQUEST["date_done"];
    $total_time = $_REQUEST["total_time"];
    $total_time_hours = (int) date("H",strtotime($total_time)) +( (int) date("i", strtotime($total_time))/60);
    $total_kcal = $total_time_hours*$exercise_fetch["kcal_hour"];
    // adding a workout
    UserNewWorkout($link,$exercise_id,$status,$place,$people,$date_done,$total_time,$total_kcal,$id);
}