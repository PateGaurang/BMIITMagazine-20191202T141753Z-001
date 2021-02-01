<?php
require './connection.php';
if (isset($_GET["sid"])) {
    $contactNo = $_GET["sid"];
    $query = "update tblstudent set isEditor=0 where contactNo=$contactNo";
    if($con->query($query)){
        header("location: manageMembers.php");
    }
}
else if(isset ($_GET["pid"])){
    $contactNo = $_GET["pid"];
    $query = "update tblstudent set isEditor=0 where contactNo=$contactNo";
    if($con->query($query)){
        header("location: managePhotographer.php");
    }
    
}
else{
    session_start();
    session_destroy();
    header("location: index.php");
}