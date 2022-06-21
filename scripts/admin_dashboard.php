<?php
// load session.php that validates if the user is logged in
// if the user is not logged in, redirects to login page
require_once '../session.php';
// connects to the database 'fitnesspro'
include("../config.php");

 // getting the selected exercise
if (isset($_COOKIE['exercise_id'])){
    $exercise_id = $_COOKIE['exercise_id'];
    $exercise_info = mysqli_query($link,"SELECT * FROM exercises_default WHERE exercise_id='$exercise_id'");
    $exercise = mysqli_fetch_assoc($exercise_info);
}

function NewWorkout ($link, $exercise_type, $kcal_hour){
    $insert = $link->prepare("INSERT INTO exercises_default (`exercise_type`,`img_name`,`img_data`,`kcal_hour`) VALUES ('$exercise_type',?,?,'$kcal_hour')");
    $insert->execute([$_FILES["img_data"]["name"], file_get_contents($_FILES['img_data']['tmp_name'])]);
}
function DeleteWorkout ($link, $exercise_id){
    $delete = mysqli_query($link,"DELETE FROM exercises_default WHERE exercise_id='$exercise_id'");
}
function ModifyWorkoutWithPhoto ($link, $exercise_type, $kcal_hour, $exercise_id ){
    $insert = $link->prepare("UPDATE exercises_default SET exercise_type = '$exercise_type', img_name = ?, img_data = ?,kcal_hour = '$kcal_hour' WHERE exercise_id='$exercise_id'");
    $insert->execute([$_FILES["img_data"]["name"], file_get_contents($_FILES['img_data']['tmp_name'])]);
}

if (isset($_POST["new_workout"])) {
    $exercise_type = $_REQUEST["exercise_type"];
    $kcal_hour = $_REQUEST["kcal_hour"];
    NewWorkout($link, $exercise_type, $kcal_hour);
    header("Refresh:0");
}

if (isset($_POST["delete"]) && isset($_COOKIE['exercise_id']))  {
    DeleteWorkout ($link, $exercise_id);
    header("Refresh:0");
}

if (isset($_POST["modify"]) && isset($_COOKIE['exercise_id'])) {
    $exercise_type = $_REQUEST["exercise_type"];
    $kcal_hour = $_REQUEST["kcal_hour"];
    ModifyWorkoutWithPhoto($link, $exercise_type, $kcal_hour, $exercise_id);
    header("Refresh:0");
}