<?php
session_start();
require './connection.php';
//echo "<script>alert('asdas')</script>";
if (isset($_POST["uid"]) && isset($_POST["utype"]) && isset($_POST["articleId"]) && isset($_POST["isDelete"])) {
    $uid = $_POST["uid"];
    $utype = $_POST["utype"];
    $aid = $_POST["articleId"];
    //echo "<script>alert('$utype')</script>";
    if ($utype == "Student" || $utype == "Editor") {
        $query = "delete from tbllikes where articleId=$aid and studentId=$uid";
    } else {
        $query = "delete from tbllikes where articleId=$aid and userId=$uid";
    }
    if ($con->query($query)) {
        ?>
        <script>
            $(document).ready(function () {
                $("#like").on("click", function () {
                    var uid = <?php echo $uid; ?>;
                    $.ajax({
                        type: 'post',
                        url: 'addLike.php',
                        data: {uid: uid, utype: '<?php echo $utype; ?>', articleId: '<?php echo $aid; ?>'},
                        success: function (html) {
                            $("#likeButton").html(html);
                            $.ajax({
                                type: 'post',
                                url: 'totalLike.php',
                                data: {articleId: '<?php echo $aid; ?>', type: 0},
                                success: function (html) {
                                    $("#totalLikes").html(html);
                                }
                            });
                        }
                    });
                });
                $("#unlike").on("click", function () {
                    var uid = <?php echo $uid; ?>;
                    $.ajax({
                        type: 'post',
                        url: 'addLike.php',
                        data: {uid: uid, utype: '<?php echo $utype; ?>', articleId: '<?php echo $aid; ?>', isDelete: '1'},
                        success: function (html) {
                            $("#likeButton").html(html);
                            $.ajax({
                                type: 'post',
                                url: 'totalLike.php',
                                data: {articleId: '<?php echo $aid; ?>', type: 0},
                                success: function (html) {
                                    $("#totalLikes").html(html);
                                }
                            });
                        }
                    });
                });
            });
        </script>
        <div class="col-4 col-sm-4 col-md-4 col-xl-4"></div>
        <button class="back" style="height: 40px; width: 80px;" id="like" value="<?php echo $_SESSION["username"]; ?>">Like&nbsp;&nbsp;<span class="fa fa-thumbs-up"></span></button>
        <?php
    }
} else if (isset($_POST["uid"]) && isset($_POST["utype"]) && isset($_POST["articleId"])) {
    $uid = $_POST["uid"];
    $utype = $_POST["utype"];
    //echo "<script>alert('$query')</script>";
    $aid = $_POST["articleId"];
    $date = date("Y-m-d");
    if ($utype == "Student" || $utype == "Editor") {
        $query = "insert into tbllikes(articleId,studentId,likedOn) values($aid,$uid,'$date')";
    } else {
        $query = "insert into tbllikes(articleId,userId,likedOn) values($aid,$uid,'$date')";
    }
    if ($con->query($query)) {
        ?>
        <script>
            $(document).ready(function () {
                $("#like").on("click", function () {
                    var uid = <?php echo $uid; ?>;
                    $.ajax({
                        type: 'post',
                        url: 'addLike.php',
                        data: {uid: uid, utype: '<?php echo $utype; ?>', articleId: '<?php echo $aid; ?>'},
                        success: function (html) {
                            $("#likeButton").html(html);
                            $.ajax({
                                type: 'post',
                                url: 'totalLike.php',
                                data: {articleId: '<?php echo $aid; ?>', type: 0},
                                success: function (html) {
                                    $("#totalLikes").html(html);
                                }
                            });
                        }
                    });
                });
                $("#unlike").on("click", function () {
                    var uid = <?php echo $uid; ?>;
                    $.ajax({
                        type: 'post',
                        url: 'addLike.php',
                        data: {uid: uid, utype: '<?php echo $utype; ?>', articleId: '<?php echo $aid; ?>', isDelete: '1'},
                        success: function (html) {
                            $("#likeButton").html(html);
                            $.ajax({
                                type: 'post',
                                url: 'totalLike.php',
                                data: {articleId: '<?php echo $aid; ?>', type: 0},
                                success: function (html) {
                                    $("#totalLikes").html(html);
                                }
                            });
                        }
                    });
                });
            });
        </script>
        <div class="col-4 col-sm-4 col-md-4 col-xl-4"></div>
        <button class="back" style="height: 40px; width: 80px;" id="unlike" value="<?php echo $_SESSION["username"]; ?>">Unlike&nbsp;&nbsp;<span class="fa fa-thumbs-down"></span></button>
        <?php
    }
}