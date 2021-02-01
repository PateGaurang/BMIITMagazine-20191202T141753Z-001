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
                <title>Manage Issue</title>
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
                <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">


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
                                <h2>Manage Issue</h2><br><br>
                                <?php
                                $query = "select * from tblmagazineissues";
                                $result = $con->query($query);
                                if ($result->num_rows > 0) {
                                    echo "<table class='table table-bordered' id='dataTable'>";
                                    echo "<thead class='table-dark'><tr>";
                                    echo "<th>Title</th>";
                                    echo "<th>Creation Date</th>";
                                    echo "<th>Last Modification</th>";
                                    echo "<th>Cover Image</th>";
                                    echo "<th></th>";
                                    echo "</tr></thead><tbody>";
                                    while ($row = $result->fetch_array()) {
                                        echo "<tr>";
                                        echo "<td>" . $row["title"] . "</td>";
                                        echo "<td>" . $row["creationDate"] . "</td>";
                                        echo "<td>" . $row["lastModification"] . "</td>";
                                        echo "<td><img src='" . $row["coverImage"] . "' style='height:70px; width:100px;'></td>";
                                        echo "<td><a href='updateIssue.php?id=".$row["id"]."' style='color: #f6214b;'><i class='fa fa-edit' style='font-size:24px;'></i></a>&nbsp;&nbsp;&nbsp;<a href='#' style='color: #f6214b;' onclick='confirmation(".$row["id"].")'><i class='fa fa-trash' style='font-size:24px;'></i></a>";
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
                    function confirmation(id){
                        var temp=confirm("Do You want to remove this issue?");
                        if(temp){
                            window.location="removeIssue.php?id="+id;
                        }
                    }
                </script>
                <?php
                if(isset($_GET["failed"])){
                    echo "<script>alert('Unable to delete Issue because it contains articles');window.location='manageIssue.php'</script>";
                }
                ?>
            </body>

        </html>

        <?php
    }
} else {
    header("Location: index.php");
}