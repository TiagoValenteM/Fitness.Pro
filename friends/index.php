<?php
include("friends_helper.php");

// getting image from database
$profile_photo = $link->query("SELECT `img_data` FROM profile_img  WHERE id='$id'");
$users = $link->query("SELECT * FROM users");
$friends_follow = getFriendsFollow($link);

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="viewport-fit=cover, initial-scale=1.0" />
    <link rel="icon" type="imagem/png" href="favicon.ico" />
    <link rel="stylesheet" href="./style.css" />
    <link rel="stylesheet" href="./friends_style.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
      <script src="js/script.js"></script>
    <title>Profile - Fitness.Pro</title>
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
        <a class="nav-link-style nav-link " href="../profile">
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
  <div class="container" style="display: flex; justify-content: space-between">
    <div>
      <span>Current USER:</span>
      <span><?php echo $_COOKIE['selected_user_id'] . " -> " . $_COOKIE['selected_user']; ?></span>
    </div>
    <div style="display: flex; flex-direction: column; gap: 12px">
        <form method="POST" style="display: flex; flex-direction: column">
            <label for="text">Add Message:</label>
            <textarea style="resize: none;" id="new-message-content" name="new-message-content" rows="7" cols="30"></textarea>
            <button type="submit" name="add-message" class="new-message-button">POST</button>
        </form>
        <hr/>
        <div style="display: flex; flex-direction: column; gap: 20px"><?php
            if (isset($_COOKIE['selected_user_id']) && isset($_COOKIE['selected_user'])) {
                $messages = getUserMessages($link, $_COOKIE['selected_user_id']);
                foreach($messages as $m) { ?>
                    <div style="background: gray; border-radius: 5px; color: white;">
                        <span><?php echo $m['content'] ?></span>
                        <hr>
                        <span><?php echo $m['created'] ?></span>
                        <span><?php echo $m['like_count'] ?> Likes</span>
                    </div>
                <?php }
            }
            ?></div>
    </div>
    <div style="display: flex; flex-direction: column; gap: 12px">
        <h4>List of users:</h4>
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
                                 <button type='submit' name='unfollow' class='unfollow-button'>Unfollow</button>";
                        } else {
                            echo "<input style='display: none' type='text' name='user_to_follow' value='$userFriend' />
                                <button type='submit' name='follow' class='follow-button'>Follow</button>";
                        }
                        ?>
                    </form>
                </div>
            <?php }
        } ?>
        <form method="POST">
            <button type='submit' name='back_to_me'>Back to Me</button>
        </form>
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
