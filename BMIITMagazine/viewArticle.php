<?php
session_start();
date_default_timezone_set('Asia/Kolkata');
if (!isset($_GET["id"])) {
    header("location: index.php");
} else {
    include_once './connection.php';
    if (isset($_SESSION["username"]) && isset($_SESSION["usertype"])) {
        $username = $_SESSION["username"];
        $usertype = $_SESSION["usertype"];
    } else {
        include './loginLogic.php';
    }
    ?>
    <!DOCTYPE html>
    <html>
        <head>
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
            <link rel="shortcut icon" href="img/fav.png">
            <link rel="icon" href="img/UTU_logo.png">
            <meta name="author" content="BMIIT">
            <meta name="description" content="">
            <meta name="keywords" content="">
            <meta charset="UTF-8">
            <?php
            $query="select * from tblarticles where id=".$_GET["id"];
            $result=$con->query($query);
            $row=$result->fetch_array();
            ?>
            <title><?php echo $row["title"]?> | View Article</title>
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
            <script src="js/jquery-3.1.1.min.js" type="text/javascript"></script>
            <script>
                $(document).ready(function () {
                    $("#like").on("click", function () {
                        var uid = $(this).val();
                        $.ajax({
                            type: 'post',
                            url: 'addLike.php',
                            data: {uid: uid, utype: '<?php echo $usertype; ?>', articleId: '<?php echo $_GET["id"]; ?>'},
                            success: function (html) {
                                $("#likeButton").html(html);
                                $.ajax({
                                    type: 'post',
                                    url: 'totalLike.php',
                                    data: {articleId: '<?php echo $_GET["id"]; ?>', type: 0},
                                    success: function (html) {
                                        $("#totalLikes").html(html);
                                    }
                                });
                            }
                        });
                    });
                    $("#unlike").on("click", function () {
                        var uid = $(this).val();
                        $.ajax({
                            type: 'post',
                            url: 'addLike.php',
                            data: {uid: uid, utype: '<?php echo $usertype; ?>', articleId: '<?php echo $_GET["id"]; ?>', isDelete: '1'},
                            success: function (html) {
                                $("#likeButton").html(html);
                                $.ajax({
                                    type: 'post',
                                    url: 'totalLike.php',
                                    data: {articleId: '<?php echo $_GET["id"]; ?>', type: 0},
                                    success: function (html) {
                                        $("#totalLikes").html(html);
                                    }
                                });
                            }
                        });
                    });
                    $("#like,#unlike").on("click", function () {

                    });
                    $("#postComment").on("click", function () {
                        var articleId = $(this).val();
                        var message = $("#message").val();
                        var user = '<?php echo $_SESSION["username"]; ?>';
                        $.ajax({
                            type: 'post',
                            url: 'changeComment.php',
                            data: {artId: articleId, text: message, uid: user},
                            success: function (html) {
                                $("#message").val('');
                                $("#commentArea").html(html);
                                $.ajax({
                                    type: 'post',
                                    url: 'totalLike.php',
                                    data: {articleId: '<?php echo $_GET["id"]; ?>', type: 1},
                                    success: function (html) {
                                        $("#totalComments").html(html);
                                    }
                                });
                            }
                        });
                    });
                });
            </script>
        </head>
        <body>
            <?php
            $flag = FALSE;
            if (isset($_SESSION["usertype"])) {
                $type = $_SESSION["usertype"];
                if ($type == "Student") {
                    include './studentMasterPage.php';
                } else if ($type == "Editor") {
                    include './editorMaster.php';
                } else if ($type == "Photographer") {
                    include './photographerMaster.php';
                } else {
                    include './userMaster.php';
                }
            } else {
                include './indexMaster.php';
            }
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
                                    <div class="navigation-wrap justify-content-between d-flex">
    <?php
    if (isset($_SESSION["usertype"])) {
        if ($type == "Student") {
            ?>
                                                <a class="back" href="studentHome.php"><span class="lnr lnr-arrow-left"></span>&nbsp;Back</a>
                                                <?php
                                            } else if ($type == "Editor") {
                                                ?>
                                                <a class="back" href="editorHome.php"><span class="lnr lnr-arrow-left"></span>&nbsp;Back</a>
                                                <?php
                                            } else if ($type == "User") {
                                                ?>
                                                <a class="back" href="userHome.php"><span class="lnr lnr-arrow-left"></span>&nbsp;Back</a>
                                                <?php
                                            } else {
                                                ?>
                                                <a class="back" href="index.php"><span class="lnr lnr-arrow-left"></span>&nbsp;Back</a>
                                                <?php
                                            }
                                        } else {
                                            ?>
                                            <a class="back" href="index.php"><span class="lnr lnr-arrow-left"></span>&nbsp;Back</a>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                    <br>
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
                                            <li><a id="totalLikes"><span class="lnr lnr-heart" style="color: #f6214b;"></span>
    <?php
    $query = "select count(*) from tbllikes where articleId=$id";
    $result2 = $con->query($query);
    $row2 = $result2->fetch_array();
    $totalLikes = $row2[0];
    echo $totalLikes . " Likes";
    ?>
                                                </a></li>
                                            <li><a id="totalComments"><span class="lnr lnr-bubble" style="color: #f6214b;"></span>
    <?php
    $query = "select count(*) from tblcomments where articleId=$id";
    $result2 = $con->query($query);
    $row2 = $result2->fetch_array();
    $totalComments = $row2[0];
    echo $totalComments . " Comments";
    ?>
                                                </a></li>
                                        </ul>
                                        <p>
    <?php
    $rawText = $row["text"];
    $text = nl2br($rawText);
    echo $text;
    ?>
                                        </p>
                                        <div class="navigation-wrap justify-content-between d-flex" id="likeButton">
                                            <div class="col-4 col-sm-4 col-md-4 col-xl-4"></div>
    <?php
    if (isset($_SESSION["username"]) && isset($_SESSION["usertype"])) {
        $flag = TRUE;
        if ($usertype == "Student" || $usertype == "Editor") {
            $query = "select * from tbllikes where articleId=$id and studentId=$username";
        } else {
            $query = "select * from tbllikes where articleId=$id and userId=$username";
        }
        $result = $con->query($query);
        //echo "<script>alert('".$username."');</script>";
        if ($result->num_rows != 0) {
            ?>
                                                    <button class="back" style="height: 40px; width: 80px;" id="unlike" value="<?php echo $_SESSION["username"]; ?>">Unlike&nbsp;&nbsp;<span class="fa fa-thumbs-down"></span></button>
                                                    <?php
                                                } else {
                                                    ?>
                                                    <button class="back" style="height: 40px; width: 80px;" id="like" value="<?php echo $_SESSION["username"]; ?>">Like&nbsp;&nbsp;<span class="fa fa-thumbs-up"></span></button>
                                                    <?php
                                                }
                                            } else {
                                                ?>
                                                <a class="back" href="#" data-toggle="modal" data-target="#myModal">Like&nbsp;&nbsp;<span class="fa fa-thumbs-up"></span></a>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                            <?php
                                            if ($flag) {
                                                $msgErr = "";
                                                if (isset($_POST["btnSubmit"])) {
                                                    $message = $_POST["message"];
                                                    if (empty($message)) {
                                                        $msgErr = "Please Enter A proper comment";
                                                    } else {
                                                        $date = date("Y-m-d");
                                                        $time = date("H:i:s");
                                                        //echo "<script>alert('$usertype');</script>";
                                                        if ($usertype == "Student" || $usertype == "Editor") {
                                                            $query = "insert into tblcomments(text,date,time,articleId,studentId) values('$message','$date','$time',$id," . $_SESSION["username"] . ")";
                                                        } else {
                                                            $query = "insert into tblcomments(text,date,time,articleId,userId) values('$message','$date','$time',$id," . $_SESSION["username"] . ")";
                                                        }
                                                        if ($con->query($query)) {
                                                            
                                                        }
                                                    }
                                                }
                                            }
                                            $query = "select * from tblcomments where articleId=$id";
                                            //echo "<script>alert('$query');</script>";
                                            $result = $con->query($query);
                                            $totalComments = $result->num_rows;
                                            ?>
                                        <div class="comment-sec-area">
                                            <div class="container">
                                                <div class="row flex-column" id="commentArea">
    <?php
    if ($totalComments == 0) {
        ?>
                                                        <h6>Be First to comment on this article</h6>
                                                        <?php
                                                    } else {
                                                        ?>
                                                        <h6><?php echo $totalComments . " "; ?> Comments</h6>
                                                        <?php
                                                        while ($row = $result->fetch_array()) {
                                                            ?>
                                                            <div class="comment-list">
                                                                <div class="single-comment justify-content-between d-flex">
                                                                    <div class="user justify-content-between d-flex">
                                                                        <div class="thumb">
                                                                            <img src="img/user.jpg" alt="">
                                                                        </div>
                                                                        <div class="desc">
                                                                            <h5>
                                                                                <a href="#">
            <?php
            if (is_numeric($row["studentId"])) {
                $query = "select * from tblstudent where contactNo=" . $row["studentId"];
            } else {
                $query = "select * from tbluser where contactNo=" . $row["userId"];
            }
            $result2 = $con->query($query);
            $row2 = $result2->fetch_array();
            echo $row2["fname"] . " " . $row2["lname"];
            ?>
                                                                                </a>
                                                                            </h5>
                                                                            <p class="date">
            <?php
            $newDate = date("d-m-Y", strtotime($row["date"]));
            $time = $row["time"];
            echo "$newDate at $time";
            ?>
                                                                            </p>
                                                                            <p class="comment">
            <?php echo $row["text"]; ?>
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
            <?php
        }
        ?>
                                                        <?php
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
    <?php
    if ($flag) {
        ?>
                                        <div class="comment-form">
                                            <h4>Post Comment</h4>
                                            <div class="form-group">
                                                <textarea class="form-control mb-10" rows="5" name="message" id="message" placeholder="Messege" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Messege'" required=""></textarea>
                                                <br><?php echo $msgErr; ?>
                                            </div>
                                            <button id="postComment" class="primary-btn text-uppercase" value="<?php echo $id; ?>">Post Comment</button>
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
    <?php
}