<?php
include './connection.php';
if(isset($_GET["type"])){
    $type=$_GET["type"];
    if($type==1){
        $query="delete from tblnotification where type=1";
        if($con->query($query)){
            header("location: uploadRequest.php");
        }
    }
    else if($type==2){
        $query="delete from tblnotification where type=2";
        if($con->query($query)){
            header("location: updateRequest.php");
        }
    }
    else if($type==3){
        $query="delete from tblnotification where type=3";
        if($con->query($query)){
            header("location: reviewedArticles.php");
        }
    }
    else if($type==4){
        $query="delete from tblnotification where type=4";
        if($con->query($query)){
            header("location: editorRequest.php");
        }
    }
    else if($type==5){
        $query="delete from tblnotification where type=5";
        if($con->query($query)){
            header("location: photographerRequest.php");
        }
    }
    else if($type==6){
        $username=$_GET["username"];
        $query="delete from tblnotification where type=6 and studentId=$username";
        if($con->query($query)){
            header("location: articleHistory.php");
        }
    }
    else if($type==7){
        $username=$_GET["username"];
        $query="delete from tblnotification where type=7 and studentId=$username";
        if($con->query($query)){
            header("location: assignedArticle.php");
        }
    }
}
else{
    session_start();
    session_unset();
    session_destroy();
    header("locaiton: index.php");
}