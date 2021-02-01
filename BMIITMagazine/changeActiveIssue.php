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
                <title>Change Active Issue</title>
                <link rel="icon" href="img/UTU_logo.png">
                <meta name="description" content="Sufee Admin - HTML5 Admin Template">
                <meta name="viewport" content="width=device-width, initial-scale=1">

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
                <script>
                    function confirmation(id) {
                        if (confirm("Do you want to make this issue active??")) {
                            window.location = "toggleActive.php?id=" + id;
                        }
                    }
                </script>
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
                                <h2>Change Active Issue</h2>
                                <br>
                                <br>
                                <?php
                                $query = "select * from tblmagazineissues";
                                $result = $con->query($query);
                                if ($result->num_rows > 0) {
                                    echo "<table class='table table-bordered' id='dataTable'>";
                                    echo "<thead class='table-dark'><tr>";
                                    echo "<th>Title</th>";
                                    echo "<th>Publish Date</th>";
                                    echo "<th>Cover Image</th>";
                                    echo "<th>Total Articles</th>";
                                    echo "<th>Status</th>";
                                    echo "</tr></thead><tbody>";
                                    while ($row = $result->fetch_array()) {
                                        $title = $row["title"];
                                        $creationDate = $row["creationDate"];
                                        $imageUrl = $row["coverImage"];
                                        $id = $row["id"];
                                        if ($id == $_SESSION["issueId"]) {
                                            $isActive = 1;
                                        } else {
                                            $isActive = 0;
                                        }
                                        $query = "select count(*) from tblarticles where magazineId=$id";
                                        $result2 = $con->query($query);
                                        $row2 = $result2->fetch_array();
                                        $count = $row2[0];
                                        echo "<tr>";
                                        echo "<td>$title</td>";
                                        echo "<td>$creationDate</td>";
                                        echo "<td><img src='$imageUrl' style='height:70px; width:100px;'></td>";
                                        echo "<td>$count</td>";
                                        if ($isActive == 1) {
                                            echo "<td>Activted</td>";
                                        } else {
                                            echo "<td><a onclick='confirmation($id)' href='#' class='btn btn-primary'>Make Active</a></td>";
                                        }
                                        echo "</tr>";
                                    }
                                    echo "</tbody>";
                                    echo "</table>";
                                } else {
                                    echo "<p>Sorry no issue avaliable to show</p>";
                                }
                                ?>
                            </center>
                        </div>
                    </div>
                </div>
                <script src="vendors/jquery/dist/jquery.min.js"></script>
                <script src="vendors/popper.js/dist/umd/popper.min.js"></script>
                <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
                <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
                <script src="assets/js/main.js"></script>


                <script src="vendors/chart.js/dist/Chart.bundle.min.js"></script>
                <script src="assets/js/dashboard.js"></script>
                <script src="assets/js/widgets.js"></script>
                <script src="vendors/jqvmap/dist/jquery.vmap.min.js"></script>
                <script src="vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
                <script src="vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
                <script>
                    (function ($) {
                        "use strict";

                        jQuery('#vmap').vectorMap({
                            map: 'world_en',
                            backgroundColor: null,
                            color: '#ffffff',
                            hoverOpacity: 0.7,
                            selectedColor: '#1de9b6',
                            enableZoom: true,
                            showTooltip: true,
                            values: sample_data,
                            scaleColors: ['#1de9b6', '#03a9f5'],
                            normalizeFunction: 'polynomial'
                        });
                    })(jQuery);
                </script>
            </body>

        </html>

        <?php
    }
} else {
    header("Location: index.php");
}