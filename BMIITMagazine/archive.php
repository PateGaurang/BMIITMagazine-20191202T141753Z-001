<?php
session_start();
include './connection.php';
?>
<!DOCTYPE html>
<html lang="zxx" class="no-js">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="shortcut icon" href="img/fav.png">
        <meta name="author" content="Dhruv Bandaria">
        <link rel="icon" href="img/UTU_logo.png">
        <meta name="keywords" content="Magazine Issue">
        <meta charset="UTF-8">
        <title>Archive Issue</title>
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
        if (isset($_SESSION["usertype"])) {
            $type = $_SESSION["usertype"];
            if ($type == "Student") {
                include './studentMasterPage.php';
            } else if ($type == "Editor") {
                include './editorMaster.php';
            }
        } else {
            include './indexMaster.php';
        }
        ?>

        <div class="site-main-container">
            <section class="latest-post-area pb-120">
                <div class="container no-padding">
                    <div class="row">
                        <div class="col-lg-8 post-list">
                            <div class="latest-post-wrap">
                                <h4 class="cat-title">Archives</h4>
                                <?php
                                $query = "select * from tblmagazineissues where id!=" . $_SESSION["issueId"];
                                $result = $con->query($query);
                                while ($row = $result->fetch_array()) {
                                    $oldDate = $row["creationDate"];
                                    $newDate = date("d-m-Y", strtotime($oldDate));
                                    ?>
                                    <div class="single-latest-post row align-items-center">
                                        <div class="col-lg-5 post-left">
                                            <div class="feature-img relative">
                                                <div class="overlay overlay-bg"></div>
                                                <img class="img-fluid" src="<?php echo $row["coverImage"]; ?>" alt="">
                                            </div>
                                        </div>
                                        <div class="col-lg-7 post-right">
                                            <a href="archiveArticles?id=<?php echo $row["id"]; ?>">
                                                <h4><?php echo $row["title"]; ?></h4>
                                            </a>
                                            <ul class="meta">
                                                <li><a href="#"><span class="lnr lnr-calendar-full"></span><?php echo $newDate; ?></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                        <?php
                        include './sideNavMaster.php';
                        ?>
                    </div>
                </div>
            </section>
        </div>
        <?php
        include './footerMaster.php';
        ?>
    </body>
</html>