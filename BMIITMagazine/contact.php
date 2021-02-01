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
        <title>Contact us</title>
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
            } else if ($type == "Photographer") {
                include './photographerMaster.php';
            } else {
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
                                <h1 class="text-white">Contact Us</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="contact-page-area pt-50 pb-120">
                <div class="container">
                    <div class="row contact-wrap">
                        <div class="map-wrap" style="width:400; height: 500px;" id="map">
                            <h1>Where To Find Us</h1><br>
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3723.1303458888333!2d73.12830361493327!3d21.067455585977406!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be060e06f076ecd%3A0xbc46d6b548d42a5f!2sBMIIT!5e0!3m2!1sen!2sin!4v1557229522515!5m2!1sen!2sin" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
                        </div>
                        <div class="col-lg-5 d-flex flex-column address-wrap">
                            <h1>Details</h1>
                            <br>
                            <div class="single-contact-address d-flex flex-row">
                                <div class="icon">
                                    <span class="lnr lnr-apartment"></span>
                                </div>
                                <div class="contact-details">
                                    <h5>Babu Madhav Institute Of Information Technology,</h5>
                                    <p>
                                        Maliba Campus,Gopal Vidyanagar, Bardoli Mahuva Road, Tarsadi. 
                                    </p>
                                </div>
                            </div>
                            <div class="single-contact-address d-flex flex-row">
                                <div class="icon">
                                    <span class="lnr lnr-phone-handset"></span>
                                </div>
                                <div class="contact-details">
                                    <h5>+91 2622 290562 </h5>
                                    <p>  Mr. Sapan Naik, 9586113399</p>
                                </div>
                            </div>
                            <div class="single-contact-address d-flex flex-row">
                                <div class="icon">
                                    <span class="lnr lnr-envelope"></span>
                                </div>
                                <div class="contact-details">
                                    <h5>support@bmiitchronicles.com</h5>
                                    <p>Send us your query</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
<?php
include './footerMaster.php';
?>
    </body>
</html>