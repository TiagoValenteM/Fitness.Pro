<?php
// load session.php that validates if the user is logged in
// if the user is not logged in, redirects to login page
require_once '../session.php';
// connects to the database 'fitnesspro'
include("../config.php");
$data = getLoggedUserData($link);
$id = $data['id'];

if (!isset($_COOKIE['selected_user_id']) || !isset($_COOKIE['selected_user'])) {
    setcookie('selected_user_id', $id);
    setcookie('selected_user',  $data['name']);
}

function getFriendsFollow($link) {
    $follow_links = mysqli_query($link,"SELECT * FROM friends_follow");
    $friends_follow_arr = array();
    while($row = mysqli_fetch_assoc($follow_links)) {
        $friends_follow_arr[] = $row;
    }
    return $friends_follow_arr;
}

function isFollowedBy($follower_id, $followed_id, $friends_follow) {
    $isFollowed = false;
    foreach ($friends_follow as $follow) {
        if ($follow['follower_id'] == $follower_id && $follow['followed_user_id'] == $followed_id) {
            $isFollowed = true;
            break;
        }
    }
    return $isFollowed;
}

function unfollowUser($link, $follower_id, $followed_id) {
    $friend_follow = mysqli_query($link,"SELECT * FROM friends_follow WHERE follower_id='$follower_id' AND followed_user_id='$followed_id'");
    if (mysqli_num_rows($friend_follow)==1) {
        $friend_follow_id = mysqli_fetch_assoc($friend_follow)['follow_id'];
        mysqli_query($link,"DELETE FROM friends_follow WHERE follow_id='$friend_follow_id'");
    }
}

function followUser($link, $follower_id, $followed_id) {
    $friend_follow = mysqli_query($link,"SELECT * FROM friends_follow WHERE follower_id='$follower_id' AND followed_user_id='$followed_id'");
    if (mysqli_num_rows($friend_follow)==0) {
        mysqli_query($link,"INSERT INTO friends_follow (follower_id, followed_user_id) VALUES ('$follower_id', '$followed_id') ");
    }
}

function getUserMessages($link, $user_id) {
    $user_messages = mysqli_query($link,"SELECT * FROM friends_post WHERE user_id='$user_id'");
    $user_messages_arr = array();
    while($row = mysqli_fetch_assoc($user_messages)) {
        $user_messages_arr[] = $row;
    }
    return array_reverse($user_messages_arr);
}

function addUserMessage($link, $user_id, $created_by, $content) {
    mysqli_query($link,"INSERT INTO friends_post (user_id, created_by, content) VALUES ('$user_id', '$created_by', '$content') ");
}

function getUsernameById($link, $user_id) {
    $user = mysqli_query($link,"SELECT * FROM users WHERE id='$user_id'");
    $user_data = mysqli_fetch_assoc($user);
    return $user_data['name'];
}

if (isset($_POST["follow"])) {
    $followed_id = mysqli_escape_string($link, $_REQUEST["user_to_follow"]);
    followUser($link, $id, $followed_id);
}

if (isset($_POST["unfollow"])) {
    $followed_id = mysqli_escape_string($link, $_REQUEST["user_to_unfollow"]);
    unfollowUser($link, $id, $followed_id);
}
if (isset($_POST["add-message"]) && isset($_COOKIE['selected_user_id'])) {
    $message_content = mysqli_escape_string($link, $_REQUEST["new-message-content"]);
    $selected_user = mysqli_escape_string($link, $_COOKIE['selected_user_id']);
    addUserMessage($link, $selected_user, $id, $message_content);
}

if (isset($_POST["select_user"])) {
    $selected_user_id = mysqli_escape_string($link, $_REQUEST["select_user"]);
    setcookie("selected_user_id", "", time() - 3600);
    setcookie("selected_user", getUsernameById($link, $selected_user_id));
    setcookie("selected_user_id", $selected_user_id);
    header('location:.'); // redirect
}

if (isset($_POST["back_to_me"])) {
    setcookie("selected_user_id", "", time() - 3600);
    setcookie('selected_user_id', $id);
    setcookie('selected_user',  $data['name']);
    header('location:.'); // redirect
}

?>
