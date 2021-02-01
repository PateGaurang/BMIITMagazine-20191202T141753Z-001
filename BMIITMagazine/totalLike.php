<?php

require './connection.php';
if (isset($_POST["articleId"]) && isset($_POST["type"])) {
    $type = $_POST["type"];
    if ($type == 0) {
        $id = $_POST["articleId"];
        $query = "select count(*) from tbllikes where articleId=$id";
        $result2 = $con->query($query);
        $row2 = $result2->fetch_array();
        $totalLikes = $row2[0];
        echo "<span class='lnr lnr-heart' style='color: #f6214b;'></span>" . $totalLikes . " Likes";
    } else {
        $id = $_POST["articleId"];
        $query = "select count(*) from tblcomments where articleId=$id";
        $result2 = $con->query($query);
        $row2 = $result2->fetch_array();
        $totalComments = $row2[0];
        //echo "<script>alert('$totalComments')</script>";
        echo "<span class='lnr lnr-bubble' style='color: #f6214b;'></span></span>" . $totalComments . " Comments";
    }
}