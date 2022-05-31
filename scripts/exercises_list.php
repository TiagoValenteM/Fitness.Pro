<?php
// load session.php that validates if the user is logged in
// if the user is not logged in, redirects to login page
require_once '../session.php';
// connects to the database 'fitnesspro'
include("../config.php");

// connecting to the database and creating an array
$exercise = mysqli_query($link,"SELECT * FROM exercises_default");
$exercise_list = array();

// selecting element in an array
while($row = mysqli_fetch_row($exercise)) {
    $exercise_list[] = $row;
}