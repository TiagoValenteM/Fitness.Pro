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

// getting the id from each exercise
$exercise_id = $_REQUEST['exercise_id'];
$exercise_default = mysqli_query($link,"SELECT * FROM exercises_default WHERE exercise_id='$exercise_id'");
$exercise_fetch = mysqli_fetch_assoc($exercise_default);

echo "<div>
            <h1 class='headings-box-sm white margin-paragraph-container'>New workout?<br /></h1>
            <h1 class='title-box pink margin-paragraph-container margin-left'>".$exercise_fetch['exercise_type']."</h1>
        </div>
        <div>
            <img class='icon-size-md-form margin-icons margin-left' src='data:image/jpg;base64,".base64_encode($exercise_fetch['img_data'])."' >
        </div>";
