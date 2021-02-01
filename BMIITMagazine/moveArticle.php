<?php
session_start();
include './connection.php';
if (isset($_SESSION["username"]) || isset($_SESSION["usertype"])) {
    $usertype = $_SESSION["usertype"];
    if ($usertype == "Admin") {
        ?> 
        <!DOCTYPE html>

        <html class="no-js" lang="en">

            <head>
                <meta charset="utf-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <title>Transfer Articles</title>
                <meta name="description" content="Sufee Admin - HTML5 Admin Template">
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <link rel="icon" href="img/UTU_logo.png">

                <link rel="apple-touch-icon" href="apple-icon.png">
                <link rel="shortcut icon" href="favicon.ico">

                <link rel="stylesheet" href="vendors/bootstrap/dist/css/bootstrap.min.css">
                <link rel="stylesheet" href="vendors/font-awesome/css/font-awesome.min.css">
                <link rel="stylesheet" href="vendors/themify-icons/css/themify-icons.css">
                <link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css">
                <link rel="stylesheet" href="vendors/selectFX/css/cs-skin-elastic.css">
                <link rel="stylesheet" href="vendors/jqvmap/dist/jqvmap.min.css">
                <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">

                <link rel="stylesheet" href="assets/css/style.css">
                <script src="./js/jquery-3.1.1.min.js"></script>
                <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
            </head>

            <body>
                <?php
                if (isset($_POST["btnSubmit"])) {
                    $newIssueId = $_POST["newIssue"];
                    $articleId = $_POST["articleId"];
                    //echo "<script>alert('$articleId')</script>";
                    $query = "update tblarticles set magazineId=$newIssueId where id=$articleId";
                    if ($con->query($query)) {
                        
                    }
                }
                ?>
                <?php
                if (isset($_COOKIE["selectedIssue"])) {
                    $selectIsuue = $_COOKIE["selectedIssue"];
                } else {
                    $selectIsuue = "";
                }
                ?>
                <?php
                include './adminMaster.php';
                ?>
                <div id="right-panel" class="right-panel">
                    <?php
                    include './adminMenu.php';
                    ?>
                    <div id="content">
                        <div class="container">
                            <center>
                                <h2>Transfer Article</h2><br>
                                <div class="col-sm-4 col-md-4 col-lg-4"></div>
                                <div class="form-group col-sm-4 col-md-4 col-lg-4">
                                    <select id="issueCover" class="form-control">
                                        <option>--Select Issue--</option>
                                        <?php
                                        $query = "select * from tblmagazineissues";
                                        $result = $con->query($query);
                                        if ($result->num_rows != 0) {
                                            while ($row = $result->fetch_array()) {
                                                if ($row["id"] == $selectIsuue) {
                                                    ?>
                                                    <option value="<?php echo $row["id"]; ?>" selected="true"><?php echo $row["title"]; ?></option>
                                                    <?php
                                                } else {
                                                    ?>
                                                    <option value="<?php echo $row["id"]; ?>"><?php echo $row["title"]; ?></option>
                                                    <?php
                                                }
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </center>
                            <center>
                                <div id="articleData">
                                    <?php
                                    if (isset($_COOKIE["selectedIssue"])) {
                                        $query = "select * from tblarticles where magazineId=" . $_COOKIE["selectedIssue"];
                                        $result = $con->query($query);
                                        if ($result->num_rows != 0) {
                                            ?>
                                            <table class='table table-bordered' id='dataTable'>
                                                <thead class='table-dark'>
                                                    <tr>
                                                        <th>Title</th>
                                                        <th>Keyword</th>
                                                        <th>Cover Image</th>
                                                        <th>Publishing Date</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    while ($row = $result->fetch_array()) {
                                                        ?>
                                                        <tr>
                                                            <td><?php echo $row["title"]; ?></td>
                                                            <td><?php echo $row["keyword"]; ?></td>
                                                            <td><img src='<?php echo $row["coverImage"]; ?>' style='height:70px; width:100px;'></td>
                                                            <td><?php echo $row["publishingDate"]; ?></td>
                                                            <td>
                                                                <?php
                                                                $query = "select * from tblmagazineissues where id!=" . $_COOKIE["selectedIssue"];
                                                                $result1 = $con->query($query);
                                                                if ($result1->num_rows != 0) {
                                                                    echo "<form action='#' method='post'>";
                                                                    echo "<input type='hidden' name='articleId' value='" . $row["id"] . "'>";
                                                                    echo "<select name='newIssue'>";
                                                                    while ($row1 = $result1->fetch_array()) {
                                                                        echo "<option value='" . $row1["id"] . "'>" . $row1["title"] . "</option>";
                                                                    }
                                                                    echo "</select>";
                                                                    echo "&nbsp;&nbsp;&nbsp;<input type='submit' name='btnSubmit' class='btn btn-primary' value='Transfer'>";
                                                                    echo "</form>";
                                                                } else {
                                                                    echo "No Other Issues";
                                                                }
                                                                ?>
                                                            </td>
                                                        </tr>
                                                        <?php
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                            <?php
                                        } else {
                                            echo "<br><p>No Articles Avalible to Show</p>";
                                        }
                                        ?>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </center>
                        </div>
                    </div>
                </div>
                <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
                <script src="assets/js/main.js"></script>
                <script src="vendors/popper.js/dist/umd/popper.min.js"></script>
                <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>

            </body>

        </html>

        <?php
    }
} else {
    header("Location: index.php");
}