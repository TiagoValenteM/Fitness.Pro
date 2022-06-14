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
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="viewport-fit=cover, initial-scale=1.0" />
        <link rel="icon" type="imagem/png" href="favicon.ico" />
        <link rel="stylesheet" href="./style.css" />
        <link
                rel="stylesheet"
                href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        />
        <link
                rel="stylesheet"
                href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" ></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
        <script src="js/script.js"></script>
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
        <form method="post" enctype="multipart/form-data">
            <input type="file" name="upload" accept=".png,.gif,.jpg,.webp" required>
            <input class="uploadfield" type="submit" name="submit" value="Upload Image">
        </form>

    <div style="display: flex; flex-direction: column; padding-top: 20px">
        <form action="" method="POST">
            <div class="form-group margin-top-sm">
                <div class="form-group">
                    <label for="exampleInputWeight1">Weight</label>
                    <input
                            type="number"
                            class="input-field"
                            id="exampleInputweight1"
                            name="weight"
                            placeholder="e.g. 75"
                            max="999"
                            required
                    />
                </div>
            </div>
            <div class="justify-right">
                <button
                        type="submit"
                        value="submit"
                        class="button-green button-text margin-top-sm"
                >
                    submit
                </button>
            </div>
        </form>
    </div>
    </body>
