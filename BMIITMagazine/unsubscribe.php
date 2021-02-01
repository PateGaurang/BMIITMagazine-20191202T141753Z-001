<?php
require './connection.php';
if($_GET["email"]){
    $email=$_GET["email"];
    $query="delete from tblnewsletters where email='$email'";
    if($con->query($query)){
        echo "<center><h3>You unscubscribed successfully..</h3><br>redirecting in 5 seconds..</center>";
    }
    else{
        echo "<center><h3>There was a problem unsubscribing you please try again later</h3><br>redirecting in 5 seconds..</center>";
    }
    header( "refresh:5;url=index.php" );
}
else{
    header("location: index.php");
}