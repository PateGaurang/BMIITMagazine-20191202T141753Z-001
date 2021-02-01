<?php
session_start();
include './connection.php';
if (isset($_SESSION["username"]) || isset($_SESSION["usertype"])) {
    $usertype = $_SESSION["usertype"];
    if ($usertype == "Admin") {
        if (isset($_GET["id"])) {
            ?> 
            <!DOCTYPE html>

            <html class="no-js" lang="en">

                <head>
                    <meta charset="utf-8">
                    <meta http-equiv="X-UA-Compatible" content="IE=edge">
                    <title>Update Issue</title>
                    <meta name="description" content="Sufee Admin - HTML5 Admin Template">
                    <meta name="viewport" content="width=device-width, initial-scale=1">
                    <link rel="icon" href="img/UTU_logo.png">

                    <link rel="apple-touch-icon" href="apple-icon.png">
                    <link rel="shortcut icon" href="favicon.ico">

                    <link rel="stylesheet" href="vendors/bootstrap/dist/css/bootstrap.min.css">
                    <link rel="stylesheet" href="vendors/font-awesome/css/font-awesome.min.css">
                    <link rel="stylesheet" href="vendors/themify-icons/css/themify-icons.css">
                    <link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css">
                    <link rel="stylesheet" href="vendors/selectFX/css/cs-skin-elastic.css">
                    <link rel="stylesheet" href="vendors/jqvmap/dist/jqvmap.min.css">


                    <link rel="stylesheet" href="assets/css/style.css">

                    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
                </head>

                <body>
                    <?php
                        $id=$_GET["id"];
                        $query="select * from tblmagazineissues where id=$id";
                        $result=$con->query($query);
                        $row=$result->fetch_array();
                        $title=$row["title"];
                        $date= date("Y-m-d");
                        $imgPath=$row["coverImage"];
                        if(isset($_POST["btnCancel"])){
                            header("location: manageIssue.php");
                        }
                        if(isset($_POST["btnSubmit"])){
                            $title=$_POST["title"];
                            if(!empty($_FILES["coverImage"]["name"])){
                                $fileName=$_FILES["coverImage"]["name"];
                                $tempName=$_FILES["coverImage"]["tmp_name"];
                                $filePath = "./uploads/issueCovers/" . $id . "/";
                                move_uploaded_file($tempName, $filePath.$fileName);
                                $query="update tblmagazineissues set title='$title',lastModification='$date',coverImage='$filePath$fileName' where id=$id";
                            }
                            else{
                                $query="update tblmagazineissues set title='$title',lastModification='$date' where id=$id";
                            }
                            if($con->query($query)){
                                header("location: manageIssue.php");
                            }
                        }
                    ?>
                    <?php
                    include './adminMaster.php';
                    ?>
                    <div id="right-panel" class="right-panel">
                        <?php
                        include './adminMenu.php';
                        ?>
                        <div id="content">
                            <div class="container">
                                <center>
                                    <h2>Article Request</h2><br><br>
                                    <form action="#" method="post" enctype="multipart/form-data">
                                        <div class="row mb-3">
                                            <div class="col-2 col-sm-2 col-md-2 col-lg-2 col-xl-2">
                                                <label for="title" class="form-text float-lg-right">Title:</label>
                                            </div>
                                            <div class="col-8 col-sm-8 col-md-8 col-lg-8 col-xl-8">
                                                <input type="text" name="title" placeholder="Issue Title" value="<?php echo $title; ?>" class="form-control" required="true">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-2 col-sm-2 col-md-2 col-lg-2 col-xl-2">
                                                <label for="Keyword" class="form-text float-lg-right">Old Image:</label>
                                            </div>
                                            <div class="col-8 col-sm-8 col-md-8 col-lg-8 col-xl-8">
                                                <img src="<?php echo "$imgPath"; ?>">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-2 col-sm-2 col-md-2 col-lg-2 col-xl-2">
                                                <label for="title" class="form-text float-lg-right">New Cover Image:</label>
                                            </div>
                                            <div class="col-8 col-sm-8 col-md-8 col-lg-8 col-xl-8">
                                                <input type="file" name="coverImage" class="form-control-file">
                                            </div>
                                        </div>
                                        <div class="row contact-wrap">
                                            <div class="col-4 col-sm-4 col-md-4 col-lg-4 col-xl-4"></div>
                                            <div class="col-2 col-sm-2 col-md-2 col-lg-2 col-xl-2">
                                                <input type="submit" name="btnSubmit" value="Update Issue" class="btn btn-primary">
                                            </div>
                                            <div class="col-2 col-sm-2 col-md-2 col-lg-2 col-xl-2">
                                                <input type="submit" name="btnCancel" value="Cancel" class="btn btn-primary">
                                            </div>
                                        </div>
                                    </form>
                                </center>
                            </div>
                        </div>
                    </div>
                    <script src="vendors/jquery/dist/jquery.min.js"></script>
                    <script src="vendors/popper.js/dist/umd/popper.min.js"></script>
                    <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
                    <script src="assets/js/main.js"></script>


                    <script src="vendors/chart.js/dist/Chart.bundle.min.js"></script>
                    <script src="assets/js/dashboard.js"></script>
                    <script src="assets/js/widgets.js"></script>
                    <script src="vendors/jqvmap/dist/jquery.vmap.min.js"></script>
                    <script src="vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
                    <script src="vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
                </body>

            </html>

            <?php
        } else {
            header("location: index.php");
        }
    } else {
        header("location: index.php");
    }
} else {
    header("location: index.php");
}