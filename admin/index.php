<?php
// load session.php that validates if the user is logged in
// if the user is not logged in, redirects to login page
require_once '../session.php';
// connects to the database 'fitnesspro'
include("../config.php");
include("../scripts/exercises_list.php");
include("../scripts/admin_dashboard.php");
$data = getLoggedUserData($link);
$id = $data['id'];

// check if the user is the admin
if ($data['user_type'] != 'admin') {
    header('location: ../home');
    exit();
}
// counter for exercise list available
$counter = 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="viewport-fit=cover, initial-scale=1.0" />
    <link rel="icon" type="imagem/png" href="../img/favicon.ico" />
    <link rel="stylesheet" href="./style.css" />
    <link rel="stylesheet" href="../global_style.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
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
        <div class="dropdown">
            <button class="btn" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false"><img class="menu-img" src="../img/navbar/menu_2.svg" alt="">
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                <div class="center"> </div>
                <li><a class="dropdown-item" href="../end_session.php">Sign Out</a></li>
            </ul>
        </div>
    </div>
</nav>
<div class="flex-row space-around margin-responsive">
    <div class="container-translucent-admin-workouts margin-top-bottom space-around translate margin-responsive" id="open_box">
        <div class="margin-heading-container wrap">
            <h2 class="title-box blue">Available Workouts</h2>
            <h4 class="bold-paragraph-box white margin-paragraph-container">(Click in an icon to update a workout)</h4>
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
    <div class="container-translucent-update-workout margin-top-bottom fade-in hidden margin-responsive relative" id="close_box" >
        <div class="margin-add-workout">
            <div class="margin-profile row-around-100" id="add-workout-header"></div>
            <div class="height_400">
                <form method="POST" class="margin-side-form" enctype="multipart/form-data">
                    <div class="margin-profile justify-end column-form" id="actual_exercise">
                        <input type="text" name="exercise_type" class="input-field margin-profile" placeholder="Exercise Type" required>
                        <input type="text" name="kcal_hour" class="input-field margin-profile" placeholder="Kcal per Hour" required>
                        <label for="file-update" class="file-upload-button">
                            <span class="bold-paragraph-box margin-profile-side">Browse for a file</span>
                            <img src="../img/icons/search.svg" class="margin-profile-side">
                        </label>
                        <input class="padding-bottom width-center" id="file-update" type="file" name="img_data" accept=".png,.gif,.jpg,.webp" required>
                        <div class="flex-row justify-end">
                            <button
                                    type="button"
                                    class="button-blue bold-paragraph-box"
                                    id="return_icon"
                            >
                                Cancel
                            </button>
                            <button
                                    type="submit"
                                    name="modify"
                                    class="button-green bold-paragraph-box margin-left"
                            >
                                Update
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <form method="POST" enctype="multipart/form-data">
                <button
                        type="submit"
                        name="delete"
                        class="button-pink bold-paragraph-box margin-left margin-top-left"
                >
                    Delete
                </button>
            </form>
        </div>
    </div>
    <div class="container-translucent-new-workout margin-top-bottom space-around translate margin-responsive">
        <div class="center margin-heading-container">
            <h2 class="title-box green">New Workout?</h2>
        </div>
        <div class="height_65 center">
                <form method="POST" class="margin-side-form" enctype="multipart/form-data">
                    <div class="margin-profile justify-end column-form" id="actual_exercise">
                        <input type="text" name="exercise_type" class="input-field margin-profile" placeholder="Exercise Type" required>
                        <input type="text" name="kcal_hour" class="input-field margin-profile" placeholder="kcal per Hour" required>
                        <label for="file-upload" class="file-upload-button">
                            <span class="bold-paragraph-box margin-profile-side">Browse for a file</span>
                            <img src="../img/icons/search.svg" class="margin-profile-side">
                        </label>
                        <input class="padding-bottom width-center" id="file-upload" type="file" name="img_data" accept=".png,.gif,.jpg,.webp" required>
                        <div class="flex-row justify-end">
                            <input type="submit" name="new_workout" class="button-blue bold-paragraph-box" value="New Workout">
                        </div>
                    </div>
                </form>
        </div>
    </div>
</div>
<footer class="padding-footer">
    <hr class="borderline">
    <div class="flex-row justify-around">
        <h5 class="footer-text">Copyright © 2022    Fitness.Pro.    All rights reserved.</h5>
        <h5 class="footer-text">Portugal</h5>
    </div>
</footer>
</body>
<script src="js/script.js"></script>
</html>

