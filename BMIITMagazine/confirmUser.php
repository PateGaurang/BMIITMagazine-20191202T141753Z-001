<?php
include './connection.php';
if(isset($_GET["username"]) && isset($_GET["type"])){
    $type=$_GET["type"];
    $username=$_GET["username"];
    $flag=FALSE;
    if($type=="student"){
        $query="update tblstudent set isExUser=0 where contactNo=$username";
        if($con->query($query)){
            $flag=TRUE;
        }
    }
    else if($type=="user"){
        $query="update tbluser set isActive=1 where contactNo=$username";
        if($con->query($query)){
            $flag=TRUE;
        }
    }
    if($flag){
        echo "<center><h3>Your Signup completed succssfully..</h3><br>redirecting in 5 seconds..</center>";
        header( "refresh:5;url=index.php" );
    }
}
else{
    header("location: index.php");
}