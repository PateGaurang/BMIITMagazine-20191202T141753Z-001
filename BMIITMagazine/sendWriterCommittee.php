<?php
session_start();
require_once 'connection.php';
?>
<?php
if (isset($_SESSION["username"]) && isset($_SESSION["usertype"])) {
    $usertype = $_SESSION["usertype"];
    if ($usertype == "Student" || $usertype == "Editor") {
        ?> 
        <!DOCTYPE html>
        <html>
            <head>
                <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
                <link rel="shortcut icon" href="img/fav.png">
                <meta name="author" content="BMIIT">
                <link rel="icon" href="img/UTU_logo.png">
                <meta name="description" content="">
                <meta name="keywords" content="">
                <meta charset="UTF-8">
                <title>Writer Committee join request</title>
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
                $flag = FALSE;
                $success = FALSE;
                $query = "select * from tblstudent where isEditor=2 and contactNo=" . $_SESSION["username"];
                $result = $con->query($query);
                if ($result->num_rows > 0) {
                    $flag = TRUE;
                }
                $isExtra = "y";
                $fileName = $tempName = $type = $filePath = "";
                $titleErr = $keywordErr = $coverImageErr = $articleTextErr = "";
                if (isset($_POST["btnSubmit"])) {
                    $query = "update tblstudent set isEditor=2 where contactNo=" . $_SESSION["username"];
                    if ($con->query($query)) {
                        $query = "select * from tblnotification where type=4";
                        $result = $con->query($query);
                        if ($result->num_rows == 0) {
                            $query = "insert into tblnotification(text,isReaded,otherData,type) value('Student request to join writer committee',0,'editorRequest.php',4)";
                            $con->query($query);
                        }
                        $flag = TRUE;
                        $success = TRUE;
                    }
                }
                if (isset($_POST["btnCancel"])) {
                    header("location: studentHome.php");
                }
                ?>
                <?php
                if ($usertype == "Student") {
                    require 'studentMasterPage.php';
                } else if ($usertype == "Editor") {
                    require './editorMaster.php';
                }
                ?>
                <?php
                if (!$flag) {
                    ?>
                    <div class="site-main-container">
                        <section class="contact-page-area pt-50 pb-120">
                            <div class="container">
                                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
                                    <div class="row contact-wrap">
                                        <div class="col-lg-5 col-5 col-sm-5 col-md-5"></div>
                                        <div class="col-lg-4 col-4 col-sm-4 col-md-4">
                                            <h2>Writer Committee</h2>
                                        </div>
                                    </div>
                                    <div class="row contact-wrap">
                                        <div class="col-4 col-sm-4 col-md-4 col-lg-4 col-xl-4"></div>
                                        <div class="col-5 col-sm-5 col-md-5 col-lg-5 col-xl-5">
                                            <center>
                                                <h5>Do you want join writer committee then apply here</h5>
                                            </center>
                                        </div>
                                    </div>
                                    <div class="row contact-wrap">
                                        <div class="col-5 col-sm-5 col-md-5 col-lg-5 col-xl-5"></div>
                                        <div class="col-2 col-sm-2 col-md-2 col-lg-2 col-xl-2">
                                            <input type="submit" name="btnSubmit" value="Apply" class="btn primaryBtn">
                                        </div>
                                        <div class="col-2 col-sm-2 col-md-2 col-lg-2 col-xl-2">
                                            <input type="submit" name="btnCancel" value="Cancel" class="btn primaryBtn">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </section>
                    </div>
                    <?php
                } else {
                    ?>
                    <div class="site-main-container">
                        <section class="contact-page-area pt-50 pb-120">
                            <div class="container">
                                <div class="row contact-wrap">

                                    <?php
                                    if ($success) {
                                        ?>
                                        <div class="alert alert-success alert-dismissible">
                                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                                            <strong>Success!</strong> Your request has been submited.
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </div>
                                <div class="row contact-wrap">
                                    <div class="col-3 col-sm-3 col-md-3 col-lg-3 col-xl-3"></div>
                                    <div class="col-7 col-sm-7 col-md-7 col-lg-7 col-xl-7">
                                        <h5>Please wait for admin to give response, it can take upto 2-3 days</h5>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                    <?php
                }
                include './footerMaster.php';
                ?>
            </body>
        </html>
        <?php
    }
} else {
    header("location: index.php");
}
ob_end_flush();

