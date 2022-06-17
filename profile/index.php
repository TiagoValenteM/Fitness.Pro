<?php
// load session.php that validates if the user is logged in
// if the user is not logged in, redirects to login page
require_once '../session.php';
// connects to the database 'fitnesspro'
include("../config.php");
include("../scripts/bmi.php");
include("../scripts/ideal_weight.php");
include("../scripts/exercises_list.php");
include("../scripts/workout_add.php");
include("../scripts/activity_display.php");
$data = getLoggedUserData($link);
$id = $data['id'];

// check if the user is the admin
if ($data['user_type'] == 'admin') {
    header('location: ../admin');
    exit();
}

// getting image from database
$profile_photo = $link->query("SELECT `img_data` FROM profile_img  WHERE id='$id' ORDER BY `date` DESC LIMIT 1");

// getting the most recent weight from database
$select_weight = mysqli_query($link,"SELECT * FROM weight WHERE id='$id' ORDER BY `date` DESC LIMIT 1 ");
$current_weight = mysqli_fetch_assoc($select_weight);
// checking if the user has a more recent weight than the initial value
$value= isset($current_weight['id']);

// counter for exercise list available
$counter = 0;

// counter for user's exercises list
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
    <a class="nav-link-style nav-link nav-desktop" href="../home">
       Home
    </a>
    <a class="nav-link-style nav-link nav-desktop" href="../activity">
           Activity
    </a>
      <div class="dropdown">
        <button class="btn" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false"><img class="menu-img" src="../img/navbar/menu.svg" alt="">
        </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                <div class="center"> </div>
                    <li><a class="dropdown-item mobile-menu" href="../home">Home</a></li>
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
    <div>
        <div class="flex-row space-around margin-responsive">
                <div class="container-translucent-profile margin-top-bottom translate margin-responsive">
                    <div>
                        <?php
                        if($profile_photo->num_rows > 0){ ?>
                            <div class="flex-row">
                                <?php while($row = $profile_photo->fetch_assoc()){ ?>
                                    <img class="profile-img translate-resize" src="data:image/jpg;base64,<?php echo base64_encode($row['img_data']); ?>"  alt=""/>
                                <?php } ?>
                            </div>
                        <?php }elseif ($data['gender'] == 'm'){ ?>
                            <img class="profile-img" src="../img/profile_img/default_male.jpeg" alt="">
                        <?php }elseif ($data['gender'] == 'f'){ ?>
                            <img class="profile-img" src="../img/profile_img/default_female.jpeg" alt="">
                        <?php }
                        ?>
                    </div>
                        <div class="center">
                            <div class="margin-profile">
                                <div class="center">
                                    <br><?php
                                    echo "<span class='title-box gray'>".$data["name"]."</span>";
                                    if ($data['gender'] == 'm'){
                                        echo "<span class='paragraph-box gray margin-paragraph-container'>(Male)</span>";
                                    } elseif ($data['gender'] == 'f'){
                                        echo "<span class='paragraph-box gray margin-paragraph-container'>(Female)</span>";
                                    }
                                    ?>
                                </div>

                            </div>
                            <div class="margin-profile">
                                <h5 class="headings-box pink">Height<br></h5>
                                <?php
                                echo "<span class='center paragraph-box gray'>".$data["height"]." Cm</span>";
                                ?>
                            </div>
                            <div class="margin-profile">
                                <h5 class="headings-box pink">Weight<br></h5>
                                <?php
                                if ($value != 0) {
                                    echo "<span class='center paragraph-box gray'>".$current_weight['weight']." Kg</span>";
                                } else {
                                    echo "<span class='center paragraph-box gray'>".$data["initial_weight"]." Kg</span>";
                                }
                                ?>
                            </div>
                        </div>
                </div>
                <div class="container-translucent-workouts margin-top-bottom space-around translate margin-responsive" id="open_box">
                    <div class="center margin-heading-container">
                        <h2 class="title-box blue">+ Workouts</h2>
                        <h4 class="bold-paragraph-box white margin-paragraph-container">(Click in an icon to add a workout)</h4>
                    </div>
                    <div class="center height_full">
                        <div class="flex-row center">
                            <div class="center">
                                <img class="icon-size-xs margin-icons" src="../img/exercises/other.png" alt="">
                            </div>
                            <?php
                            while ($counter < 3) {?>
                            <div class="center" onclick="">
                                    <input id='<?php echo ($exercise_list[$counter][2])?>' type="image" class="icon-size-sm margin-icons exercise_circle"src="data:image/jpg;base64,<?php echo base64_encode($exercise_list[$counter][1]); ?>"  alt=""/>
                            </div>
                            <?php $counter = $counter + 1; }   ?>
                            <div class="center">
                                <img class="icon-size-xs margin-icons" src="../img/exercises/other.png" alt="">
                            </div>
                        </div>
                        <div class="flex-row space-around">
                            <?php
                            while ($counter < 7) { ?>
                            <div class="center">
                                <input id='<?php echo ($exercise_list[$counter][2])?>' type="image" class="icon-size-md margin-icons exercise_circle" src="data:image/jpg;base64,<?php echo base64_encode($exercise_list[$counter][1]); ?>" alt="">
                            </div>
                            <?php $counter = $counter + 1; } ?>

                        </div>
                        <div class="flex-row space-around">
                            <div class="center">
                                <img class="icon-size-xs margin-icons" src="../img/exercises/other.png" alt="">
                            </div>
                            <?php
                            while ($counter < 10) { ?>
                                <div class="center">
                                    <input id='<?php echo ($exercise_list[$counter][2])?>' type="image" class="icon-size-xl margin-icons exercise_circle" src="data:image/jpg;base64,<?php echo base64_encode($exercise_list[$counter][1]); ?>" alt="">
                                </div>
                            <?php $counter = $counter + 1; } ?>
                            <div class="center">
                                <img class="icon-size-xs margin-icons" src="../img/exercises/other.png" alt="">
                            </div>
                        </div>
                        <div class="flex-row space-around">
                            <?php
                            while ($counter < 14) { ?>
                                <div class="center">
                                    <input id='<?php echo ($exercise_list[$counter][2])?>' type="image" class="icon-size-md margin-icons exercise_circle" src="data:image/jpg;base64,<?php echo base64_encode($exercise_list[$counter][1]); ?>" alt="">
                                </div>
                            <?php $counter = $counter + 1; } ?>
                        </div>
                        <div class="flex-row center">
                            <div class="center">
                                <img class="icon-size-xs margin-icons" src="../img/exercises/other.png" alt="">
                            </div>
                            <?php
                            while ($counter < 17) { ?>
                                <div class="center">
                                    <input id='<?php echo ($exercise_list[$counter][2])?>' type="image" class="icon-size-sm margin-icons exercise_circle"src="data:image/jpg;base64,<?php echo base64_encode($exercise_list[$counter][1]); ?>"  alt=""/>
                                </div>
                            <?php $counter = $counter + 1; } ?>
                            <div class="center">
                                <img class="icon-size-xs margin-icons" src="../img/exercises/other.png" alt="">
                            </div>
                        </div>
                        <div class="flex-row space-around">
                            <?php
                            if (sizeof($exercise_list) > 17) {
                                while ($counter < sizeof($exercise_list)) { ?>
                                    <div class="center">
                                        <input id='<?php echo ($exercise_list[$counter][2])?>' type="image" class="icon-size-md margin-icons exercise_circle" src="data:image/jpg;base64,<?php echo base64_encode($exercise_list[$counter][1]); ?>" alt="">
                                    </div>
                                <?php $counter = $counter + 1; }
                            } ?>
                        </div>
                    </div>
                </div>
            <div class="container-translucent-form margin-top-bottom fade-in hidden margin-responsive" id="close_box" >
                <div class="add-workout-form">
                    <div class="margin-profile row-space-around-100" id="add-workout-header">
                    </div>
                    <form action="" method="POST" class="column-space-around-100">
                        <div class="margin-paragraph-container">
                            <label for="ExerciseStatus" class="headings-box-sm white margin-profile">Status</label>
                            <div class="row-space-around">
                                <div class="column-center">
                                    <input type="radio" name="status" value="Ongoing" required>
                                    <span class="margin-paragraph-container paragraph-box white center">Ongoing</span>
                                </div>
                                <div class="column-center">
                                    <input type="radio" name="status" value="Planned" required>
                                    <span class="margin-paragraph-container paragraph-box white center">Planned</span>
                                </div>
                                <div class="column-center">
                                    <input type="radio" name="status" value="Done" required>
                                    <span class="margin-paragraph-container paragraph-box white center">Done</span>
                                </div>
                            </div>
                        </div>
                        <div class="margin-paragraph-container">
                            <label for="ExercisePeople" class="headings-box-sm white margin-profile">People</label>
                            <div class="row-space-around">
                                <div class="column-center">
                                    <input type="radio" name="people" value="Solo" required>
                                    <span class="margin-paragraph-container paragraph-box white center">Solo</span>
                                </div>
                                <div class="column-center">
                                    <input type="radio" name="people" value="Duo" required>
                                    <span class="margin-paragraph-container paragraph-box white center">Duo</span>
                                </div>
                                <div class="column-center">
                                    <input type="radio" name="people" value="Group" required>
                                    <span class="margin-paragraph-container paragraph-box white center">Group</span>
                                </div>
                            </div>
                        </div>
                        <div class="margin-paragraph-container">
                            <label for="ExercisePlace" class="headings-box-sm white margin-profile">Location</label>
                            <div class="row-space-around">
                                <div class="column-center">
                                    <input type="radio" name="place" value="Home" required>
                                    <span class="margin-paragraph-container paragraph-box white center">Home</span>
                                </div>
                                <div class="column-center">
                                    <input type="radio" name="place" value="Gym" required>
                                    <span class="margin-paragraph-container paragraph-box white center">Gym</span>
                                </div>
                                <div class="column-center">
                                    <input type="radio" name="place" value="Outdoor" required>
                                    <span class="margin-paragraph-container paragraph-box white center">Outdoor</span>
                                </div>
                            </div>
                        </div>
                        <div class="column margin-paragraph-container">
                            <label for="ExerciseDateDone" class="headings-box-sm white margin-profile">Date</label>
                            <input type="date" class="input-field white" name="date_done" placeholder="06/06/2020" required />
                        </div>
                        <div class="column margin-paragraph-container">
                            <label for="ExerciseDateTime" class="headings-box-sm white margin-profile">Duration</label>
                            <input type="time" class="input-field white" name="total_time" required
                            />
                        </div>
                        <div class="margin-profile justify-end">
                            <button
                                    type="button"
                                    class="button-blue bold-paragraph-box"
                                    id="return_icon"
                            >
                                Cancel
                            </button>
                            <button
                                    type="submit"
                                    name="submit"
                                    class="button-green bold-paragraph-box margin-left"
                            >
                                + Workout
                            </button>
                        </div>
                    </form>
                </div>
            </div>
                <div class="container-translucent-activity center margin-top-bottom translate overflow-y scrollbar margin-responsive">
                    <div class="center padding-50">
                        <h2 class="title-box pink">Summary</h2>
                        <?php
                        echo "<span class='bold-paragraph-box gray margin-paragraph-container'>".date("l, ").date("d M")."</span>";
                        ?>
                    </div>
                    <div class="wrap-570">
                        <?php
                        if (isset($display_list)){ ?>
                            <?php while ($count_user < 10 && $count_user < count($display_list)) { ?>
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
        </div>
        <div class="flex-row center">
            <div class="container-translucent-health center margin-top-bottom translate">
                <div>
                    <h2 class="center title-box  blue margin-top-bottom">Health</h2>
                </div>
                <div class="row margin-profile">
                    <h5 class="center headings-box green margin-profile">BMI </h5>
                    <div class="flex-row center margin-profile">
                        <?php
                        echo "<span class='headings-box-sm white margin-profile-side'>".$bmi."</span>";
                        echo "<span class='paragraph-box white margin-profile-side'>".$output."</span>";
                        ?>
                    </div>
                </div>
                <div class="row margin-profile">
                    <h5 class="center headings-box green margin-profile">Ideal Weight</h5>
                    <div class="flex-row center margin-profile">
                        <?php
                        echo "<span class='headings-box-sm white'>".$ideal_weight." Kg</span>";
                        ?>
                    </div>
                </div>
                <div class="row margin-profile">
                    <h5 class="center headings-box green margin-profile">Move Goal</h5>
                    <div class="flex-row center margin-profile">
                        <?php
                        echo "<span class='paragraph-box white'>".$data['kcal_objective']." Kcal/Day</span>";
                        ?>
                    </div>
                </div>
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
