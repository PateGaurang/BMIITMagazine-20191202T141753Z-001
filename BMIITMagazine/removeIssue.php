<?php
include './connection.php';
if(isset($_GET["id"])){
    $id=$_GET["id"];
    $query="select * from tblarticles where magazineId=$id";
    $result=$con->query($query);
    if($result->num_rows==0){
        $query="delete from tblmagazineissues where id='$id'";
        if($con->query($query)){
            header("location: manageIssue.php");
        }
    }
    else{
        header("location: manageIssue.php?failed=1");
    }
}
else{
    session_start();
    session_unset();
    session_destroy();
    header("location: index.php");
}