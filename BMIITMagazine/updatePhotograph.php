<?php
session_start();
include './connection.php';
if (isset($_SESSION["username"]) && isset($_SESSION["usertype"]) && isset($_GET["id"])) {
    $usertype = $_SESSION["usertype"];
    if ($usertype == "Photographer") {
        ?>   
        <!DOCTYPE html>
        <html lang="zxx" class="no-js">
            <head>
                <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
                <link rel="shortcut icon" href="img/fav.png">
                <meta name="author" content="colorlib">
                <meta name="description" content="">
                <meta name="keywords" content="">
                <link rel="icon" href="img/UTU_logo.png">
                <meta charset="UTF-8">
                <title>Update Photograph</title>
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
                $id = $_GET["id"];
                $query = "select * from tblphotographs where id=$id";
                $result = $con->query($query);
                $row = $result->fetch_array();
                $title = $row["title"];
                $coverImage = $row["coverImage"];
                $titleErr = "";
                $flag = TRUE;
                if (isset($_POST["btnSubmit"])) {
                    $title = $_POST["title"];
                    if (empty($title)) {
                        $titleErr = "Please Enter a Title for photograph";
                        $flag = FALSE;
                    }
                    if ($flag) {
                        $query = "update tblphotographs set title='$title' where id=$id";
                        if ($con->query($query)) {
                            header("location: photographHistory.php");
                        }
                    }
                }
                if (isset($_POST["btnCancel"])) {
                    
                }
                ?>
                <?php
                include './photographerMaster.php';
                ?>
                <div class="site-main-container">
                    <section class="contact-page-area pt-50 pb-120">
                        <div class="container">
                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>?id=<?php echo $_GET["id"]; ?>" method="post" enctype="multipart/form-data">
                                <div class="row contact-wrap">
                                    <div class="col-lg-5 col-5 col-sm-5 col-md-5"></div>
                                    <div class="col-lg-4 col-4 col-sm-4 col-md-4">
                                        <h2>Update Photograph</h2>
                                    </div>
                                </div>
                                <div class="row contact-wrap">
                                    <div class="col-2 col-sm-2 col-md-2 col-lg-2 col-xl-2">
                                        <label for="title" class="form-text float-lg-right">Title:</label>
                                    </div>
                                    <div class="col-8 col-sm-8 col-md-8 col-lg-8 col-xl-8">
                                        <input type="text" name="title" placeholder="Article Title" value="<?php echo $title; ?>" class="form-control">
                                        <?php
                                        if ($titleErr != "") {
                                            echo "<br><span class='errorColor'>$titleErr</span>";
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="row contact-wrap">
                                    <div class="col-2 col-sm-2 col-md-2 col-lg-2 col-xl-2">
                                        <label for="title" class="form-text float-lg-right">Old Cover Image:</label>
                                    </div>
                                    <div class="col-8 col-sm-8 col-md-8 col-lg-8 col-xl-8">
                                        <img src="<?php echo $coverImage; ?>" style="width: 700px;">
                                    </div>
                                </div>
                                <div class="row contact-wrap">
                                    <div class="col-4 col-sm-4 col-md-4 col-lg-4 col-xl-4"></div>
                                    <div class="col-2 col-sm-2 col-md-2 col-lg-2 col-xl-2">
                                        <input type="submit" name="btnSubmit" value="Update Photograph" class="btn primaryBtn">
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
                include './footerMaster.php';
                ?>
            </body>
        </html>
        <?php
    }
} else {
    header("Location: index.php");
}