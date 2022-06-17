<?php
// load session.php that validates if the user is logged in
// if the user is not logged in, redirects to login page
require_once '../session.php';
// connects to the database 'fitnesspro'
include("../config.php");

function SelectExercise($link, $exercise_id){
    $exercise_default = mysqli_query($link,"SELECT * FROM exercises_default WHERE exercise_id='$exercise_id'");
    $exercise_fetch = mysqli_fetch_assoc($exercise_default);
    return $exercise_fetch;
}

// getting the id from each exercise
$exercise_id = $_REQUEST['exercise_id'];
$exercise_fetch = SelectExercise($link, $exercise_id);

echo "<div>
            <h1 class='headings-box-sm white margin-paragraph-container'>Updating workout?<br /></h1>
            <h1 class='title-box pink margin-paragraph-container margin-left'>".$exercise_fetch['exercise_type']."</h1>
        </div>
        <div>
            <img class='icon-size-md-form margin-responsive img-responsive' src='data:image/jpg;base64,".base64_encode($exercise_fetch['img_data'])."' >
        </div>";
