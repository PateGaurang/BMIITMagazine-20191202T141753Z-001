<?php
session_start();
include './connection.php';
if (isset($_SESSION["username"]) || isset($_SESSION["usertype"])) {
    $usertype = $_SESSION["usertype"];
    if ($usertype == "Admin") {
        if(isset($_GET["sid"])){
            $contactNo=$_GET["sid"];
            $query="update tblstudent set isExUser=1 where contactNo=$contactNo";
            if($con->query($query)){
                header("location: manageStudent.php");
            }
            else{
                session_destroy();
                header("location: index.php");
            }
        }
        else if(isset ($_GET["pid"])){
            $contactNo=$_GET["pid"];
            $query="update tblstudent set isExUser=0 where contactNo=$contactNo";
            if($con->query($query)){
                header("location: manageStudent.php");
            }
            else{
                session_destroy();
                header("location: index.php");
            }
        }
    }
    else{
        session_destroy();
        header("location: index.php");
    }
}
else{
    session_destroy();
    header("location: index.php");
}
