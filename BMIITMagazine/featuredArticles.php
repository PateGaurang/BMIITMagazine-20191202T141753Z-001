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
                <title>Manage Featured Articles</title>
                <meta name="description" content="Sufee Admin - HTML5 Admin Template">
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <link rel="icon" href="img/UTU_logo.png">

                <link rel="apple-touch-icon" href="apple-icon.png">
                <link rel="shortcut icon" href="favicon.ico">
                <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
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
                                <h2>Featured Articles</h2>
                                <?php
                                $query = "select * from tblarticles where isFeatured in(1,2,3,4) order by isFeatured";
                                $result = $con->query($query);
                                echo "<table class='table table-bordered'>";
                                echo "<thead class='table-dark'><tr>";
                                echo "<th>Title</th>";
                                echo "<th>Keyword</th>";
                                echo "<th>Cover Image</th>";
                                echo "<th>Position</th>";
                                echo "<th></th>";
                                echo "<th></th>";
                                echo "</tr></thead><tbody>";
                                while ($row = $result->fetch_array()) {
                                    $isFeatured = $row["isFeatured"];
                                    echo "<tr>";
                                    echo "<td>" . $row["title"] . "</td>";
                                    echo "<td>" . $row["keyword"] . "</td>";
                                    echo "<td><img src='" . $row["coverImage"] . "' style='height:70px; width:100px;'></td>";
                                    echo "<td>" . $isFeatured . "</td>";
                                    echo "<td>";
                                    echo "<form action='switchFeatured.php?current=$isFeatured' method='post'>";
                                    echo "<select name='newPosition'>";
                                    for ($i = 1; $i <= 4; $i++) {
                                        if ($isFeatured == $i) {
                                            echo "<option selected='true'>$i</option>";
                                        } else {
                                            echo "<option>$i</option>";
                                        }
                                    }
                                    echo "</select>";
                                    echo "&nbsp;&nbsp;&nbsp;<input type='submit' name='btnSubmit' value='switch' class='btn btn-primary'>";
                                    echo "</form>";
                                    echo "</td>";
                                    echo "<td><a href='#' class='btn btn-danger'>Remove</a></td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";
                                echo "</table>";
                                ?>
                                <h2>Other Articles</h2>
                                <?php
                                $query = "select * from tblarticles where isFeatured=0 and isApproved=1";
                                $result = $con->query($query);
                                echo "<table class='table table-bordered' id='dataTable'>";
                                echo "<thead class='table-dark'><tr>";
                                echo "<th>Title</th>";
                                echo "<th>Keyword</th>";
                                echo "<th>Cover Image</th>";
                                echo "<th></th>";
                                echo "</tr></thead><tbody>";
                                while ($row = $result->fetch_array()) {
                                    echo "<tr>";
                                    echo "<td>" . $row["title"] . "</td>";
                                    echo "<td>" . $row["keyword"] . "</td>";
                                    echo "<td><img src='" . $row["coverImage"] . "' style='height:70px; width:100px;'></td>";
                                    echo "<td>";
                                    echo "<form action='switchFeatured.php?id=" . $row["id"] . "' method='post'>";
                                    echo "<select name='newPos'>";
                                    for ($i = 1; $i <= 4; $i++) {
                                        echo "<option>$i</option>";
                                    }
                                    echo "</select>";
                                    echo "&nbsp;&nbsp;&nbsp;<input type='submit' name='btnAdd' value='Add' class='btn btn-primary'>";
                                    echo "</form>";
                                    echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";
                                echo "</table>";
                                ?>
                            </center>
                        </div>
                    </div>
                </div>
                <script src="vendors/jquery/dist/jquery.min.js"></script>
                <script src="vendors/popper.js/dist/umd/popper.min.js"></script>
                <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
                <script src="assets/js/main.js"></script>
                <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>

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