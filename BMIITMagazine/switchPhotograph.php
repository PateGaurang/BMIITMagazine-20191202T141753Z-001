<?php
include './connection.php';
if(isset($_POST["btnSubmit"])){
    if(isset($_POST["newPosition"]) && isset($_GET["current"])){
        $currentPoss=$_GET["current"];
        $newPoss=$_POST["newPosition"];
        $query="select * from tblphotographs where isSelected=$newPoss";
        $result=$con->query($query);
        $row=$result->fetch_array();
        $newid=$row["id"];
        echo $newid;
        $query="update tblphotographs set isSelected=$newPoss where isSelected=$currentPoss";
        echo "<br>$query";
        $con->query($query);
        $query="update tblphotographs set isSelected=$currentPoss where id=$newid";
        echo "<br>$query";
        $con->query($query);
        header("location: changePhotographs.php");
    }
    else{
        header("location: changePhotographs.php");
    }
}
else if(isset ($_POST["btnAdd"])){
    if(isset($_POST["newPos"]) && isset($_GET["id"])){
        $newPos=$_POST["newPos"];
        $id=$_GET["id"];
        $query="update tblphotographs set isSelected=0 where isSelected=$newPos";
        $con->query($query);
        $query="update tblphotographs set isSelected=$newPos where id=$id";
        if($con->query($query)){
            header("location: changePhotographs.php");
        }
    }
}
else if(isset ($_GET["deleteId"])){
    $id=$_GET["deleteId"];
    $query="update tblphotographs set isSelected=0 where id=$id";
    if($con->query($query)){
        header("location: changePhotographs.php");
    }
}
else{
    header("location: changePhotographs.php");
}
