<?php
session_start();
require_once 'connection.php';
$title = $keyword = $text = $coverImage = $secondImage = $fileName = $tempName = $type = $filePath = $secondFileName = $secondTempName = $secondFileType = "";
$titleErr = $keywordErr = $coverImageErr = $articleTextErr = $secondImageErr = "";
$articleId = $_GET["id"];
$query = "select * from tblarticles where id=$articleId";
$result = $con->query($query);
$row = $result->fetch_array();
$title = $row["title"];
$keyword = $row["keyword"];
$text = $row["text"];
$coverImage = $row["coverImage"];
$isApproved = $row["isApproved"];
if (isset($_POST["btnSubmit"])) {
    $flag = true;
    $title = $_POST["title"];
    $keyword = $_POST["keyword"];
    $articleText = $_POST["articleText"];
    if (empty($title)) {
        $titleErr = "Please Enter Article Title";
        $flag = false;
    }
    if (empty($keyword)) {
        $keywordErr = "Please Enter a keyword for Article";
        $flag = false;
    }
    if (isset($_FILES["coverImage"]["name"])) {
        $fileName = $_FILES["coverImage"]['name'];
        $tempName = $_FILES["coverImage"]["tmp_name"];
        $type = $_FILES["coverImage"]["type"];
        if ($type == "image/png" || $type == "image/jpg" || $type == "image/jpeg") {
            $firstPath = "./uploads/" . $_SESSION["issueId"] . "/" . $lastId . "/";
            move_uploaded_file($tempName, $firstPath . $fileName);
            $coverImage = $firstPath . $fileName;
        }
    }
    if (empty($articleText)) {
        $articleTextErr = "Please Enter Your Article";
        $flag = false;
    }
    if ($flag) {
        $date = date("Y-m-d");
        if ($isApproved != 1) {
            $stmt = "update tblarticles set title='$title',editorId=0,lastModification='$date',keyword='$keyword',text=?,coverImage='$coverImage',isApproved=0 where id=$articleId";            
            $type = 1;
        } else {
            $stmt = "update tblarticles set title='$title',editorId=0,lastModification='$date',keyword='$keyword',text=?,coverImage='$coverImage',isApproved=3 where id=$articleId";
            $type = 2;
        }
        $query = $con->prepare($stmt);
        $query->bind_param('s', $articleText);
        if ($query->execute()) {
            if ($type == 1) {
                $query = "select * from tblnotification where type=1";
                $result = $con->query($query);
                if ($result->num_rows == 0) {
                    $query = "insert into tblnotification(text,isReaded,otherData,type) value('New Upload Article requests from student',0,'uploadRequest.php',1)";
                    $con->query($query);
                }
            }
            else{
                $query = "select * from tblnotification where type=2";
                $result = $con->query($query);
                if ($result->num_rows == 0) {
                    $query = "insert into tblnotification(text,isReaded,otherData,type) value('New Update Article requests from student',0,'updateRequest.php',2)";
                    $con->query($query);
                }
            }
            header("location: articleHistory.php");
        }
    }
}
if (isset($_POST["btnCancel"])) {
    header("location: articleHistory.php");
}
?>
<?php
if (isset($_SESSION["username"]) && isset($_SESSION["usertype"])) {
    $usertype = $_SESSION["usertype"];
    //echo $_SESSION["username"];
    if ($usertype == "Student" || $usertype == "Editor" || $usertype == "Photographer") {
        if (!isset($_GET["id"])) {
            header("location: articleHistory.php");
        }
        ?> 
        <!DOCTYPE html>
        <html>
            <head>
                <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
                <link rel="shortcut icon" href="img/fav.png">
                <meta name="author" content="BMIIT">
                <meta name="description" content="">
                <meta name="keywords" content="">
                <link rel="icon" href="img/UTU_logo.png">
                <meta charset="UTF-8">
                <title>Update Article</title>
                <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,400,300,500,600,700" rel="stylesheet">
                <link rel="stylesheet" href="css/linearicons.css">
                <link rel="stylesheet" href="css/font-awesome.min.css">
                <link rel="stylesheet" href="css/bootstrap.css">
                <link rel="stylesheet" href="css/magnific-popup.css">
                <link rel="stylesheet" href="css/nice-select.css">
                <link rel="stylesheet" href="css/animate.min.css">
                <link rel="stylesheet" href="css/owl.carousel.css">
                <link rel="stylesheet" href="css/jquery-ui.css">
                <link rel="stylesheet" href="css/main.css">
                <script src="js/jquery-3.1.1.min.js"></script>
            </head>
            <body>
                <?php
                if ($usertype == "Student") {
                    require 'studentMasterPage.php';
                } else if ($usertype == "Editor") {
                    require './editorMaster.php';
                } else {
                    require './photographerMaster.php';
                }
                ?>
                <div class="site-main-container">
                    <section class="contact-page-area pt-50 pb-120">
                        <div class="container">
                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>?id=<?php echo $_GET["id"]; ?>" method="post" enctype="multipart/form-data">
                                <div class="row contact-wrap">
                                    <div class="col-lg-5 col-5 col-sm-5 col-md-5"></div>
                                    <div class="col-lg-4 col-4 col-sm-4 col-md-4">
                                        <h2>Upload Article</h2>
                                    </div>
                                </div>
                                <div class="row contact-wrap">
                                    <div class="col-2 col-sm-2 col-md-2 col-lg-2 col-xl-2">
                                        <label for="title" class="form-text float-lg-right">Title:</label>
                                    </div>
                                    <div class="col-8 col-sm-8 col-md-8 col-lg-8 col-xl-8">
                                        <input type="text" value="<?php echo $title; ?>" name="title" placeholder="Article Title" class="form-control">
        <?php
        if ($titleErr != "") {
            echo "<br><span class='errorColor'>$titleErr</span>";
        }
        ?>
                                    </div>
                                </div>
                                <div class="row contact-wrap">
                                    <div class="col-2 col-sm-2 col-md-2 col-lg-2 col-xl-2">
                                        <label for="Keyword" class="form-text float-lg-right">Keyword:</label>
                                    </div>
                                    <div class="col-8 col-sm-8 col-md-8 col-lg-8 col-xl-8">
                                        <input type="text" value="<?php echo $keyword; ?>" name="keyword" placeholder="Article Keyword" class="form-control">
        <?php
        if ($keywordErr != "") {
            echo "<br><span class='errorColor'>$keywordErr</span>";
        }
        ?>
                                    </div>
                                </div>
                                <div class="row contact-wrap">
                                    <div class="col-2 col-sm-2 col-md-2 col-lg-2 col-xl-2">
                                        <label for="articleText" class="form-text float-lg-right">Text:</label>
                                    </div>
                                    <div class="col-8 col-sm-8 col-md-8 col-lg-8 col-xl-8">
                                        <textarea class="form-control" name="articleText" placeholder="Article Text.." rows='20'><?php echo $text; ?></textarea>
        <?php
        if ($articleTextErr != "") {
            echo "<br><span class='errorColor'>$articleTextErr</span>";
        }
        ?>
                                    </div>
                                </div>
                                <div class="row contact-wrap">
                                    <div class="col-2 col-sm-2 col-md-2 col-lg-2 col-xl-2">
                                        <label for="title" class="form-text float-lg-right">Old Cover Image:</label>
                                    </div>
                                    <div class="col-8 col-sm-8 col-md-8 col-lg-8 col-xl-8">
                                        <img src="<?php echo $coverImage; ?>" class="img-fluid">
                                    </div>
                                </div>
                                <div class="row contact-wrap">
                                    <div class="col-2 col-sm-2 col-md-2 col-lg-2 col-xl-2">
                                        <label for="title" class="form-text float-lg-right">Cover Image:</label>
                                    </div>
                                    <div class="col-8 col-sm-8 col-md-8 col-lg-8 col-xl-8">
                                        <input type="file" name="coverImage" class="form-control-file">
        <?php
        if ($coverImageErr != "") {
            echo "<br><span class='errorColor'>$coverImageErr</span>";
        }
        ?>
                                    </div>
                                </div>
                                <div class="row contact-wrap">
                                    <div class="col-4 col-sm-4 col-md-4 col-lg-4 col-xl-4"></div>
                                    <div class="col-2 col-sm-2 col-md-2 col-lg-2 col-xl-2">
                                        <input type="submit" name="btnSubmit" value="Submit Article" class="btn primaryBtn">
                                    </div>
                                    <div class="col-2 col-sm-2 col-md-2 col-lg-2 col-xl-2">
                                        <input type="submit" name="btnCancel" value="Cancel" class="btn primaryBtn">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </section>
                </div>
        <?php
        include './footerMaster.php';
        ?>
            </body>
        </html>
        <?php
    }
} else {
    header("location: index.php");
}