<script src="./js/jquery-3.1.1.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="./js/jquery.validate.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="js/vendor/bootstrap.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBhOdIF3Y9382fqJYt5I_sswSrEw5eihAA"></script>
<script src="js/easing.min.js"></script>
<script src="js/hoverIntent.js"></script>
<script src="js/superfish.min.js"></script>
<script src="js/jquery.ajaxchimp.min.js"></script>
<script src="js/jquery.magnific-popup.min.js"></script>
<script src="js/mn-accordion.js"></script>
<script src="js/jquery-ui.js"></script>
<script src="js/jquery.nice-select.min.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script src="js/mail-script.js"></script>
<script src="js/main.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<header>
    <div class="header-top">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-6 header-top-left no-padding">
                    <ul>
                        <li><a href="https://www.facebook.com/utu.malibacampus/" target="_blank"><i class="fa fa-facebook" style="font-size: 16px;"></i></a></li>
                        <li><a href="https://www.instagram.com/bmiit.utu/" target="_blank"><i class="fa fa-instagram" style="font-size: 16px;"></i></a></li>
                        <li><a href="https://twitter.com/utumalibacampus" target="_blank"><i class="fa fa-twitter" style="font-size: 16px;"></i></a></li>
                        <li class="dropdown">
                            <?php
                                $query="select * from tblnotification where studentId=".$_SESSION["username"];
                                $result=$con->query($query);
                                if($result->num_rows==0){
                                    ?>
                            <a href="#" data-toggle="dropdown"><i class="fa fa-bell-o" style="font-size: 16px;"></i></a>
                            <?php
                                }
                                else{
                            ?>
                            <a href="#" data-toggle="dropdown" class="dropdown"><i class="fa fa-bell notify" style="font-size: 16px;" data-count="<?php echo $result->num_rows; ?>"></i></a>
                            <ul class="dropdown-menu">
                                <?php
                                    while($row=$result->fetch_array()){
                                ?>
                                <li class="dropdown-item"><a href="notificationRedirector.php?type=<?php echo $row["type"]; ?>&username=<?php echo $_SESSION["username"]; ?>" class="link"><?php echo $row["text"]; ?></a></li>
                                <?php
                                    }
                                ?>
                            </ul>
                            <?php
                                }
                            ?>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-6 header-top-right no-padding">
                    <ul>
                         <?php
                        $query="select * from tblstudent where contactNo=".$_SESSION["username"];
                        $result=$con->query($query);
                        $row=$result->fetch_array();
                        $name=$row["fname"]." ".$row["lname"];
                        ?>
                        <li><span style="color: white;">Welcome, <?php echo $name; ?></span></li>
                        <li><a href="#"  data-toggle="modal" data-target="#myModal"><span class="lnr lnr-envelope"></span><span>Change Password</span></a></li>
                        <li><a href="logout.php" ><span class="lnr lnr-phone-handset"></span><span>Logout</span></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <?php
    $formErr="";
    if (isset($_POST["btnChangePassword"])) {
        $oldPassword = $_POST["oldPassword"];
        $newPassword = $_POST["newPassword"];
        $contactNo = $_SESSION["username"];
        $query = "select * from tblstudent where contactNo=$contactNo and password=SHA1('$oldPassword')";
        $result = $con->query($query);
        if ($result->num_rows == 1) {
            $stmt = "update tblstudent set password=SHA1(?) where contactNo=$contactNo";
            $query = $con->prepare($stmt);
            $query->bind_param("s", $newPassword);
            if ($query->execute()) {
                echo "<script type='text/javascript'>
$(document).ready(function(){
$('#success').modal('show');
});
</script>";
            }
        } else {
            $formErr="You entered incorrect old password";
            echo "<script type='text/javascript'>
$(document).ready(function(){
$('#myModal').modal('show');
});
</script>";
            ?>
            <?php
        }
    }
    ?>
    <div class="modal fade" id="success" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body mx-3">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <center>
                        <p>Your Password is successfully changed</p>
                    </center>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $("#changePassword").validate({
                errorLabelContainer: ".error",
                rules: {
                    oldPassword: {
                        required: true,
                        minlength: 5
                    },
                    newPassword: {
                        required: true,
                        minlength: 5
                    },
                    conPassword: {
                        required: true,
                        minlength: 5,
                        equalTo: "#newPassword"
                    }
                },
                messages: {
                    oldPassword: {
                        required: "Please Enter your old password",
                        minlength: "Password must contain atleast 5 characters"
                    },
                    newPassword: {
                        required: "Please Enter your password",
                        minlength: "Password must contain aleast 5 characters"
                    },
                    conPassword: {
                        required: "Please Enter your password",
                        minlength: "Password must contain aleast 5 characters",
                        equalTo: "Password and Confirm password must be same"
                    }
                },
                submitHandler: function (form) {
                    form.submit();
                }
            });
        });
    </script>
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h4 class="modal-title w-100 font-weight-bold">Change Password</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body mx-3">
                    <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post" id="changePassword">
                        <div class="md-form mb-3">
                            <input type="password" class="form-control" id="oldPassword" name="oldPassword" placeholder="Old Password">
                        </div>
                        <div class="md-form mb-3">
                            <input type="password" class="form-control" id="newPassword" name="newPassword" placeholder="New Password">
                        </div>
                        <div class="md-form mb-3">
                            <input type="password" class="form-control" id="conPassword" name="conPassword" placeholder="Re-Enter New Password">
                        </div>
                        <div class="md-form mb-3" id="formErr">
                            <center>
                            <p style="color: red;"><?php echo $formErr; ?></p>
                            </center>
                        </div>
                        <div class="md-form mb-3">
                            <center>
                                <button class="btn btn-reply" type="submit" name="btnChangePassword">Change Password</button>
                            </center>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="logo-wrap">
        <div class="container">
            <div class="row justify-content-between align-items-center">
                <div class="col-lg-4 col-md-4 col-sm-12 logo-left no-padding">
                    <a href="photographerHome.php"><h2 style="margin-top: 2%;"><span style="color: red ">BMIIT</span> <span style="color: #0000000;">CHRONICLES</span>  </h2></a>
                </div>

            </div>
        </div>
    </div>
    <div class="container main-menu" id="main-menu">
        <div class="row align-items-center justify-content-between">
            <nav id="nav-menu-container">
                <ul class="nav-menu">
                    <li class="menu-active"><a href="studentHome.php">Home</a></li>
                    <li><a href="#">Manage Articles</a>
                        <ul>
                            <li><a href="uploadArticle.php">UPLODE ARTICLE</a></li>
                            <li><a href="articleHistory.php">ARTICLE HISTORY</a></li>
                        </ul>
                    </li>
                    <li><a href="#">Manage Photographs</a>
                        <ul>
                            <li><a href="uploadPhotograph.php">UPLOAD PHOTOGRAPHS</a></li>
                            <li><a href="photographHistory.php">PHOTOGRAPHS HISTORY</a></li>
                        </ul>
                    </li>

                    <li><a href="archive.php">Archive</a></li>
                    <li><a href="about.php">About</a></li>
                    <li><a href="contact.php">Contact</a></li>
                </ul>
            </nav>
        </div>
    </div>
</header>
