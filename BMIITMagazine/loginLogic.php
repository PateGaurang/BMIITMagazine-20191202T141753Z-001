<?php

$loginErr = $username = $password = "";
if (isset($_POST["btnLogin"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];
    if (is_numeric($username)) {
        //echo $username . "<br>" . $password . "<br>";
        $query = "select * from tblstudent where contactNo=$username and password=SHA1('$password') and isExUser=0 and isEditor in(0,2,4)";
        $result = $con->query($query);
        //echo $query . "<br>";
        //echo $_SESSION["issueId"];
        if ($result->num_rows == 1) {
            $_SESSION["username"] = $username;
            $_SESSION["usertype"] = "Student";
            header("location: studentHome.php");
        }
        $query = "select * from tblstudent where contactNo=$username and password=SHA1('$password') and isEditor=1 and isExUser=0";
        $result = $con->query($query);
        if ($result->num_rows == 1) {
            $_SESSION["username"] = $username;
            $_SESSION["usertype"] = "Editor";
            header("location: editorHome.php");
        }
        $query = "select * from tblstudent where contactNo=$username and password=SHA1('$password') and isEditor=3 and isExUser=0";
        $result = $con->query($query);
        if ($result->num_rows == 1) {
            $_SESSION["username"] = $username;
            $_SESSION["usertype"] = "Photographer";
            header("location: photographerHome.php");
        }
        $query = "select * from tbluser where contactNo=$username and password=SHA1('$password') and isActive=1";
        $result = $con->query($query);
        if ($result->num_rows == 1) {
            $_SESSION["username"] = $username;
            $_SESSION["usertype"] = "User";
            header("location: userHome.php");
        } else {
            $loginErr = "Invalid username or password";
            echo "<script type='text/javascript'>
$(document).ready(function(){
$('#myModal').modal('show');
});
</script>";
        }
    } else {
        $query = "select * from tbladmin where username='$username' and password=SHA1('$password')";
        $result = $con->query($query);
        if ($result->num_rows == 1) {
            $_SESSION["username"] = $username;
            $_SESSION["usertype"] = "Admin";
            header("location: adminHome.php");
        } else {
            $loginErr = "Invalid username or password";
            echo "<script type='text/javascript'>
$(document).ready(function(){
$('#myModal').modal('show');
});
</script>";
        }
    }
}
if (isset($_POST["btnSignup"])) {
    $type = $_POST["type"];
    $contactNo = $_POST["contactNo"];
    $fname = $_POST["firstName"];
    $lname = $_POST["lastName"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    if ($type == "student") {
        $eno = $_POST["enrollmentNo"];
        $isEditor = 0;
        $isExUser = 1;
        $stmt = "insert into tblstudent(contactNo,fname,lname,email,enrollmentNo,password,isEditor,isExUser) values(?,?,?,?,?,SHA1(?),?,?)";
    } else {
        $isActive = 0;
        $stmt = "insert into tbluser(contactNo,fname,lname,email,password,isActive) values(?,?,?,?,SHA1(?),?)";
    }
    $query = $con->prepare($stmt);
    if ($type == "student") {
        $query->bind_param("isssisii", $contactNo, $fname, $lname, $email, $eno, $password, $isEditor, $isExUser);
    } else {
        $query->bind_param("issssi", $contactNo, $fname, $lname, $email, $password, $isActive);
    }
    if ($query->execute()) {
        require_once './Email.php';
        $to = $email;
        $email = new Email();
        $from = "BMIIT Chronicles";
        $subject = "BMIIT Chronicle Registration Confirmaion";
        $message = "<html><body>Hello " . $fname . " " . $lname . ",<br>"
                . "Thank you for registering BMIIT Chronicles, In order to complete your signup please click below link"
                . "<br><br>"
                . "<a href='http://" . $_SERVER["HTTP_HOST"] . "/BMIITMagazine/confirmUser.php?acdnsadasd=asdbjasdbajusbdasjdbasyhdvasdnabjzbhas&username=$contactNo&type=$type'>Click Me</a>"
                . "</body></html>";
        $email->send($from, $subject, $message, $to);
        echo "<script type='text/javascript'>
                $(document).ready(function(){
                $('#modalConfirmation').modal('show');
                });
              </script>";
    }
}
if (isset($_POST["btnForgot"])) {
    $contactNo = $_POST["forgotUsername"];
    $query = "select * from tblstudent where contactNo=$contactNo";
    $result = $con->query($query);
    if ($result->num_rows == 1) {
        $row = $result->fetch_array();
        $type=1;
        $to = $row["email"];
    } else {
        $query = "select * from tbluser where contactNo=$contactNo";
        $result = $con->query($query);
        $row = $result->fetch_array();
        $to = $row["email"];
        $type=2;
    }
    require_once './Email.php';
    $email = new Email();
    $from = "16mscit051@gmail.com";
    $subject = "Reset Password";
    $message = "<html><body>Please Click on link below to reset your password<br><br><a href='http://" . $_SERVER["HTTP_HOST"] . "/BMIITMagazine/resetPassword.php?aasdasd=asdasdasdashjbjdasdbasjdjabsdjbajsdbasjbd&username=$contactNo&type=$type&asdcsa=asdsadasdasdmkasdmkasdkasmdkasmksdkasmdkamskmas'>Click Me</a></body></html>";
    $email->send($from, $subject, $message, $to);
    ?>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <?php
    echo "<script>swal('We Sent you a reset password link to your email','','info');</script>";
}
?>