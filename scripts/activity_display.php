<?php
// load session.php that validates if the user is logged in
// if the user is not logged in, redirects to login page
require_once '../session.php';
// connects to the database 'fitnesspro'
include("../config.php");
$data = getLoggedUserData($link);
$id = $data['id'];

// connecting to the database and creating an array to check workouts by user
$exercises_query = mysqli_query($link,"SELECT * FROM exercises WHERE user_id='$id'");
$exercises_query_fetch = mysqli_fetch_assoc($exercises_query);

// checking if the user has already inserted a workout
if (isset($exercises_query_fetch['user_id'])){
    // connecting to the database and creating an array
    $query = mysqli_query($link,"SELECT * FROM exercises 
    INNER JOIN exercises_default 
    ON exercises.exercise_id=exercises_default.exercise_id 
    WHERE user_id='$id' 
    ORDER BY `date_done` DESC ");
    $display_list = array();

    // selecting element in an array
    while($activity_row = mysqli_fetch_assoc($query)) {
        $display_list[] = $activity_row;
    }
}
