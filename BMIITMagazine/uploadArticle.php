<?php
session_start();
require_once 'connection.php';
?>
<?php
if (isset($_SESSION["username"]) && isset($_SESSION["usertype"])) {
    $usertype = $_SESSION["usertype"];
    if ($usertype == "Student" || $usertype == "Editor" || $usertype == "Photographer") {
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
                <title>Upload Article</title>
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
                $success=FALSE;
                $isExtra = "y";
                $title=$keyword=$articleText="";
                $fileName = $tempName = $type = $filePath = "";
                $titleErr = $keywordErr = $coverImageErr = $articleTextErr = "";
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
                    if (!empty($_FILES["coverImage"]["name"])) {
                        $fileName = $_FILES["coverImage"]['name'];
                        $tempName = $_FILES["coverImage"]["tmp_name"];
                        $type = $_FILES["coverImage"]["type"];
                        $filePath = "./uploads/1/";
                        if ($type == "image/png" || $type == "image/jpg" || $type == "image/jpeg") {
                            
                        } else {
                            $coverImageErr = "Please Upload only jpg or png format photo";
                            $flag = false;
                        }
                    } else {
                        $coverImageErr = "Please Upload a cover image for article";
                    }
                    if (empty($articleText)) {
                        $articleTextErr = "Please Enter Your Article";
                        $flag = false;
                    }
                    if ($flag) {
                        $date = date("Y-m-d");
                        $stmt="insert into tblarticles(publishingDate,studentId,magazineId,title,keyword,text,lastModification,isDelete,editorId,isFeatured,isApproved) values('" . $date . "'," . $_SESSION["username"] . "," . $_SESSION["issueId"] . ",?,?,?,'" . $date . "',0,0,0,0)";
                        $query = $con->prepare($stmt);
                        $query->bind_param('sss',$title,$keyword, $articleText);
                        if ($query->execute()) {
                            $lastId = $con->insert_id;
                            $firstPath = "./uploads/" . $_SESSION["issueId"] . "/" . $lastId . "/";
                            if (!file_exists($firstPath)) {
                                mkdir($firstPath, 0777, TRUE);
                            }
                            //echo $firstPath . $fileName;
                            move_uploaded_file($tempName, $firstPath . $fileName);
                            $query = "update tblarticles set coverImage='$firstPath$fileName' where id=$lastId";
                            $con->query($query);
                            $success=TRUE;
                            $query="select * from tblnotification where type=1";
                            $result=$con->query($query);
                            if($result->num_rows==0){
                                $query="insert into tblnotification(text,isReaded,otherData,type) value('New Upload Article requests from student',0,'uploadRequest.php',1)";
                                $con->query($query);
                            }
                            $title=$keyword=$articleText="";
                        }
                    }
                }
                ?>
                <?php
                if ($usertype == "Student") {
                    require 'studentMasterPage.php';
                } else if ($usertype == "Editor") {
                    require './editorMaster.php';
                }
                else{
                    require './photographerMaster.php';
                }
                ?>
                <div class="site-main-container">
                    <section class="contact-page-area pt-50 pb-120">
                        <div class="container">
                            <?php
                                if ($success) {
                                    ?>
                                        <div class="alert alert-success alert-dismissible">
                                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                                            Article uploaded successfully
                                        </div>
                                    <?php
                                }
                                ?>
                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
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
                                        <input type="text" name="title" placeholder="Article Title" class="form-control" value="<?php echo $title; ?>">
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
                                        <input type="text" name="keyword" placeholder="Article Keyword" class="form-control" value="<?php echo $keyword; ?>">
                                        <?php
                                        if ($keywordErr != "") {
                                            echo "<br><span class='errorColor'>$keywordErr</span>";
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="row contact-wrap">
                                    <div class="col-2 col-sm-2 col-md-2 col-lg-2 col-xl-2">
                                        <label for="title" class="form-text float-lg-right">Text:</label>
                                    </div>
                                    <div class="col-8 col-sm-8 col-md-8 col-lg-8 col-xl-8">
                                        <textarea class="form-control" name="articleText" placeholder="Article Text.." rows='20'><?php echo $articleText; ?></textarea>
                                        <?php
                                        if ($articleTextErr != "") {
                                            echo "<br><span class='errorColor'>$articleTextErr</span>";
                                        }
                                        ?>
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
                                        <input type="reset" value="Reset" class="btn primaryBtn">
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
ob_end_flush();

