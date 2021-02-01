<?php
session_start();
if (!isset($_GET["id"])) {
    header("location: index.php");
} else {
    include_once './connection.php';
    ?>
    <!DOCTYPE html>
    <html>
        <head>
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
            <link rel="shortcut icon" href="img/fav.png">
            <meta name="author" content="BMIIT">
            <link rel="icon" href="img/UTU_logo.png">
            <meta name="description" content="">
            <meta name="keywords" content="">
            <meta charset="UTF-8">
            <title>Review Article</title>
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
            $id = $_GET["id"];
            $query = "select * from tblarticles where id=$id";
            $result = $con->query($query);
            $row = $result->fetch_array();
            ?>
            <div class="site-main-container">
                <section class="latest-post-area pb-120">
                    <div class="container no-padding">
                        <div class="row">
                            <div class="col-lg-8 post-list">
                                <div class="single-post-wrap">
                                    <div class="feature-img-thumb relative">
                                        <div class="overlay overlay-bg"></div>
                                        <img class="img-fluid" src="<?php echo $row["coverImage"]; ?>" alt="<?php echo $row["keyword"]; ?>">
                                    </div>
                                    <div class="content-wrap">
                                        <ul class="tags mt-10">
                                            <li><a><?php echo $row["keyword"]; ?></a></li>
                                        </ul>
                                        <a>
                                            <h3><?php echo $row["title"]; ?></h3>
                                        </a>
                                        <ul class="meta pb-20">
                                            <?php
                                            $eno = $row["studentId"];
                                            $query = "select * from tblstudent where contactNo=$eno";
                                            $result = $con->query($query);
                                            $row2 = $result->fetch_array();
                                            ?>
                                            <li><a><span class="lnr lnr-user" style="color: #f6214b;"></span><?php echo $row2["fname"] . " " . $row2["lname"]; ?></a></li>
                                            <li><a><span class="lnr lnr-calendar-full" style="color: #f6214b;"></span><?php echo $row["publishingDate"]; ?></a></li>
                                        </ul>
                                        <p>
                                            <?php
                                            $rawText = $row["text"];
                                            $text = nl2br($rawText);
                                            echo $text;
                                            ?>
                                        </p>
                                        <form action="reviewToggle.php?articleId=<?php echo $id; ?>" method="post">
                                            <div class="form-group">
                                                <br>
                                                <textarea class="form-control mb-10" rows="5" name="comment" placeholder="Comment" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Messege'"></textarea>
                                            </div>
                                            <div class="navigation-wrap justify-content-between d-flex">
                                                <button type="submit" class="prev" name="btnApprove">Approve&nbsp;&nbsp;<span class="fa fa-check"></span></button>
                                                <button type="submit" class="next" name="btnReject">Reject&nbsp;&nbsp;<span class="fa fa-close"></span></button>
<!--                                                <a class="prev" href="reviewToggle.php?id=1&articleId=<?php echo $id; ?>">Approve&nbsp;&nbsp;<span class="fa fa-check"></span></a>
                                                <a class="next" href="reviewToggle.php?id=0&articleId=<?php echo $id; ?>">Reject&nbsp;&nbsp;<span class="fa fa-close"></span></a>-->
                                            </div>
                                        </form>
                                    </div>
                                </div>
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