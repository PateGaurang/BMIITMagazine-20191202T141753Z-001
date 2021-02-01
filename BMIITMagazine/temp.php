<?php

$articleId = 13;

$query = "select * from tblArticles where id=$articleId";
$result = $con->query($query);
$row = $result->fetch_array();
$title = $row["title"];
$littleText = substr($row["text"], 0, 75);
$littleText .= "...";
$coverImage = $row["coverImage"];
$temp = substr($coverImage, 1);
$finalImg = "http://" . $_SERVER["HTTP_HOST"] . "/" . $temp;
//echo "<script>alert('$finalImg');</script>";
require_once './Email.php';
$email = new SendEmail();
$query = "select * from tblNewsletters";
$result = $con->query($query);
$from = "16mscit051@gmail.com";
$subject = "New Article is Uploaded to BMIIT Chronicles";
while ($row = $result->fetch_array()) {
    $to = $row[0];
    $message = "<html><body><img src='$finalImg' style='width:100%; height:100%;'><br><h2>$title</h2><br><p>$littleText</p><a href='http://" . $_SERVER["HTTP_HOST"] . "/viewArticle.php?id=$articleId'>Read more</a><br>";
    $message .= "<p>getting too manny emails from BMIIT Chronicals.<a href='http://" . $_SERVER["HTTP_HOST"] . "/unsubscribe.php?email=$to'>Unsubscribe</a></p>";
    $email->send($from, $subject, $message, $to);
    $message = "";
}

/*
 include './Email.php';

$mail=new SendEmail();
$from="16mscit051@gmail.com";
$to="dhruvbandaria@hotmail.com";
$message="<html><body><h1>asdasd</h1><br><h2>asdasd</h2><br><h3>asdasd</h3></body></html>";
$subject="Mail Subject";
$mail->send($from, $subject, $message, $to);

 */