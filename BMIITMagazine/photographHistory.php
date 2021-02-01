<?php
session_start();
include './connection.php';
if (isset($_SESSION["username"]) || isset($_SESSION["usertype"])) {
    $usertype = $_SESSION["usertype"];
    if ($usertype == "Photographer") {
        ?>   
        <!DOCTYPE html>
        <html lang="zxx" class="no-js">
            <head>
                <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
                <link rel="shortcut icon" href="img/fav.png">
                <meta name="author" content="colorlib">
                <link rel="icon" href="img/UTU_logo.png">
                <meta name="description" content="">
                <meta name="keywords" content="">
                <meta charset="UTF-8">
                <title>Photograph History</title>
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
            </head>
            <body>                
                <?php
                include './photographerMaster.php';
                ?>
                <div class="site-main-container">
                    <section class="contact-page-area pt-50 pb-120">
                        <div class="container">
                            <div class="row contact-wrap">
                                <div class="col-lg-5 col-5 col-sm-5 col-md-5"></div>
                                <div class="col-lg-4 col-4 col-sm-4 col-md-4">
                                    <h2>Photograph History</h2>
                                </div>
                            </div>
                            <?php
                            $query = "select * from tblphotographs where pid=" . $_SESSION["username"];
                            $result = $con->query($query);
                            if ($result->num_rows != 0) {
                                ?>
                                <div class="row contact-wrap">
                                    <table class="table table-hover">
                                        <tr>
                                            <th>Title</th>
                                            <th>Cover Image</th>
                                            <th>Status</th>
                                            <th></th>
                                        </tr>
                                        <?php
                                        while ($row = $result->fetch_array()) {
                                            $temp = $row["isSelected"];
                                            if ($temp == 1 || $temp == 2 || $temp == 3) {
                                                $status = "In Use";
                                            }else {
                                                $status = "Not in Use";
                                            }
                                            ?>
                                            <tr>
                                                <td><?php echo $row["title"]; ?></td>
                                                <td><img src='<?php echo $row["coverImage"]; ?>' style='height:70px; width:100px;'></td>
                                                <td><?php echo $status; ?></td>
                                                <?php
                                                if($status=="Not in Use"){
                                                ?>
                                                <td><a href="updatePhotograph.php?id=<?php echo $row["id"]; ?>"><i class="fa fa-edit" style="font-size: 24px; margin-top: 15px; color:#f6214b;"></i></a></td>
                                                <?php
                                                }
                                                else{
                                                    ?>
                                                <td><a href="#" onclick="alert('Photograph is in use so can not modify it');"><i class="fa fa-edit" style="font-size: 24px; margin-top: 15px; color:#f6214b;"></i></a></td>
                                                <?php
                                                }
                                                ?>
                                            </tr>
                                        <?php } ?>
                                    </table>
                                </div>
                                <?php
                            } else {
                                ?>
                                <div class="row contact-wrap">
                                    <div class="col-lg-4 col-4 col-sm-4 col-md-4"></div>
                                    <div class="col-lg-6 col-6 col-sm-6 col-md-6">
                                        <h4>When you upload articles it will appear here</h4>
                                    </div>
                                </div>
                                <?php
                            }
                            ?>
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
    header("Location: index.php");
}