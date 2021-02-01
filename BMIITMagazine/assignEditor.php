<?php
include './connection.php';
if (isset($_POST["btnSubmit"])) {
    if(isset($_GET["type"])){
        $type=TRUE;
        $query = "update tblarticles set editorId=" . $_POST["editorId"] . ",isApproved=7 where id=" . $_GET["id"];
    }
    else{
        $type=FALSE;
        $query = "update tblarticles set editorId=" . $_POST["editorId"] . ",isApproved=0 where id=" . $_GET["id"];
    }
    echo $query;
    if ($con->query($query)) {
        $query = "select * from tblnotification where type=7 and studentId=".$_POST["editorId"];
        $result = $con->query($query);
        if ($result->num_rows == 0) {
            $query = "insert into tblnotification(text,isReaded,otherData,type,studentId) value('New Upload Article requests from student',0,'assignedArticle.php',7,".$_POST["editorId"].")";
            $con->query($query);
        }
        if($type){
            header("location: updateRequest.php");
        }
        else{
            header("location: uploadRequest.php");
        }
    }
}
