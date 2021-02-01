<script src="./js/jquery.validate.min.js"></script>
<script src="./js/additional-methods.js"></script>
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
                    </ul>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-6 header-top-right no-padding">
                    <ul>
                        <li><a href="#" data-toggle="modal" data-target="#modalRegisterForm"><span class="lnr lnr-user"></span><span>Signup</span></a></li>
                        <li><a href="#" data-toggle="modal" data-target="#myModal"><span class="lnr lnr-enter"></span><span>Login</span></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Login</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">
                    <form action="#" method="post" class="login100-form validate-form p-b-33 p-t-5">
                        <div class="wrap-input100 validate-input" data-validate = "Enter username">
                            <input class="input100" type="text" name="username" placeholder="User name" value="<?php echo $username; ?>">
                            <span class="focus-input100" data-placeholder="&#xe82a;"></span>
                        </div>
                        <div class="wrap-input100 validate-input mb-3" data-validate="Enter password">
                            <input class="input100" type="password" name="password" placeholder="Password">
                            <span class="focus-input100" data-placeholder="&#xe80f;"></span>
                        </div>
                        <div class="mb-2">
                            <center>
                                <span style="color:red;"><?php echo $loginErr; ?></span>
                            </center>
                        </div>
                        <div>
                            <center>
                                <?php
                                if (!empty($loginErr)) {
                                    ?>
                                    Please Click Here if you <a href="#" class="modalLink" id="forgotenPassword">forgot password</a><br><br>
                                    <?php
                                }
                                ?>
                                Not a member yet,<a href="#" id="signUpBtn" class="modalLink">Signup now</a>
                            </center>
                        </div>
                        <div class="container-login100-form-btn m-t-32">
                            <input type="submit" class="login100-form-btn" name="btnLogin" value="Login">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $('input[type=radio][name=type]').change(function () {
                if (this.value == 'user') {
                    $("#enrollNo").html("");
                } else if (this.value == 'student') {
                    $("#enrollNo").html("<div class='md-form mb-3'><input type='text' class='form-control' id='enrollmentNo' name='enrollmentNo' placeholder='Enrollment Number'></div>");
                }
            });
            $("#signUpBtn").on("click", function () {
                $('#myModal').modal('hide');
                $('#modalRegisterForm').modal('show');
            });
            $("#forgotenPassword").on("click", function () {
                $("#myModal").modal('hide');
                $("#forgotPassword").modal('show');
            });

        });
    </script>
    <script>
        $(document).ready(function () {
            $("#signUp").validate({
                errorLabelContainer: ".error",
                rules: {
                    firstName: {
                        required: true,
                        alphabet: true
                    },
                    lastName: {
                        required: true,
                        alphabet: true
                    },
                    contactNo: {
                        required: true,
                        number: true,
                        minlength: 10,
                        maxlength: 10,
                        remote: {
                            url: 'userExists.php',
                            type: 'post'
                        }
                    },
                    email: {
                        required: true,
                        email: true,
                        remote: {
                            url: 'userExists.php',
                            type: 'post'
                        }
                    },
                    enrollmentNo: {
                        required: true,
                        number: true,
                        minlength: 15,
                        maxlength: 15,
                        enrollmentNo: true,
                        remote: {
                            url: 'userExists.php',
                            type: 'post'
                        }
                    },
                    password: {
                        required: true,
                        minlength: 5
                    },
                    conPassword: {
                        required: true,
                        minlength: 5,
                        equalTo: "#password"
                    }
                },
                messages: {
                    firstName: {
                        required: "Please Enter your first name",
                        alphabet: "First name only contains Albhabets only"
                    },
                    lastName: {
                        required: "Please Enter your last name",
                        alphabet: "Last name only contains Albhabets only"
                    },
                    contactNo: {
                        required: "Please Enter your contact number",
                        minlength: "Contact Number must contain only 10 numbers",
                        maxlength: "Contact Number must contain only 10 numbers",
                        number: "Please enter only numbers",
                        remote: "Mobile Number is already registered to another account"
                    },
                    email: {
                        required: "Please Enter your email",
                        email: "Please enter a valid email address",
                        remote: "Email you entered is already in use by another user"
                    },
                    enrollmentNo: {
                        required: "Please Enter your enrollment number",
                        minlength: "Enrollment Number must contain only 15 numbers",
                        maxlength: "Enrollment Number must contain only 15 numbers",
                        number: "Please enter only numbers",
                        remote: "Enrollment number is already registerd to another account"
                    },
                    password: {
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
            $("#forgotPasswords").validate({
                errorLabelContainer: ".error",
                rules: {
                    forgotUsername: {
                        required: true,
                        number: true,
                        remote: {
                            url: 'userExists.php',
                            type: 'post'
                        }
                    }
                },
                messages: {
                    forgotUsername: {
                        required: "Please Enter your Username",
                        number: "User name contains only numbers",
                        remote: "username you enter dose not exists"
                    }
                },
                submitHandler: function (form) {
                    form.submit();
                }
            });
        });
    </script>
    <div class="modal fade" id="modalConfirmation" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body mx-3">
                    <p>In order to complete your registration please confirm your email</p>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalRegisterForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h4 class="modal-title w-100 font-weight-bold">Sign up</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body mx-3">
                    <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post" id="signUp">
                        <div class="md-form mb-3">
                            <center>
                                <input type="radio" id="utype" name="type" value="user" checked="true">User&nbsp;&nbsp;
                                <input type="radio" id="utype" name="type" value="student">Student
                            </center>
                        </div>
                        <div class="md-form mb-3">
                            <input type="text" class="form-control" id="firstName" name="firstName" placeholder="First Name">
                        </div>
                        <div class="md-form mb-3">
                            <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Last Name">
                        </div>
                        <div class="md-form mb-3">
                            <input type="text" class="form-control" id="contactNo" name="contactNo" placeholder="Contact Number">
                        </div>
                        <div class="md-form mb-3">
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email Address">
                        </div>
                        <div id="enrollNo">
                        </div>
                        <div class="md-form mb-3">
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                        </div>
                        <div class="md-form mb-3">
                            <input type="password" class="form-control" id="conPassword" name="conPassword" placeholder="Confirm Password">
                        </div>
                        <div class="md-form mb-3">
                            <center>
                                <button class="btn btn-reply" type="submit" name="btnSignup">Sign up</button>
                            </center>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="forgotPassword" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h4 class="modal-title w-100 font-weight-bold">Forgot Password</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body mx-3">
                    <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post" id="forgotPasswords">
                        <div class="md-form mb-3">
                            <input type="text" class="form-control" id="forgotUsername" name="forgotUsername" placeholder="Contact Number">
                        </div>
                        <div class="md-form mb-3">
                            <center>
                                <button class="btn btn-reply" type="submit" name="btnForgot">Submit</button>
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
                    <a href="index.php"><h2 style="margin-top: 2%;"><span style="color: red ">BMIIT</span> <span style="color: #0000000;">CHRONICLES</span>  </h2></a>
                </div>			
            </div>
        </div>
    </div>
    <div class="container main-menu" id="main-menu">
        <div class="row align-items-center justify-content-between">
            <nav id="nav-menu-container">
                <ul class="nav-menu">
                    <li class="menu-active"><a href="index.php">Home</a></li>
                    <li><a href="archive.php">Archive</a></li>			
                    <li><a href="about.php">About</a></li>
                    <li><a href="contact.php">Contact</a></li>
                </ul>
            </nav>

        </div>
    </div>
</header>
