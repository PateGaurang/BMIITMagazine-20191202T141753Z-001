<?php

include './connection.php';
if (isset($_GET["articleId"])) {
    $articleId = $_GET["articleId"];
    if (isset($_POST["btnApprove"])) {
        $isApproved = 1;
        $query = "update tblarticles set isApproved=$isApproved where id=$articleId";
        if ($con->query($query)) {
            $query = "select * from tblArticles where id=$articleId";
            $result = $con->query($query);
            $row = $result->fetch_array();
            $title = $row["title"];
            $littleText = substr($row["text"], 0, 75);
            $littleText .= "...";
            $coverImage = $row["coverImage"];
            $temp = substr($coverImage, 1);
            $finalImg = "http://" . $_SERVER["HTTP_HOST"] . "/BMIITMagazine/" . $temp;
            //echo "<script>alert('$finalImg');</script>";
            require_once './Email.php';
            $email = new Email();
            $query = "select * from tblNewsletters";
            $result = $con->query($query);
            $from = "no-rely@bmiitchronicals.com";
            $subject = "New Article Alert";
            while ($row = $result->fetch_array()) {
                $to = $row[0];
                $message = "<html><body><img src='$finalImg' style='width:100%; height:100%;'><br><h2>$title</h2><br><p>$littleText</p><a href='http://" . $_SERVER["HTTP_HOST"] . "/BMIITMagazine/viewArticle.php?id=$articleId'>Read more</a><br>";
                $message .= "<p>getting too manny emails from BMIIT Chronicals.<a href='http://" . $_SERVER["HTTP_HOST"] . "/BMIITMagazine/unsubscribe.php?email=$to'>Unsubscribe</a></p>";
                $email->send($from, $subject, $message, $to);
                $message = "";
            }
            $query="select * from tblarticles where id=$articleId";
            $result=$con->query($query);
            $row=$result->fetch_array();
            $studentId=$row["studentId"];
            $query = "select * from tblnotification where type=6";
            $result = $con->query($query);
            if ($result->num_rows == 0) {
                $query = "insert into tblnotification(text,isReaded,otherData,type,studentId) value('Your article is approved',0,'uploadRequest.php',6,$studentId)";
                $con->query($query);
            }
            header("location: reviewedArticles.php");
        }
    } else if (isset($_POST["btnReject"])) {
        $isApproved = 2;
        $query = "update tblarticles set isApproved=$isApproved where id=$articleId";
        if ($con->query($query)) {
            $query="select * from tblarticles where id=$articleId";
            $result=$con->query($query);
            $row=$result->fetch_array();
            $studentId=$row["studentId"];
            $query = "select * from tblnotification where type=6";
            $result = $con->query($query);
            if ($result->num_rows == 0) {
                $query = "insert into tblnotification(text,isReaded,otherData,type,studentId) value('Your article is rejected',0,'uploadRequest.php',6,$studentId)";
                $con->query($query);
            }
            header("location: reviewedArticles.php");
        }
    } else {
        header("location: reviewedArticles.php");
    }
} else {
    header("location: reviewedArticles.php");
}

