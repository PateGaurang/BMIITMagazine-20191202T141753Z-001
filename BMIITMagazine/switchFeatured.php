<?php
include './connection.php';
if(isset($_POST["btnSubmit"])){
    if(isset($_POST["newPosition"]) && isset($_GET["current"])){
        $currentPoss=$_GET["current"];
        $newPoss=$_POST["newPosition"];
        $query="select * from tblarticles where isFeatured=$newPoss";
        $result=$con->query($query);
        $row=$result->fetch_array();
        $newid=$row["id"];
        echo $newid;
        $query="update tblarticles set isFeatured=$newPoss where isFeatured=$currentPoss";
        echo "<br>$query";
        $con->query($query);
        $query="update tblarticles set isFeatured=$currentPoss where id=$newid";
        echo "<br>$query";
        $con->query($query);
        header("location: featuredArticles.php");
    }
    else{
        header("location: featuredArticles.php");
    }
}
else if(isset ($_POST["btnAdd"])){
    if(isset($_POST["newPos"]) && isset($_GET["id"])){
        $newPos=$_POST["newPos"];
        $id=$_GET["id"];
        $query="update tblarticles set isFeatured=0 where isFeatured=$newPos";
        $con->query($query);
        $query="update tblarticles set isFeatured=$newPos where id=$id";
        if($con->query($query)){
            header("location: featuredArticles.php");
        }
    }
}
else{
    header("location: featuredArticles.php");
}
