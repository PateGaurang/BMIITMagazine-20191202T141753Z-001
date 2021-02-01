<?php
    define("host", "localhost");
    define("usrname", "root");
    define("passwd", "mysql");
    define("database", "bmiitmagazine");
    $con= mysqli_connect(constant("host"), constant("usrname"), constant("passwd"), constant("database"));
    if(!$con){
        die("can not connect:".mysqli_errno());
    }
