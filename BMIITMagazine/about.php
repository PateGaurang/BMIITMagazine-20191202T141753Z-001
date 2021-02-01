<?php
session_start();
include './connection.php';
?>
<!DOCTYPE html>
<html lang="zxx" class="no-js">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="shortcut icon" href="img/fav.png">
        <meta name="author" content="colorlib">
        <link rel="icon" href="img/UTU_logo.png">
        <meta name="description" content="">
        <meta name="keywords" content="">
        <meta charset="UTF-8">
        <title>About Us</title>
        <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,400,300,500,600,700" rel="stylesheet">
        <link rel="stylesheet" href="css/linearicons.css">
        <link rel="stylesheet" href="css/font-awesome.min.css">
        <link rel="stylesheet" href="css/bootstrap.css">
        <link rel="stylesheet" href="css/magnific-popup.css">
        <link rel="stylesheet" href="css/nice-select.css">
        <link rel="stylesheet" href="css/animate.min.css">
        <link rel="stylesheet" href="css/owl.carousel.css">
        <link rel="stylesheet" href="css/jquery-ui.css">
        <link rel="stylesheet" href="css/main.css">
    </head>
    <body>
        <?php
        if (isset($_SESSION["usertype"])) {
            $type = $_SESSION["usertype"];
            if ($type == "Student") {
                include './studentMasterPage.php';
            } else if ($type == "Editor") {
                include './editorMaster.php';
            }
            else if($type=="Photographer"){
                include './photographerMaster.php';
            }
            else {
                include './userMaster.php';
            }
        } else {
            include './indexMaster.php';
        }
        ?>

        <div class="site-main-container">
            <section class="top-post-area pt-10">
                <div class="container no-padding">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="hero-nav-area">
                                <h1 class="text-white">About Us</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <section class="service-area section-gap">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="single-service d-flex flex-row">
                            <div class="icon">
                                <span class="lnr lnr-sun"></span>
                            </div>
                            <div class="details">
                                <a href="#">
                                    <h4>Platform</h4>
                                </a>
                                <p>
                                    Here at BMIIT, We belive in overall development and by this magazine we give students a platform to publish their thoughts to world.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="single-service d-flex flex-row">
                            <div class="icon">
                                <span class="lnr lnr-user"></span>
                            </div>
                            <div class="details">
                                <a href="#">
                                    <h4>User</h4>
                                </a>
                                <p>
                                    We develop a community where not only our students but anyone can participate in the magazine. 
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="single-service d-flex flex-row">
                            <div class="icon">
                                <span class="lnr lnr-book"></span>
                            </div>
                            <div class="details">
                                <a href="#">
                                    <h4>Information</h4>
                                </a>
                                <p>
                                    We provide a great platform to students where they can learn about different topics and trends through this magazine.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php
        include './footerMaster.php';
        ?>
    </body>
</html>