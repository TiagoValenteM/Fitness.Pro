<?php
// load session.php that validates if the user is logged in
// if the user is not logged in, redirects to login page
require_once '../session.php';
// connects to the database 'fitnesspro'
include("../config.php");
include("home_functions.php");
$data = getLoggedUserData($link);
$id = $data['id'];

// check if the user is the admin
if ($data['user_type'] == 'admin') {
    header('location: ../admin');
    exit();
}

// getting image from database
$profile_photo = $link->query("SELECT `img_data` FROM profile_img  WHERE id='$id'");
$users = $link->query("SELECT * FROM users");
$friends_follow = getFriendsFollow($link);

$count_user = 0;
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="viewport-fit=cover, initial-scale=1.0" />
    <link rel="icon" type="imagem/png" href="../img/favicon.ico" />
      <link rel="stylesheet" href="../global_style.css" />
    <link rel="stylesheet" href="./style.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <title>Friends - Fitness.Pro</title>
  </head>
  <body class="background">
  <nav class="navbar-design justify-between flex-row">
    <div class="flex-row margin-left">
      <h3 class="logo-style">
       Fitness.Pro
      </h3>
    </div>
    <div class="flex-row margin-right">
        <a class="nav-link-style nav-link nav-desktop" href="../profile">
            Profile
        </a>
        <a class="nav-link-style nav-link nav-desktop" href="../activity">
               Activity
        </a>
      <div class="dropdown">
        <button class="btn" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false"><img class="menu-img" src="../img/navbar/menu.svg" alt="">
        </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                <div class="center"> </div>
                    <li><a class="dropdown-item mobile-menu" href="../profile">Profile</a></li>
                    <hr class="borderline mobile-menu">
                    <li><a class="dropdown-item mobile-menu" href="../activity">Activity</a></li>
                    <hr class="borderline mobile-menu">
                    <li><a class="dropdown-item" href="../preferences">Preferences</a></li>
                    <hr class="borderline">
                    <li><a class="dropdown-item" href="../end_session.php">Sign Out</a></li>
            </ul>
        </div>
      </div>
    </nav>
  <div class="flex-row space-around margin-responsive">
    <div class="container-translucent-social-profile margin-top-bottom translate margin-responsive">
        <?php if ($_COOKIE['selected_user_id'] != $data['id']) { ?>
            <form method="POST">
            <button class="button-back-to-me margin-profile back-to-me-align-end" type='submit' name='back_to_me' title="Back to Me"></button>
        </form>
        <div class="center height_80">
            <?php } else {?>
            <div class="center height_full">
        <?php } ?>
            <img class="friends-photo-xl translate-resize" src="data:image/jpg;base64,<?php echo base64_encode(getUserPhotoById($link, $_COOKIE['selected_user_id'])); ?>"  alt=""/>
            <div class="margin-profile">
                <div class="center">
                    <br><span class='title-box gray mobile-text'><?php echo getUsernameById($link, $_COOKIE['selected_user_id']); ?></span>
                    <?php if (getUserGenderById($link,$_COOKIE['selected_user_id']) == 'm'){ ?>
                        <span class='paragraph-box gray margin-paragraph-container'><?php echo "(Male)" ?></span>
                    <?php } elseif (getUserGenderById($link,$_COOKIE['selected_user_id']) == 'f'){ ?>
                        <span class='paragraph-box gray margin-paragraph-container'><?php echo "(Female)" ?></span>
                    <?php } ?>
                </div>
                <div class="margin-profile center">
                    <h5 class="headings-box white">Height<br></h5>
                    <span class='bold-paragraph-box green'><?php echo getUserHeightById($link, $_COOKIE['selected_user_id']); ?> Cm</span>
                </div>
                <div class="row-space-around">
                    <div class="margin-profile center padding-sides">
                        <h5 class="headings-box white">Followers<br></h5>
                        <span class='headings-box-sm green'><?php echo CountFollowers($link, $_COOKIE['selected_user_id']); ?></span>
                    </div>
                    <div class="margin-profile center padding-sides">
                        <h5 class="headings-box white">Following<br></h5>
                        <span class='headings-box-sm green'><?php echo CountFollowing($link, $_COOKIE['selected_user_id']); ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-translucent-posts center margin-top-bottom translate overflow-y scrollbar margin-responsive">
        <div class="center padding-50">
            <h2 class="title-box gray">Messages</h2>
            <?php
            echo "<span class='bold-paragraph-box pink margin-paragraph-container'>".date("l, ").date("d M")."</span>";
            ?>
        </div>
        <div class="wrap-friends">
        <form method="POST" class="margin-profile center">
            <textarea class="message-area scrollbar" id="new-message-content" name="new-message-content" rows="7" cols="30"></textarea>
            <button type="submit" name="add-message" class="button-blue bold-paragraph-box margin-profile">Share</button>
        </form>
            <div class="margin-top-bottom" >
                <?php
                if (isset($_COOKIE['selected_user_id']) && isset($_COOKIE['selected_user'])) {
                    $messages = getUserMessages($link, $_COOKIE['selected_user_id']);
                    foreach($messages as $m) { ?>
                        <div class="container-translucent-message margin-top-bottom">
                            <div class="row-space-between margin-top-bottom center-around margin-responsive">
                                <div class="center margin-activity-md">
                                    <img class="friends-photo-sm translate-resize" src="data:image/jpg;base64,<?php echo base64_encode(getUserPhotoById($link, $m['created_by'])); ?>"  alt=""/>
                                </div>
                                <div class="column margin-activity-md">
                                    <span class="paragraph-box-xl white"><?php echo getUsernameWhoSentMessage($link, $m['created_by']) ?></span>
                                    <span class="paragraph-box white"><?php echo date('d-m-Y | H:i', strtotime($m['created'])) ?></span>
                                    <span class="paragraph-box-xl blue"><?php echo $m['like_count'] ?> Likes</span>
                                </div>
                                <div class="center margin-activity-md">
                                    <form action="" method="POST">
                                        <input class="hidden" name="post_to_like" value='<?php echo $m['post_id'] ?>'>
                                        <button type="submit" name='like' class="button-like" title="Like">
                                    </form>
                                </div>
                            </div>
                            <div class="message_content">
                                <span class="paragraph-box white"><?php echo $m['content'] ?></span>
                            </div>
                        </div>
                    <?php }} ?></div>
        </div>
    </div>
    <div class="container-translucent-friends center margin-top-bottom translate margin-responsive overflow-y scrollbar">
        <div class="center padding-50">
            <h2 class="title-box pink mobile-text">People you may know</h2>
            <h4 class="bold-paragraph-box gray margin-paragraph-container mobile-text">(To access a person's profile, click on their name)</h4>
        </div>
        <div  class="wrap-friends" >
            <?php while($row = mysqli_fetch_assoc($users)) {
                if ($row['id'] != $id && $row['user_type'] != 'admin'  ) { ?>
                    <form method="POST" class="hover-friend">
                        <div class="container-translucent-each-friend margin-activity-md row-space-between padding-sides">
                            <div class="center">
                                <img class="friends-photo-md translate-resize" src="data:image/jpg;base64,<?php echo base64_encode(getUserPhotoById($link, $row['id'])); ?>"  alt=""/>
                            </div>
                            <div class="friends-align-end">
                                <button class="name-friend headings-box-sm white" type="submit" name="select_user" value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></button>
                                <?php
                                $userFriend = $row['id'];
                                $isFollowed = isFollowedBy($id, $userFriend, $friends_follow);
                                if ($isFollowed) {
                                    echo "<input class='hidden' type='text' name='user_to_unfollow' value='$userFriend' />
                                     <button type='submit' name='unfollow' class='button-pink bold-paragraph-box-button'>Unfollow</button>";
                                } else {
                                    echo "<input class='hidden' type='text' name='user_to_follow' value='$userFriend' />
                                    <button type='submit' name='follow' class='button-green bold-paragraph-box'>Follow</button>";
                                }
                                ?>
                            </div>
                        </div>
                    </form>
                <?php }
            } ?>
        </div>
    </div>
        <div class="container-translucent-friends-activity center margin-top-bottom translate margin-responsive overflow-y scrollbar">
            <div class="center padding-50">
                <h2 class="title-box blue">Activity</h2>
                <h4 class="bold-paragraph-box white margin-paragraph-container">(Latest exercises)</h4>
            </div>
            <div class="wrap-friends">
                <?php
                $display_list = getExercisesbyUser($link, $_COOKIE['selected_user_id']);
                if (isset($display_list)){ ?>
                    <?php while ($count_user < 7 && $count_user < count($display_list)) { ?>
                        <div class="container-translucent-social-activities margin-activity-md row-space-between center-around margin-responsive padding-sides-sm">
                                <div class="column">
                                    <img class="icon-size-md-form padding-list-icon" src="data:image/jpg;base64,<?php echo base64_encode($display_list[$count_user]['img_data']); ?>"  alt=""/>
                                </div>
                                <div class="column">
                                    <div class="row-space-between margin-activity">
                                        <?php
                                        echo "<span class='headings-box-sm green margin-profile-side'>".($display_list[$count_user]['exercise_type'])."</span>";
                                        echo "<span class='paragraph-box-xl white margin-profile-side'>".($display_list[$count_user]['total_kcal'])." Kcal</span>";
                                        ?>
                                    </div>
                                    <div class="row-space-between margin-activity">
                                        <?php
                                        echo "<span class='paragraph-box-xl white margin-profile-side'>".($display_list[$count_user]['status'])."</span>";
                                        echo "<span class='paragraph-box-xl white margin-profile-side'>".($display_list[$count_user]['people'])."</span>";
                                        echo "<span class='paragraph-box-xl white margin-profile-side'>".($display_list[$count_user]['place'])."</span>";
                                        ?>
                                    </div>
                                    <div class="row-space-between margin-activity">
                                        <?php
                                        echo "<span class='paragraph-box-xl white margin-profile-side'>".($display_list[$count_user]['total_time'])."</span>";
                                        echo "<span class='paragraph-box-xl white margin-profile-side'>".($display_list[$count_user]['date_done'])."</span>";
                                        ?>
                                    </div>
                            </div>
                        </div>
                        <?php $count_user  = $count_user + 1; } ?>
                <?php }else {
                    echo "<span class='headings-box white margin-paragraph-container height_80 center'>No workouts available</span>";
                } ?>
            </div>
        </div>
  </div>
  <footer class="padding-footer">
      <hr class="borderline">
      <div class="flex-row justify-around">
          <h5 class="footer-text ">Copyright © 2022    Fitness.Pro.    All rights reserved.</h5>
          <h5 class="footer-text">Portugal</h5>
      </div>
  </footer>
  </body>
</html>
