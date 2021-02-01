<?php
include './connection.php';
session_start();
if (isset($_POST["artId"]) && isset($_POST["text"]) && isset($_POST["uid"])) {
    $id=$_POST["artId"];
    $usertype=$_SESSION["usertype"];
    $message = $_POST["text"];
    if (empty($message)) {
        $msgErr = "Please Enter A proper comment";
    } else {
        $date = date("Y-m-d");
        $time = date("H:i:s");
        if ($usertype == "Student" || $usertype == "Editor") {
            $query = "insert into tblcomments(text,date,time,articleId,studentId) values('$message','$date','$time',$id," . $_SESSION["username"] . ")";
        } else {
            $query = "insert into tblcomments(text,date,time,articleId,userId) values('$message','$date','$time',$id," . $_SESSION["username"] . ")";
        }
        $con->query($query);
    }
    $query = "select * from tblcomments where articleId=$id";
    //echo "<script>alert('$query');</script>";
    $result = $con->query($query);
    $totalComments = $result->num_rows;
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
    <?php
}