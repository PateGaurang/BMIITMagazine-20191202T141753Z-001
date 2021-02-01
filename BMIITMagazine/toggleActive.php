<?php
session_start();
include './connection.php';
if (isset($_GET["id"])){
    $id=$_GET["id"];
    $query = "update tblmagazineissues set isCurrentIssue=1 where id=$id";
    $con->query($query);
    $query = "update tblmagazineissues set isCurrentIssue=0 where id!=$id";
    $con->query($query);
    $_SESSION["issueId"]=$id;
    header("location: changeActiveIssue.php");
}

