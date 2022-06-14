<?php
// Start the session
session_start();

// if the user is not logged in, then redirect to login page (index.php)
if (!isset($_SESSION['user'])) {
    header('location: ../index');
    exit();
}

function getLoggedUserData($link) {
    // getting data from the user that is logged in
    $user = mysqli_real_escape_string($link, $_SESSION['user']);
    $result = mysqli_query($link,"SELECT * FROM users WHERE user='$user'");
    return mysqli_fetch_assoc($result);
}

