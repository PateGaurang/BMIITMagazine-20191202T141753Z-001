<?php
session_start();
require_once 'connection.php';
?>
<?php
if (isset($_SESSION["username"]) && isset($_SESSION["usertype"])) {
    $usertype = $_SESSION["usertype"];
    //echo $_SESSION["username"];
    if ($usertype == "Student" || $usertype == "Editor" || $usertype == "Photographer") {
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
                <title>Article History</title>
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
                <script>
                    $(document).ready(function () {
                        $("#dataTable").DataTable();
                    });
                </script>

            </head>
            <body>
                <?php
                if ($usertype == "Student") {
                    require 'studentMasterPage.php';
                } else if ($usertype == "Editor") {
                    require './editorMaster.php';
                } else {
                    require './photographerMaster.php';
                }
                ?>
                <div class="site-main-container">
                    <section class="contact-page-area pt-50 pb-120">
                        <div class="container">
                            <div class="row contact-wrap">
                                <div class="col-lg-5 col-5 col-sm-5 col-md-5"></div>
                                <div class="col-lg-4 col-4 col-sm-4 col-md-4">
                                    <h2>Article History</h2>
                                </div>
                            </div>

                            <?php
                            $query = "select * from tblarticles where studentId=" . $_SESSION["username"];
                            $result = $con->query($query);
                            if ($result->num_rows != 0) {
                                ?>
                                <div class="row contact-wrap">
                                    <table class="table table-hover" id="dataTable">
                                        <tr>
                                            <th>Title</th>
                                            <th>Published Date</th>
                                            <th>Cover Image</th>
                                            <th>Editor Comment</th>
                                            <th>Status</th>
                                            <th></th>
                                        </tr>
                                        <?php
                                        while ($row = $result->fetch_array()) {
                                            $temp = $row["isApproved"];
                                            if ($temp == 1) {
                                                $status = "Approved";
                                            } else if ($temp == 2) {
                                                $status = "Suggested change";
                                            } else {
                                                $status = "Review Pendding";
                                            }
                                            ?>
                                            <tr>
                                                <td><?php echo $row["title"]; ?></td>
                                                <td><?php echo $row["publishingDate"]; ?></td>
                                                <td><img src='<?php echo $row["coverImage"]; ?>' style='height:70px; width:100px;'></td>
                                                <td><?php echo $row["editorComment"]; ?></td>
                                                <td><?php echo $status; ?></td>
                                                <td><a href="updateArticle.php?id=<?php echo $row["id"]; ?>"><i class="fa fa-edit" style="font-size: 24px; margin-top: 15px; color:#f6214b;"></i></a></td>
                                            </tr>
                                        <?php } ?>
                                    </table>
                                </div>
                                <?php
                            } else {
                                ?>
                                <div class="row contact-wrap">
                                    <div class="col-lg-4 col-4 col-sm-4 col-md-4"></div>
                                    <div class="col-lg-6 col-6 col-sm-6 col-md-6">
                                        <h4>When you upload articles it will appear here</h4>
                                    </div>
                                </div>
                                <?php
                            }
                            ?>
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
    header("location: index.php");
}

