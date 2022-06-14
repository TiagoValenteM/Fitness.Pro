<?php
// load session.php that validates if the user is logged in
// if the user is not logged in, redirects to login page
require_once '../session.php';
// connects to the database 'fitnesspro'
include("../config.php");
$data = getLoggedUserData($link);
$id = $data['id'];
$current_month = date('m');
$teste = mysqli_query($link,"SELECT exercise_type, COUNT(*) AS sum_exercise FROM exercises 
    INNER JOIN exercises_default 
    ON exercises.exercise_id=exercises_default.exercise_id  WHERE user_id='$id' AND MONTH(date_done)='$current_month' GROUP BY exercise_type");
$teste_list = array();
// selecting element in an array
while($teste2 = mysqli_fetch_assoc($teste)) {
    $teste_list[] = [$teste2['exercise_type'], $teste2['sum_exercise']];
}

echo json_encode($teste_list);