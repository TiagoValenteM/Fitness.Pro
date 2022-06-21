<?php
// Start the session
session_start();

// all cookies to be removed when logging out
function remove_all_cookies() {
    unset($_COOKIE['selected_user_id']);
    unset($_COOKIE['selected_user']);
    setcookie("selected_user_id", "", time() - 3600);
    setcookie("selected_user_id", "", time() - 3600, '/');
    setcookie("selected_user", "", time() - 3600);
    setcookie("selected_user", "", time() - 3600, '/');
    setcookie("exercise_id", "", time()-3600);
    session_destroy();
    session_write_close();
}

// if the user is logged in, then remove session variable and
// redirect to login page (index.php)
if (isset($_SESSION['user'])) {
    remove_all_cookies();
    unset($_SESSION['user']);
    header('location: index');
    exit();
}
?>