<header id="header" class="header">
    <?php
    $query = "select * from tblnotification where type in(1,2,3,4,5)";
    $result = $con->query($query);
    ?>
    <div class="header-menu">        
        <div class="col-sm-7">
            <a id="menuToggle" class="menutoggle pull-left"><i class="fa fa fa-tasks"></i></a>
            <div class="header-left">
                <div class="dropdown for-notification">
                    <?php
                    if ($result->num_rows != 0) {
                        ?>
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="notification" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-bell"></i>
                            <span class="count bg-danger"><?php echo $result->num_rows; ?></span>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="notification">
                            <?php
                            while ($row = $result->fetch_array()) {
                                $type = $row["type"];
                                ?>
                                <a class="dropdown-item" id="notificationLink" href="notificationRedirector.php?type=<?php echo $type; ?>">
                                    <p><?php echo $row["text"]; ?></p>
                                </a>
                                <?php
                            }
                            ?>
                        </div>
                        <?php
                    } else {
                        ?>
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="notification" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-bell-o"></i>
                        </button>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <?php
        $formErr = "";
        if (isset($_POST["btnChangePassword"])) {
            $oldPassword = $_POST["oldPassword"];
            $newPassword = $_POST["newPassword"];
            $contactNo = $_SESSION["username"];
            $query = "select * from tbladmin where username='$contactNo' and password=SHA1('$oldPassword')";
            $result = $con->query($query);
            if ($result->num_rows == 1) {
                $stmt = "update tbladmin set password=SHA1(?) where username='$contactNo'";
                $query = $con->prepare($stmt);
                $query->bind_param("s", $newPassword);
                if ($query->execute()) {
                    echo "<script>swal('Password changed successfully','','success');</script>";
                }
            } else {
                $formErr = "";
                echo "<script>swal('Failed','you entered wrong password','error');</script>";
                ?>
                <?php
            }
        }
        ?>
        <script src="./js/jquery-3.1.1.min.js"></script>
        <script src="./js/jquery.validate.min.js"></script>
        <script src="./js/additional-methods.js"></script>
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
                                    <button class="btn btn-primary" type="submit" name="btnChangePassword">Change Password</button>
                                </center>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-5">
            <div class="user-area dropdown float-right">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="user-avatar rounded-circle" src="img/user.jpg" alt="User Avatar">
                </a>

                <div class="user-menu dropdown-menu">
                    <a class="nav-link" href="#" data-toggle="modal" data-target="#myModal"><i class="fa fa-user"></i> Change Password</a>
                    <a class="nav-link" href="logout.php"><i class="fa fa-power-off"></i> Logout</a>
                </div>
            </div>
        </div>
    </div>

</header>