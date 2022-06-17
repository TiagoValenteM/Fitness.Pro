<?php
// load session.php that validates if the user is logged in
// if the user is not logged in, redirects to login page
require_once '../session.php';
// connects to the database 'fitnesspro'
include("../config.php");
include("../scripts/activity_display.php");
$data = getLoggedUserData($link);
$id = $data['id'];

// check if the user is the admin
if ($data['user_type'] == 'admin') {
    header('location: ../admin');
    exit();
}

// getting image from database
$profile_photo = $link->query("SELECT `img_data` FROM profile_img  WHERE id='$id'");

// getting the most recent weight from database
$select_weight = mysqli_query($link,"SELECT * FROM weight WHERE id='$id' ORDER BY `date` ASC");
$display_weight = array();

// selecting element in an array
while($current_weight = mysqli_fetch_assoc($select_weight)) {
        $display_weight[] = $current_weight ;
}


// counter for user's exercises list
$count_user = 0;

// counter for user's exercises list
$count_weight = 0;
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
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
      <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="js/script.js"></script>
    <title>Activity - Fitness.Pro</title>
  </head>
  <body>
  <nav class="navbar-design justify-between flex-row">
    <div class="flex-row margin-left">
      <h3 class="logo-style">
       Fitness.Pro
      </h3>
    </div>
    <div class="flex-row margin-right">
    <a class="nav-link-style nav-link nav-desktop" href="../home">
       Home</a>
<a class="nav-link-style nav-link nav-desktop" href="../profile">
       Profile</a>
      <div class="dropdown">
        <button class="btn" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false"><img class="menu-img" src="../img/navbar/menu.svg" alt="">
        </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                <div class="center"></div>
                <li><a class="dropdown-item mobile-menu" href="../home">Home</a></li>
                <hr class="borderline mobile-menu">
                <li><a class="dropdown-item mobile-menu" href="../profile">Profile</a></li>
                <hr class="borderline mobile-menu">
                <li><a class="dropdown-item" href="../preferences">Preferences</a></li>
                <hr class="borderline">
                <li><a class="dropdown-item" href="../end_session.php">Sign Out</a></li>
            </ul>
        </div>
      </div>
    </nav>
    <div class="col background-photo-activity translate" id="main">
          <img class="img-activity" src="../img/background/background_activity.jpeg" alt="">
        <div class="text-over">
          <h5 class="title-main">Activity</h5>
        </div>
    </div>
<div class="flex-row padding-top-content space-around margin-responsive">
          <div class="container-translucent-trends margin-top-bottom translate margin-responsive">
              <div class="center padding-50">
                  <h2 class="title-box pink">Trends</h2>
                  <h4 class="bold-paragraph-box gray margin-paragraph-container">Keep it Going</h4>
              </div>
              <div class="center-trends-align height_65 overflow-x scrollbar">
                  <div class="scroll-row">
                      <div class="center margin-weight-side">
                          <?php if($profile_photo->num_rows > 0){?>
                          <?php while($row = $profile_photo->fetch_assoc()){ ?>
                              <img class="weights-icon margin-top-bottom" src="data:image/jpg;base64,<?php echo base64_encode($row['img_data']); ?>">
                          <?php } ?>
                          <?php } elseif ($data['gender'] == 'm'){ ?>
                              <img class="weights-icon margin-top-bottom" src="../img/profile_img/default_male.jpeg" alt="">
                          <?php }elseif ($data['gender'] == 'f'){ ?>
                              <img class="weights-icon margin-top-bottom" src="../img/profile_img/default_female.jpeg" alt="">
                          <?php }?>
                          <div class="indicator-weight center"></div>
                          <div class="weight-border-initial"></div>
                          <div class="container-translucent-each-weight center margin-top-bottom">
                              <span class='margin-paragraph-container headings-box-sm white padding-list-icon'><?php echo $data['initial_weight']?> Kg</span>
                              <?php $initial_weight_date = $data["date"];?>
                              <span class='paragraph-box green margin-paragraph-container'><?php echo date('d-m-Y', strtotime($initial_weight_date))?></span>
                          </div>
                      </div>
                      <?php while ($count_weight < count($display_weight)){?>
                          <?php $weight_date = $display_weight[$count_weight]['date'];?>
                              <div class="center margin-weight-side">
                                  <img class="weights-icon margin-top-bottom" src="../img/exercises/other.png">
                                  <div class="indicator-weight center"></div>
                                  <div class="weight-border"></div>
                                  <div class="container-translucent-each-weight center margin-top-bottom">
                                      <span class='margin-paragraph-container headings-box-sm white padding-list-icon'><?php echo $display_weight[$count_weight]['weight'] ?> Kg</span>
                                      <span class='paragraph-box green margin-paragraph-container'><?php echo date('d-m-Y', strtotime($weight_date)) ?></span>
                                  </div>
                              </div>
                          <?php $count_weight  = $count_weight + 1; } ?>
                  </div>
              </div>
          </div>
      <div class="container-translucent-activity center margin-top-bottom translate overflow-y scrollbar margin-responsive">
          <div class="center padding-50">
              <h2 class="title-box blue">Summary</h2>
              <?php
              echo "<span class='bold-paragraph-box white margin-paragraph-container'>".date("l, ").date("d M")."</span>";
              ?>
          </div>
          <div class="wrap-570">
              <?php
              if (isset($display_list)){ ?>
                  <?php while ($count_user < count($display_list)) { ?>
                      <div class="margin-activity-md container-translucent-each-activity">
                          <div class="row-space-between margin-top-bottom center-around margin-responsive">
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
                      </div>
                      <?php $count_user  = $count_user + 1; } ?>
              <?php }else {
                  echo "<span class='headings-box gray margin-paragraph-container height_90 center'>No workouts available</span>";
              } ?>
          </div>
      </div>
          <div class="container-translucent-rings margin-top-bottom translate margin-responsive">
              <div class="center padding-50">
                  <h2 class="title-box green">Rings</h2>
                  <h4 class="bold-paragraph-box white margin-paragraph-container">Review this month's exercises</h4>
              </div>
              <div class="center height_330">
                  <div id="rings" class="chart"></div>
                  <span id="current_month" class="headings-box-sm white margin-profile hidden"><?php echo date('F Y'); ?></span>
                  <h4 id="no_workouts" class="headings-box green margin-paragraph-container hidden no-workouts">No workouts this month</h4>
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
