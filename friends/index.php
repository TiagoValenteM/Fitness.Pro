<?php
// load session.php that validates if the user is logged in
// if the user is not logged in, redirects to login page
require_once '../session.php';
// connects to the database 'fitnesspro'
include("../config.php");
include("friends_helper.php");

// getting image from database
$profile_photo = $link->query("SELECT `img_data` FROM profile_img  WHERE id='$id'");
$users = $link->query("SELECT * FROM users");
$friends_follow = getFriendsFollow($link);

$_COOKIE['selected_user_id'];
$_COOKIE['selected_user'];

// echo $_COOKIE['selected_user_id'] . " -> " . $_COOKIE['selected_user'];
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="viewport-fit=cover, initial-scale=1.0" />
    <link rel="icon" type="imagem/png" href="favicon.ico" />
    <link rel="stylesheet" href="./style.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
      <script src="js/script.js"></script>
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
       Home
    </a>
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
                    <li><a class="dropdown-item mobile-menu" href="../profile">Home</a></li>
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
    <div class="container-translucent-social-profile center margin-top-bottom translate margin-responsive">
        <form method="POST">
            <button class="button-green bold-paragraph-box" type='submit' name='back_to_me'>Back to Me</button>
        </form>
        <img class="friends-photo-xl translate-resize" src="data:image/jpg;base64,<?php echo base64_encode(getUserPhotoById($link, $_COOKIE['selected_user_id'])); ?>"  alt=""/>
        <div class="margin-profile">
            <div class="center">
                <br><span class='title-box gray'><?php echo getUsernameById($link, $_COOKIE['selected_user_id']); ?></span>
                <?php if (getUserGenderById($link,$_COOKIE['selected_user_id']) == 'm'){ ?>
                    <span class='paragraph-box gray margin-paragraph-container'><?php echo "(Male)" ?></span>
                <?php } elseif (getUserGenderById($link,$_COOKIE['selected_user_id']) == 'f'){ ?>
                <span class='paragraph-box gray margin-paragraph-container'><?php echo "(Female)" ?></span>
                <?php } ?>
            </div>
            <div class="margin-profile center">
                <h5 class="headings-box blue">Height<br></h5>
                <span class='paragraph-box gray'><?php echo getUserHeightById($link, $_COOKIE['selected_user_id']); ?> Cm</span>
            </div>
            <div class="margin-profile center">
                <h5 class="headings-box blue">Following<br></h5>
                <span class='paragraph-box gray'><?php echo CountFollowing($link, $_COOKIE['selected_user_id']); ?></span>
            </div>
            <div class="margin-profile center">
                <h5 class="headings-box blue">Followers<br></h5>
                <span class='paragraph-box gray'><?php echo CountFollowers($link, $_COOKIE['selected_user_id']); ?></span>
            </div>
        </div>
    </div>
    <div class="container-translucent-posts center margin-top-bottom translate overflow-y scrollbar margin-responsive">
        <div>
            <form method="POST" class="column">
                <label for="text">Add Message:</label>
                <textarea style="resize: none;" id="new-message-content" name="new-message-content" rows="7" cols="30"></textarea>
                <button type="submit" name="add-message" class="new-message-button">Share</button>
            </form>
        </div>
        <div>
            <div class="margin-top-bottom" >
                <?php
                if (isset($_COOKIE['selected_user_id']) && isset($_COOKIE['selected_user'])) {
                    $messages = getUserMessages($link, $_COOKIE['selected_user_id']);
                    foreach($messages as $m) { ?>
                        <div class="container-translucent-message margin-top-bottom center">
                            <div class="row-space-between margin-top-bottom center-around margin-responsive">
                                <div class="column">
                                </div>
                                <div class="column">
                                    <div class="row-space-between margin-activity">
                                    </div>
                                </div>
                            </div>
                            <span class="paragraph-box-xl white"><?php echo $m['content'] ?></span>
                            <hr>
                            <span class="paragraph-box-xl white"><?php echo $m['created'] ?></span>
                            <span class="paragraph-box-xl white"><?php echo $m['like_count'] ?> Likes</span>
                        </div>
                    <?php }} ?></div>
        </div>
    </div>
    <div class="container-translucent-friends center margin-top-bottom translate margin-responsive">
        <div class="center">
            <h2 class="title-box blue">People you may know</h2>
            <h4 class="bold-paragraph-box white margin-paragraph-container">(Click in an icon to add a workout)</h4>
        </div>
        <?php while($row = mysqli_fetch_assoc($users)) {
            if ($row['id'] != $id) { ?>
                <div style="display: flex; gap: 12px">
                    <form method="POST">
                        <button type="submit" name="select_user" value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></button>
                        <?php
                        $userFriend = $row['id'];
                        $isFollowed = isFollowedBy($id, $userFriend, $friends_follow);

                        if ($isFollowed) {
                            echo "<input style='display: none' type='text' name='user_to_unfollow' value='$userFriend' />
                                 <button type='submit' name='unfollow' class='button-blue bold-paragraph-box'>Unfollow</button>";
                        } else {
                            echo "<input style='display: none' type='text' name='user_to_follow' value='$userFriend' />
                                <button type='submit' name='follow' class='button-green bold-paragraph-box'>Follow</button>";
                        }
                        ?>
                    </form>
                </div>
            <?php }
        } ?>
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
