<?php
session_start();
require_once '../config.php';

if (
    @$_POST['user'] &&
    @$_POST['pass'] &&
    @$_POST['name'] &&
    @$_POST['email'] &&
    @$_POST['height'] &&
    @$_POST['initial_weight'] &&
    @$_POST['gender']
) {
    // sanitize all inputs
    $uuser = mysqli_real_escape_string($link, $_POST['user']); // sanitize string by removing special characters
    $uname = mysqli_real_escape_string($link, $_POST['name']);
    $uemail = mysqli_real_escape_string($link, $_POST['email']);
    $uheight = mysqli_real_escape_string($link, $_POST['height']);
    $uinitial_weight = mysqli_real_escape_string(
        $link,
        $_POST['initial_weight']
    );
    $upass = md5($_POST['pass']);
    $ugender = strtolower(mysqli_real_escape_string($link, $_POST['gender']));

    if (!validate_inputs($ugender)) {
        failed('Failed to create account.');
        exit();
    }
    try {
        // query message to create user in database
        $sql = "INSERT INTO users (name, email, password, user,gender, initial_weight, height) VALUES ('$uname','$uemail','$upass','$uuser','$ugender','$uinitial_weight','$uheight');";
        $result = mysqli_query($link, $sql);

        // if query is successful, return success message
        if ($result === true) {
            sucessful('Account created.');
        } else {
            failed('Failed to create account.');
            exit();
        }
    } catch (Exception $e) {
        // if database returned exception, return failure message
        failed('Failed to create account.');
    }
} else {
    failed('Something was missing.');
    exit();
}

function failed($text)
{
    // set error message in session variable to display on the page
    $_SESSION['registerError'] = $text;
    header('location:../index'); // redirect
}

function sucessful($text)
{
    $_SESSION['successMessage'] = $text;
    header('location:../index'); // redirect
}

// this function performs the necessary validations for all inputs
function validate_inputs($ugender)
{
    if ($ugender == "m" || $ugender == "f"){
        return true;
    }
    return false;
}
?>
