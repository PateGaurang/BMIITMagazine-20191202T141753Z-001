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
                <title>Admin Dashboard</title>
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
                    <?php
                    $last7Date = date("Y-m-d", strtotime("-7 day"));
                    $today = date("Y-m-d");
                    $query = "select * from tbllikes where likedOn between '$last7Date' and '$today'";
                    $result = $con->query($query);
                    ?>
                    <div class="content mt-3">
                        <div class="col-sm-6 col-lg-3">
                            <div class="card text-white bg-flat-color-1">
                                <div class="card-body pb-0">
                                    <div class="dropdown float-right">
                                        <button class="btn bg-transparent dropdown-toggle theme-toggle text-light" type="button" id="dropdownMenuButton1" data-toggle="dropdown">
                                            <i class="fa fa-cog"></i>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                            <div class="dropdown-menu-content">
                                                <a class="dropdown-item" href="#" id="like1">Last Week</a>
                                                <a class="dropdown-item" href="#" id="like2">Last Month</a>
                                                <a class="dropdown-item" href="#" id="like3">From Beginning</a>
                                            </div>
                                        </div>
                                    </div>
                                    <h4 class="mb-0" id="likeCount">
                                        <span><?php echo $result->num_rows; ?></span>
                                    </h4>
                                    <p class="text-light">Total Likes</p>
                                </div>

                            </div>
                        </div>
                        <?php
                        $last7Date = date("Y-m-d", strtotime("-7 day"));
                        $today = date("Y-m-d");
                        $query = "select * from tblcomments where date between '$last7Date' and '$today'";
                        $result = $con->query($query);
                        ?>
                        <div class="col-sm-6 col-lg-3">
                            <div class="card text-white bg-flat-color-2">
                                <div class="card-body pb-0">
                                    <div class="dropdown float-right">
                                        <button class="btn bg-transparent dropdown-toggle theme-toggle text-light" type="button" id="dropdownMenuButton2" data-toggle="dropdown">
                                            <i class="fa fa-cog"></i>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                                            <div class="dropdown-menu-content">
                                                <a class="dropdown-item" href="#" id="comment1">Last Week</a>
                                                <a class="dropdown-item" href="#" id="comment2">Last Month</a>
                                                <a class="dropdown-item" href="#" id="comment3">From Beginning</a>
                                            </div>
                                        </div>
                                    </div>
                                    <h4 class="mb-0" id="commentCount">
                                        <span><?php echo $result->num_rows; ?></span>
                                    </h4>
                                    <p class="text-light">Total Comments</p>

                                </div>
                            </div>
                        </div>
                        <!--/.col-->
                        <?php
                        $last7Date = date("Y-m-d", strtotime("-7 day"));
                        $today = date("Y-m-d");
                        $query = "select * from tblarticles where publishingDate between '$last7Date' and '$today'";
                        $result = $con->query($query);
                        ?>
                        <div class="col-sm-6 col-lg-3">
                            <div class="card text-white bg-flat-color-3">
                                <div class="card-body pb-0">
                                    <div class="dropdown float-right">
                                        <button class="btn bg-transparent dropdown-toggle theme-toggle text-light" type="button" id="dropdownMenuButton3" data-toggle="dropdown">
                                            <i class="fa fa-cog"></i>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton3">
                                            <div class="dropdown-menu-content">
                                                <a class="dropdown-item" href="#" id="article1">Last Week</a>
                                                <a class="dropdown-item" href="#" id="article2">Last Month</a>
                                                <a class="dropdown-item" href="#" id="article3">From Beginning</a>
                                            </div>
                                        </div>
                                    </div>
                                    <h4 class="mb-0" id="articleCount">
                                        <span><?php echo $result->num_rows; ?></span>
                                    </h4>
                                    <p class="text-light">Total Articles</p>

                                </div>
                            </div>
                        </div>
                        <!--/.col-->
                        <?php
                        $query = "select * from tblmagazineissues";
                        $result = $con->query($query);
                        ?>
                        <div class="col-sm-6 col-lg-3">
                            <div class="card text-white bg-flat-color-4">
                                <div class="card-body pb-0">
                                    <h4 class="mb-0" id="issueCount">
                                        <span><?php echo $result->num_rows; ?></span>
                                    </h4>
                                    <p class="text-light">Total Issues</p>
                                </div>
                            </div>
                        </div>
                        <!--/.col-->
                        <?php
                        $query = "select * from tblstudent";
                        $result = $con->query($query);
                        ?>
                        <div class="col-xl-4 col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="stat-widget-one">
                                        <div class="stat-icon dib"><i class="ti-user text-primary border-primary"></i></div>
                                        <div class="stat-content dib">
                                            <div class="stat-text">Total Students</div>
                                            <div class="stat-digit"><?php echo $result->num_rows; ?></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                        $query = "select * from tbluser";
                        $result = $con->query($query);
                        ?>

                        <div class="col-xl-4 col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="stat-widget-one">
                                        <div class="stat-icon dib"><i class="ti-user text-primary border-primary"></i></div>
                                        <div class="stat-content dib">
                                            <div class="stat-text">Total Users</div>
                                            <div class="stat-digit"><?php echo $result->num_rows; ?></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                        $query = "select * from tblarticles where magazineId=" . $_SESSION["issueId"];
                        $result = $con->query($query);
                        ?>
                        <div class="col-xl-4 col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="stat-widget-one">
                                        <div class="stat-icon dib"><i class="ti-layout-grid2 text-warning border-warning"></i></div>
                                        <div class="stat-content dib">
                                            <div class="stat-text">Total Articles in Current Issue</div>
                                            <div class="stat-digit"><?php echo $result->num_rows; ?></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6" id="chartContainer" style="height: 350px;">

                        </div>
                    </div> 
                </div>

                <script src="js/jquery-3.1.1.min.js"></script>
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