<?php
session_start();
require_once '../config.php';

if (@$_POST['user'] && @$_POST['pass']) {
    $uuser = mysqli_real_escape_string($link, $_POST['user']); // sanitize string by removing special characters
    $upass = md5($_POST['pass']);

    // query message to obtain user from database
    $sql = "SELECT id FROM users WHERE password='$upass' AND email='$uuser'";
    $result = mysqli_query($link, $sql);
    $num = mysqli_num_rows($result); // number of users found (should be 1 if logged in successfully)

    if ($num < 1) {
        failed();
        exit();
    } else {
        $_SESSION['user'] = $uuser;
        // user was found with correct password, therefore we can set the session variable
        // to acknowledge that the user is logged in
        sucessful();
    }
} elseif (!@isset($_SESSION['user'])) {
    // if hasn't received user and pass, and is not logged in, return to login
    failed();
    exit();
}

function failed()
{
    // set error message in session variable to display on the page
    $_SESSION['errorMessage'] = true;
    header('location:../index'); // redirect
}

function sucessful()
{
    header('location:../index'); // redirect
}

?>
