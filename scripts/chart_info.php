<?php
// load session.php that validates if the user is logged in
// if the user is not logged in, redirects to login page
require_once '../session.php';
// connects to the database 'fitnesspro'
include("../config.php");
$data = getLoggedUserData($link);
$id = $data['id'];

// getting the current month
$current_month = date('m');

function GetMonthWorkouts ($link,$id,$current_month){
    $get_exercises = mysqli_query($link,"SELECT exercise_type, COUNT(*) AS sum_exercise 
        FROM exercises INNER JOIN exercises_default 
        ON exercises.exercise_id=exercises_default.exercise_id  
        WHERE user_id='$id' AND MONTH(date_done)='$current_month' 
        GROUP BY exercise_type");
    $month_exercises = array();
    while($fetch = mysqli_fetch_assoc($get_exercises)) {
        $month_exercises[] = [$fetch['exercise_type'], $fetch['sum_exercise']];
    }
    return $month_exercises;
}

echo json_encode(GetMonthWorkouts ($link,$id,$current_month));