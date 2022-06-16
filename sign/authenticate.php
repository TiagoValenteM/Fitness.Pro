<?php
session_start();
require_once '../config.php';

if (@$_POST['user'] && @$_POST['pass']) {
    $uuser = mysqli_real_escape_string($link, $_POST['user']); // sanitize string by removing special characters
    $upass = md5($_POST['pass']);

    // query message to obtain user from database
    $sql = mysqli_query($link,"SELECT id FROM users WHERE password='$upass' AND user='$uuser'");
    $user_found = mysqli_fetch_assoc($sql); // user found

    if (!isset($user_found)) {
        failed();
        exit();
    } else{
        $id_user = implode($user_found);
        $is_admin = mysqli_query($link, "SELECT id FROM users WHERE id='$id_user' AND user_type='admin'");
        $check = mysqli_num_rows($is_admin); // number of users found (not found means it's just an user)
        if ($check == 0){
            $_SESSION['user'] = $uuser;
            // user was found with correct password, therefore we can set the session variable
            // to acknowledge that the user is logged in
            successful();
        }
        else{
            $_SESSION['user'] = $uuser;
            // user was found with correct password, therefore we can set the session variable
            // to acknowledge that the user is logged in
            admin_dashboard();
        }
    }
} elseif (!@isset($_SESSION['user'])) {
    // if hasn't received user and pass, and is not logged in, return to sign in
    failed();
    exit();
}

function failed()
{
    // set error message in session variable to display on the page
    $_SESSION['errorMessage'] = true;
    header('location: ../index'); // redirect
}

function successful()
{
    header('location:../home'); // redirect
}

function admin_dashboard()
{
    header('location:../admin'); // redirect
}


