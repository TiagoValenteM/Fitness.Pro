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
    <link rel="icon" type="imagem/png" href="favicon.ico" />
    <link rel="stylesheet" href="./style.css" />
    <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>
    <script src="js/script.js"></script>
    <title>Profile - Fitness.Pro</title>
</head>
<body class="background">
<nav class="navbar-design justify-between flex-row">
    <div class="flex-row margin-left">
        <h3 class="logo-style-admin">
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
<div class="flex-row">
    <div class="container-translucent-workouts margin-top-bottom space-around translate margin-responsive" id="open_box">
        <div class="center margin-heading-container">
            <h2 class="title-box blue">Workouts</h2>
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
            <div class="margin-profile row-space-around-100 column" id="add-workout-header">
            </div>
            <form method="POST" class="column-space-around-100" enctype="multipart/form-data">
                <div class="margin-profile justify-end column" id="actual_exercise">
                    <input type="text" name="exercise_type" class="input-field margin-profile" placeholder="Exercise Type">
                    <input type="text" name="kcal_hour" class="input-field margin-profile" placeholder="Kcal per Hour">
                    <input type="file" name="img_data" id="img_data" class="margin-profile hidden" accept=".png,.gif,.jpg,.webp">
                    <input type="file" class="margin-profile my-pond" accept=".png,.gif,.jpg,.webp">
                    <div class="flex-row">
                        <button
                                type="button"
                                class="button-return bold-paragraph-box"
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

                    <!-- include FilePond library -->
                    <script src="https://unpkg.com/filepond/dist/filepond.min.js"></script>

                    <!-- include FilePond jQuery adapter -->
                    <script src="https://unpkg.com/jquery-filepond/filepond.jquery.js"></script>

                    <script>
                        $(function(){

                            // Turn input element into a pond
                            $('.my-pond').filepond();

                            // Listen for addfile event
                            $('.my-pond').on('FilePond:addfile', function(e) {
                                console.log('file added event', e.detail.file);
                                $('#img_data').file(e.detail.file)
                                console.log($('#img_data').files)
                            });
                        });
                    </script>
                </div>
            </form>
            <form method="POST"  enctype="multipart/form-data">
            <button
                    type="submit"
                    name="delete"
                    class="button-green bold-paragraph-box margin-left"
            >
                Delete
            </button>
            </form>
        </div>
    </div>
    <div>
        <form class="column" method="POST" enctype="multipart/form-data">
            <input type="text" name="exercise_type" placeholder="Name the exercise" required>
            <input type="text" name="kcal_hour" placeholder="kcal per hour" required>
            <input type="file" name="img_data" accept=".png,.gif,.jpg,.webp" required>
            <input type="submit" name="new_workout" value="New Workout">
        </form>
    </div>
</div>

<footer class="padding-footer">
    <hr class="borderline">
    <div class="flex-row justify-around sm-footer">
        <h5 class="footer-text">Copyright © 2022    Fitness.Pro.    All rights reserved.</h5>
        <h5 class="footer-text">Portugal</h5>
    </div>
</footer>
</body>
</html>

