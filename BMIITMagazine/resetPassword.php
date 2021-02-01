<?php
require_once 'connection.php';
?>
<?php
if (isset($_GET["username"]) && isset($_GET["type"])) {
    $username = $_GET["username"];
    $type = $_GET["type"];
    ?> 
    <!DOCTYPE html>
    <html>
        <head>
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
            <link rel="shortcut icon" href="img/fav.png">
            <meta name="author" content="BMIIT">
            <meta name="description" content="">
            <meta name="keywords" content="">
            <link rel="icon" href="img/UTU_logo.png">
            <meta charset="UTF-8">
            <title>Reset Password</title>
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
            <script src="js/jquery-3.1.1.min.js"></script>
        </head>
        <body>
            <?php
            if (isset($_POST["btnSubmit"])) {
                if ($type == 1) {
                    $query = "update tblstudent set password=SHA1('$newPassword') where contactNo=$username";
                } else if ($type == 2) {
                    $query = "update tbluser set password=SHA1('$newPassword') where contactNo=$username";
                }
                if ($con->query($query)) {
                    header("location: index.php?success=true");
                } else {
                    header("location: index.php?success=false");
                }
            }
            ?>
            <?php
            include './indexMaster.php';
            ?>
            <script>
                $(document).ready(function () {
                    $("#resetPassword").validate({
                        errorLabelContainer: ".error",
                        rules: {
                            title: {
                                required: true,
                                minlength: 5
                            },
                            conPassword: {
                                required: true,
                                minlength: 5,
                                equalTo: "#newPassword"
                            }
                        },
                        messages: {
                            newPassword: {
                                required: "Please Enter your password",
                                minlength: "Password must contain aleast 5 characters"
                            },
                            conPassword: {
                                required: "Please Enter your password",
                                minlength: "Password must contain aleast 5 characters",
                                equalTo: "Password and Confirm password must be same"
                            }
                        },
                        submitHandler: function (form) {
                            form.submit();
                        }
                    });
                });
            </script>
            <div class="site-main-container">
                <section class="contact-page-area pt-50 pb-120">
                    <div class="container">
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>?username=<?php echo $username; ?>&type=<?php echo $type; ?>" method="post" id="resetPassword">
                            <div class="row contact-wrap">
                                <div class="col-lg-5 col-5 col-sm-5 col-md-5"></div>
                                <div class="col-lg-4 col-4 col-sm-4 col-md-4">
                                    <h2>Reset Password</h2>
                                </div>
                            </div>
                            <div class="row contact-wrap">
                                <div class="col-2 col-sm-2 col-md-2 col-lg-2 col-xl-2">
                                    <label for="newPassword" class="form-text float-lg-right">New Password:</label>
                                </div>
                                <div class="col-8 col-sm-8 col-md-8 col-lg-8 col-xl-8">
                                    <input type="password" id="newPassword" name="newPassword" placeholder="New Password" class="form-control" required="true">
                                </div>
                            </div>
                            <div class="row contact-wrap">
                                <div class="col-2 col-sm-2 col-md-2 col-lg-2 col-xl-2">
                                    <label for="conPassword" class="form-text float-lg-right">Confirm Password:</label>
                                </div>
                                <div class="col-8 col-sm-8 col-md-8 col-lg-8 col-xl-8">
                                    <input type="password" id="conPassword" name="conPassword" placeholder="Confirm Password" class="form-control" required="true">
                                </div>
                            </div>
                            <div class="row contact-wrap">
                                <div class="col-4 col-sm-4 col-md-4 col-lg-4 col-xl-4"></div>
                                <div class="col-2 col-sm-2 col-md-2 col-lg-2 col-xl-2">
                                    <input type="submit" name="btnSubmit" value="Reset Password" class="btn primaryBtn">
                                </div>
                            </div>
                        </form>
                    </div>
                </section>
            </div>
            <?php
            include './footerMaster.php';
            ?>
        </body>
    </html>
    <?php
} else {
    header("location: index.php");
}
ob_end_flush();

