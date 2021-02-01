<?php

include './connection.php';
if (isset($_POST["type"]) && isset($_POST["selected"])) {
    $type = $_POST["type"];
    $selected = $_POST["selected"];
    if ($type == 1) {
        if ($selected == 1) {
            $last7Date = date("Y-m-d", strtotime("-7 day"));
            $today = date("Y-m-d");
            $query = "select * from tbllikes where likedOn between '$last7Date' and '$today'";
            $result = $con->query($query);
            echo "<span class='count'>$result->num_rows</span>";
        }
        else if($selected==2){
            $last7Date = date("Y-m-d", strtotime("-30 day"));
            $today = date("Y-m-d");
            $query = "select * from tbllikes where likedOn between '$last7Date' and '$today'";
            $result = $con->query($query);
            echo "<span class='count'>$result->num_rows</span>";
        }
        else if($selected==3){
            $query = "select * from tbllikes";
            $result = $con->query($query);
            echo "<span class='count'>$result->num_rows</span>";
        }
    }
    else if($type==2){
        if($selected==1){
            $last7Date = date("Y-m-d", strtotime("-7 day"));
            $today = date("Y-m-d");
            $query = "select * from tblcomments where date between '$last7Date' and '$today'";
            $result = $con->query($query);
            echo "<span class='count'>$result->num_rows</span>";
        }
        else if($selected==2){
            $last7Date = date("Y-m-d", strtotime("-30 day"));
            $today = date("Y-m-d");
            $query = "select * from tblcomments where date between '$last7Date' and '$today'";
            $result = $con->query($query);
            echo "<span class='count'>$result->num_rows</span>";
        }
        else if($selected==3){
            $query = "select * from tblcomments";
            $result = $con->query($query);
            echo "<span class='count'>$result->num_rows</span>";
        }
    }
    else if($type==3){
        if($selected==1){
            $last7Date = date("Y-m-d", strtotime("-7 day"));
            $today = date("Y-m-d");
            $query = "select * from tblarticles where publishingDate between '$last7Date' and '$today'";
            $result = $con->query($query);
            echo "<span class='count'>$result->num_rows</span>";
        }
        else if($selected==2){
            $last7Date = date("Y-m-d", strtotime("-30 day"));
            $today = date("Y-m-d");
            $query = "select * from tblarticles where publishingDate between '$last7Date' and '$today'";
            $result = $con->query($query);
            echo "<span class='count'>$result->num_rows</span>";
        }
        else if($selected==3){
            $query = "select * from tblarticles";
            $result = $con->query($query);
            echo "<span class='count'>$result->num_rows</span>";
        }
    }
}