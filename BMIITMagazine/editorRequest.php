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
                <title>Editor Committee Request</title>
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
                if (isset($_POST["btnApprove"])) {
                    $contactNo = $_GET["sid"];
                    $query = "update tblstudent set isEditor=1 where contactNo=$contactNo";
                    $con->query($query);
                }
                if (isset($_POST["btnReject"])) {
                    $contactNo = $_GET["sid"];
                    $query = "update tblstudent set isEditor=0 where contactNo=$contactNo";
                    $con->query($query);
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
                                <h2>Editor Request</h2>
                                <?php
                                $query = "select * from tblstudent where isEditor=2";
                                $result = $con->query($query);
                                if ($result->num_rows > 0) {
                                    echo "<table class='table table-hover'>";
                                    echo "<tr>";
                                    echo "<th>Name</th>";
                                    echo "<th>Contact Number</th>";
                                    echo "<th>Email</th>";
                                    echo "<th></th>";
                                    echo "</tr>";
                                    while ($row = $result->fetch_array()) {
                                        $contactNo = $row["contactNo"];
                                        $authorName = $row["fname"] . " " . $row["lname"];
                                        $email = $row["email"];
                                        echo "<tr>";
                                        echo "<td>$authorName</td>";
                                        echo "<td>$contactNo</td>";
                                        echo "<td>$email</td>";
                                        echo "<td>";
                                        echo "<form action='" . $_SERVER["PHP_SELF"] . "?sid=" . $row["contactNo"] . "' method='post'>";
                                        echo "<button type='submit' class='prev' name='btnApprove'>Approve</button>&nbsp;&nbsp;";
                                        echo "<button type='submit' class='next' name='btnReject'>Reject</button>";
                                        echo "</form>";
                                        echo "</form>";
                                        echo "</td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<p>Sorry no more student request avalible</p>";
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