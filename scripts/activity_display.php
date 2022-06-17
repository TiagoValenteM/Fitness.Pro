<?php
// load session.php that validates if the user is logged in
// if the user is not logged in, redirects to login page
require_once '../session.php';
// connects to the database 'fitnesspro'
include("../config.php");
$data = getLoggedUserData($link);
$id = $data['id'];

function UserExercises($link, $id){
    $exercises_query = mysqli_query($link,"SELECT * FROM exercises WHERE user_id='$id'");
    return mysqli_fetch_assoc($exercises_query);
}
function ExercisesData($link, $fetch, $id){
    if (isset($fetch['user_id'])){
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
        return $display_list;
    }
}

$fetch = UserExercises($link, $id);
$display_list = ExercisesData($link, $fetch, $id);