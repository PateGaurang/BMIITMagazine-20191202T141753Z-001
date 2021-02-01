<?php
include './connection.php';
if(isset($_POST["email"])){
    $email=$_POST["email"];
    $query="select * from tblstudent where email='$email'";
    $result=$con->query($query);
    if($result->num_rows!=0){
        echo 'false';
    }
    else{
        $query="select * from tbluser where email='$email'";
        $result=$con->query($query);
        if($result->num_rows!=0){
            echo 'false';
        }
        else{
            echo 'true';
        }
    }
}
if(isset($_POST["contactNo"])){
    $contactNo=$_POST["contactNo"];
    $query="select * from tblstudent where contactNo='$contactNo'";
    $result=$con->query($query);
    if($result->num_rows!=0){
        echo 'false';
    }
    else{
        $query="select * from tbluser where contactNo='$contactNo'";
        $result=$con->query($query);
        if($result->num_rows!=0){
            echo 'false';
        }
        else{
            echo 'true';
        }
    }
}
if(isset($_POST["enrollmentNo"])){
    $eno=$_POST["enrollmentNo"];
    $query="select * from tblstudent where enrollmentNo=$eno";
    $result=$con->query($query);
    if($result->num_rows!=0){
        echo 'false';
    }
    else{
        echo 'true';
    }
}
if(isset($_POST["forgotUsername"])){
    $contactNo=$_POST["forgotUsername"];
    $query="select * from tblstudent where contactNo='$contactNo'";
    $result=$con->query($query);
    if($result->num_rows==1){
        echo 'true';
    }
    else{
        $query="select * from tbluser where contactNo='$contactNo'";
        $result=$con->query($query);
        if($result->num_rows==1){
            echo 'true';
        }
        else{
            echo 'false';
        }
    }
}