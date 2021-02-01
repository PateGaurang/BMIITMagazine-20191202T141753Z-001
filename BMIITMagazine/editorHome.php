<?php
session_start();
include 'connection.php';
if (isset($_SESSION["username"]) || isset($_SESSION["usertype"])) {
    $usertype = $_SESSION["usertype"];
    if ($usertype == "Editor") {
        ?>   
        <!DOCTYPE html>
        <html lang="zxx" class="no-js">
            <head>
                <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
                <link rel="shortcut icon" href="img/fav.png">
                <meta name="author" content="BMIIT">
                <link rel="icon" href="img/UTU_logo.png">
                <meta name="description" content="">
                <meta name="keywords" content="">
                <meta charset="UTF-8">
                <title>Editor Home</title>
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
                include './editorMaster.php';
                ?>
                <div class="site-main-container">
                    <?php
                    include './featuredPhotograph.php';
                    ?>
                    <section class="latest-post-area pb-120">
                        <div class="container no-padding">
                            <div class="row">
                                <div class="col-lg-8 post-list">
                                    <div class="latest-post-wrap">
                                        <h4 class="cat-title">Latest Articles</h4>
                                        <?php
                                        $query = "select * from tblarticles where magazineId=" . $_SESSION["issueId"] . " and isApproved=1 ORDER BY lastModification DESC";
                                        $result = $con->query($query);
                                        while ($row = $result->fetch_array()) {
                                            $contactNo = $row["studentId"];
                                            $id = $row["id"];
                                            $query = "select * from tblstudent where contactNo=$contactNo";
                                            $result2 = $con->query($query);
                                            $row1 = $result2->fetch_array();
                                            $authorName = $row1["fname"] . " " . $row1["lname"];
                                            $oldDate = $row["publishingDate"];
                                            $newDate = date("d-m-Y", strtotime($oldDate));
                                            $littleText = substr($row["text"], 0, 75);
                                            $littleText .= "...";
                                            ?>
                                            <div class="single-latest-post row align-items-center">
                                                <div class="col-lg-5 post-left">
                                                    <div class="feature-img relative">
                                                        <div class="overlay overlay-bg"></div>
                                                        <img class="img-fluid" src="<?php echo $row["coverImage"] ?>" alt="">
                                                    </div>
                                                    <ul class="tags">
                                                        <li><a href="#"><?php echo $row["keyword"]; ?></a></li>
                                                    </ul>
                                                </div>
                                                <div class="col-lg-7 post-right">
                                                    <a href="viewArticle.php?id=<?php echo $row["id"]; ?>">
                                                        <h4>
                                                            <?php echo $row["title"]; ?>
                                                        </h4>
                                                    </a>
                                                    <ul class="meta">
                                                        <li><a href="#"><span class="lnr lnr-user"></span><?php echo $authorName; ?></a></li>
                                                        <li><a href="#"><span class="lnr lnr-calendar-full"></span><?php echo $newDate; ?></a></li>
                                                        <li><a href="#"><span class="lnr lnr-bubble"></span>06 Comments</a></li>
                                                        <li><a href="#"><span class="lnr lnr-heart"></span><?php
                                                                $query = "select count(*) from tbllikes where articleId=$id";
                                                                $result2 = $con->query($query);
                                                                $row2 = $result2->fetch_array();
                                                                $totalLikes = $row2[0];
                                                                echo $totalLikes . " Likes";
                                                                ?></a></li>
                                                    </ul>
                                                    <p class="excert">
                                                        <?php echo $littleText; ?>
                                                    </p>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                    <?php
                                    include './popularPost.php';
                                    ?>
                                </div>
                                <?php
                                include './sideNavMaster.php';
                                ?>
                            </div>
                        </div>
                    </section>
                </div>
                <?php include './footerMaster.php'; ?>
            </body>
        </html>
        <?php
    }
} else {
    header("Location: index.php");
}