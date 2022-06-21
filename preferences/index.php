<?php
// load session.php that validates if the user is logged in
// if the user is not logged in, redirects to login page
require_once '../session.php';
// connects to the database 'fitnesspro'
include("../config.php");
include("../scripts/profile_upload.php");
include("../scripts/weight_add.php");
$data = getLoggedUserData($link);
$id = $data['id'];

// check if the user is the admin
if ($data['user_type'] == 'admin') {
    header('location: ../admin');
    exit();
}
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
        <link
                rel="stylesheet"
                href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" ></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
        <title>Preferences - Fitness.Pro</title>
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
            <div class="dropdown">
                <button class="btn" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false"><img class="menu-img" src="../img/navbar/menu.svg" alt="">
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    <div class="center"> </div>
                    <li><a class="dropdown-item mobile-menu" href="../home">Home</a></li>
                    <hr class="borderline mobile-menu">
                    <li><a class="dropdown-item" href="../profile">Profile</a></li>
                    <hr class="borderline">
                    <li><a class="dropdown-item" href="../activity">Activity</a></li>
                    <hr class="borderline">
                    <li><a class="dropdown-item" href="../end_session.php">Sign Out</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="flex-row space-around">
        <div class="container-translucent-preferences margin-top-bottom translate margin-responsive">
            <div>
                <h2 class="center title-box green margin-top-bottom margin-heading-container">Profile Photo</h2>
            </div>
            <div class="center padding-top-content">
                <div class="bold-paragraph-box white margin-activity center-text" id="file_name">
                    <span class="bold-paragraph-box white">No file selected</span>
                </div>
                <form class="center white" method="post" enctype="multipart/form-data">
                    <label for="file-upload" class="file-upload-button">
                        <span class="bold-paragraph-box margin-profile-side">Browse for a file</span>
                        <img src="../img/icons/search.svg" class="margin-profile-side">
                    </label>
                    <input class="padding-bottom width-center" id="file-upload" type="file" name="upload" accept=".png,.gif,.jpg,.webp" required>
                    <input class="button-blue bold-paragraph-box margin-top-bottom" type="submit" name="submit" value="Upload">
                </form>
            </div>
        </div>
        <div class="container-translucent-preferences margin-top-bottom translate margin-responsive">
            <div>
                <h2 class="center title-box green margin-top-bottom margin-heading-container">Weight Update</h2>
            </div>
            <form class="center padding-50" method="POST">
                        <input
                                type="number"
                                class="input-field"
                                id="exampleInputweight1"
                                name="weight"
                                placeholder="e.g. 75"
                                max="999"
                                required
                        />
                    <button
                            type="submit"
                            value="submit"
                            class="button-blue bold-paragraph-box margin-top-bottom"
                    >
                        Update
                    </button>
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
    <script src="./js/script.js"></script>
</html>
