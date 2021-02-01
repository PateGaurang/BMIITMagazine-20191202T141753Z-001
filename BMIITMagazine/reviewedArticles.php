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
                <title>Reviewed Articles</title>
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
                include './adminMaster.php';
                ?>
                <div id="right-panel" class="right-panel">
                    <?php
                    include './adminMenu.php';
                    ?>
                    <div id="content">
                        <div class="container">
                            <center>
                                <h2>Reviewed Articles</h2><br><br>
                                <?php
                                $query = "select * from tblarticles where isApproved=9";
                                $result = $con->query($query);
                                if ($result->num_rows > 0) {
                                    echo "<table class='table table-hover'>";
                                    echo "<tr>";
                                    echo "<th>Title</th>";
                                    echo "<th>Keyword</th>";
                                    echo "<th>Publisher</th>";
                                    echo "<th>Cover Image</th>";
                                    echo "<th>Editor Comment</th>";
                                    echo "<th></th>";
                                    echo "</tr>";
                                    while ($row = $result->fetch_array()) {
                                        $contactNo = $row["studentId"];
                                        $query = "select * from tblstudent where contactNo=$contactNo";
                                        $result2 = $con->query($query);
                                        $row1 = $result2->fetch_array();
                                        $authorName = $row1["fname"] . " " . $row1["lname"];
                                        echo "<tr>";
                                        echo "<td>" . $row["title"] . "</td>";
                                        echo "<td>" . $row["keyword"] . "</td>";
                                        echo "<td>$authorName</td>";
                                        echo "<td><img src='" . $row["coverImage"] . "' style='height:70px; width:100px;'></td>";
                                        echo "<td>".$row["editorComment"]."</td>";
                                        echo "<td><form action='reviewedToggle.php?articleId=".$row["id"]."' method='post'><button class='btn btn-success' type='submit' name='btnApprove'><i class='fa fa-check'></i></button>&nbsp;<button class='btn btn-danger' type='submit' name='btnReject'><i class='fa fa-close'></i></button></form></td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<p>Sorry no more articles</p>";
                                }
                                ?>
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
    }
} else {
    header("Location: index.php");
}