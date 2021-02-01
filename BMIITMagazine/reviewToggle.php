<?php

include './connection.php';

if ($_GET["articleId"]) {
    $articleId = $_GET["articleId"];
    if (isset($_POST["btnApprove"])) {
        $isApproved = 9;
        $editorComment = $_POST["comment"];
        $query = "update tblarticles set isApproved=$isApproved,editorComment='$editorComment' where id=$articleId";
        if ($con->query($query)) {
            $query = "select * from tblnotification where type=3";
            $result = $con->query($query);
            if ($result->num_rows == 0) {
                $query = "insert into tblnotification(text,isReaded,otherData,type) value('New Articles are reviewed by editors',0,'reviewedArticle.php',3)";
                $con->query($query);
            }
            header("location: assignedArticle.php");
        }
    } else if (isset($_POST["btnReject"])) {
        $isApproved = 2;
        $editorComment = $_POST["comment"];
        $query = "update tblarticles set isApproved=$isApproved,editorComment='$editorComment' where id=$articleId";
        if ($con->query($query)) {
            header("location: assignedArticle.php");
        }
    } else {
        header("location: editorHome.php");
    }
} else {
    header("location: editorHome.php");
}
