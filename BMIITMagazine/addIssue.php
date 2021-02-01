<?php
session_start();
include './connection.php';
if (isset($_SESSION["username"]) || isset($_SESSION["usertype"])) {
    $usertype = $_SESSION["usertype"];
    if ($usertype == "Admin") {
        ?> 
        <!DOCTYPE html>

        <html class="no-js" lang="en">

            <head>
                <meta charset="utf-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <title>Add Magazine Issue</title>
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
                $success = FALSE;
                $flag = TRUE;
                $titleErr = $coverImageErr = $title = "";
                if (isset($_POST["btnCancel"])) {
                    header("location: adminHome.php");
                }
                if (isset($_POST["btnSubmit"])) {
                    $title = $_POST["title"];
                    if (empty($title)) {
                        $titleErr = "Pleaase enter title for issue";
                        $flag = FALSE;
                    }
                    if (!empty($_FILES["coverImage"]["name"])) {
                        $fileName = $_FILES["coverImage"]["name"];
                        $tempName = $_FILES["coverImage"]["tmp_name"];
                        $type=$_FILES["coverImage"]["type"];
                        if($type == "image/png" || $type == "image/jpg" || $type == "image/jpeg"){
                            
                        }
                        else{
                            $coverImageErr="Only .jpg .gif or .png are allowed";
                            $flag=FALSE;
                        }
                    } else {
                        $flag = FALSE;
                        $coverImageErr = "Please upload a cover image for issue";
                    }
                    $isAct = $_POST["isActive"];
                    if ($isAct == "y") {
                        $isActive = 1;
                    } else {
                        $isActive = 0;
                    }
                    $date = date("Y-m-d");
                    if ($flag) {
                        $query = "insert into tblmagazineissues(creationDate,title,isCurrentIssue,lastModification) values('$date','$title',$isActive,'$date')";
                        //echo $query;
                        if ($con->query($query)) {
                            $lastId = $con->insert_id;
                            $filePath = "./uploads/issueCovers/" . $lastId . "/";
                            if (!file_exists($filePath)) {
                                mkdir($filePath, 0777, TRUE);
                            }
                            move_uploaded_file($tempName, $filePath . $fileName);
                            $query = "update tblmagazineissues set coverImage='$filePath$fileName' where id=$lastId";
                            $con->query($query);
                            if ($isActive == 1) {
                                $query = "update tblmagazineissues set isCurrentIssue=0 where id!=$lastId";
                                $con->query($query);
                                $_SESSION["issueId"] = $lastId;
                                $success = TRUE;
                            }
                        }
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
                        <?php
                        if ($success) {
                            ?>
                            <div class="alert alert-success alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                Issue Successfully Added
                            </div>
                            <?php
                        }
                        ?>
                        <center>
                            <h3>Add New Issue</h3><br><br>
                            <form action="#" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-1 col-sm-1 col-md-1 col-lg-1 col-xl-1"></div>
                                    <div class="col-2 col-sm-2 col-md-2 col-lg-2 col-xl-2">
                                        <label for="title" style="margin-top:8px;">Issue Title:</label>
                                    </div>
                                    <div class="col-8 col-sm-8 col-md-8 col-lg-8 col-xl-8">
                                        <input type="text" class="form-control" name="title" placeholder="Issue Title" value="<?php echo $title; ?>">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-3 col-sm-3 col-md-3 col-lg-3 col-xl-3"></div>
                                    <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                        <span style="color: red;"><?php echo $titleErr; ?></span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-1 col-sm-1 col-md-1 col-lg-1 col-xl-1"></div>
                                    <div class="col-2 col-sm-2 col-md-2 col-lg-2 col-xl-2">
                                        <br>
                                        <label for="title" style="margin-top:6px;">Cover Image:</label>
                                    </div>
                                    <div class="col-8 col-sm-8 col-md-8 col-lg-8 col-xl-8">
                                        <br>
                                        <input type="file" class="form-control-file" name="coverImage">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-3 col-sm-3 col-md-3 col-lg-3 col-xl-3"></div>
                                    <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                        <span style="color: red;"><?php echo $coverImageErr; ?></span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-1 col-sm-1 col-md-1 col-lg-1 col-xl-1"></div>
                                    <div class="col-2 col-sm-2 col-md-2 col-lg-2 col-xl-2">
                                        <br>
                                        <label for="title" style="margin-top:8px;">Active Issue:</label>
                                    </div>
                                    <div class="col-8 col-sm-8 col-md-8 col-lg-8 col-xl-8">
                                        <br>
                                        <select class="form-control" name="isActive">
                                            <option value="y">Yes</option>
                                            <option value="n">No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4 col-sm-4 col-md-4 col-lg-4 col-xl-4"></div>
                                    <div class="col-4 col-sm-4 col-md-4 col-lg-4 col-xl-4">
                                        <br>
                                        <input type="submit" name="btnSubmit" value="Add Article" class="btn btn-primary">
                                        <input type="submit" name="btnCancel" value="Cancel" class="btn btn-primary">
                                    </div>
                                </div>
                            </form>
                        </center>
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
    }
} else {
    header("Location: index.php");
}