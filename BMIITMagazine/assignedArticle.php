<?php
session_start();
if (isset($_SESSION["username"]) || isset($_SESSION["usertype"])) {
    $usertype = $_SESSION["usertype"];
    if ($usertype == "Editor") {
        require './connection.php';
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
                <title>Assigned Articles</title>
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
                    <section class="contact-page-area pt-50 pb-120">
                        <div class="container">
                            <div class="row contact-wrap">
                                <div class="col-lg-5 col-5 col-sm-5 col-md-5"></div>
                                <div class="col-lg-4 col-4 col-sm-4 col-md-4">
                                    <h3>Assigned Articles</h3>
                                </div>
                            </div>
                            <div class="row contact-wrap">
                                <?php
                                $query = "select * from tblarticles where editorId=" . $_SESSION["username"] . " and isApproved in(0,7)";
                                $result = $con->query($query);
                                if ($result->num_rows != 0) {
                                    ?>
                                    <table class="table table-hover">
                                        <tr>
                                            <th>Title</th>
                                            <th>Keyword</th>
                                            <th>Author</th>
                                            <th>Cover Image</th>
                                            <th></th>
                                        </tr>
                                        <?php
                                        while ($row = $result->fetch_array()) {
                                            $query = "select fname,lname from tblstudent where contactNo=" . $row["studentId"];
                                            $result2 = $con->query($query);
                                            $row1 = $result2->fetch_array();
                                            $authorName = $row1[0] . " " . $row1[1];
                                            ?>
                                            <tr>
                                                <td><?php echo $row["title"]; ?></td>
                                                <td><?php echo $row["keyword"]; ?></td>
                                                <td><?php echo $authorName; ?></td>
                                                <td><img src="<?php echo $row["coverImage"]; ?>" style="height:70px; width:100px;"></td>
                                                <td><a href="reviewArticle.php?id=<?php echo $row["id"]; ?>" class="tableLink">Review</a></td>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                    </table>
                                    <?php
                                } else {
                                    ?>
                                    <div class="col-4 col-sm-4 col-md-4 col-lg-4 col-xl-4"></div>
                                    <div class="col-8 col-sm-8 col-md-8 col-lg-8 col-xl-8">
                                        <h5>Sorry no more article left for review, come back later</h5>
                                    </div>
                                <?php
                                }
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
        <?php
    }
} else {
    //print_r($_SESSION);
    header("Location: index.php");
}