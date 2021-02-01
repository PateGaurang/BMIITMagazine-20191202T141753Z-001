<?php
require './connection.php';
if (isset($_POST["issueId"])) {
    $issueId = $_POST["issueId"];
    if ($issueId != "--Select Issue--") {
        $query = "select * from tblarticles where magazineId=$issueId";
        $result = $con->query($query);
        if ($result->num_rows != 0) {
            setcookie("selectedIssue", $issueId);
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
                                $query = "select * from tblmagazineissues where id!=$issueId";
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
    } else {
        echo "<br><p>Please Select a Issue to see articles</p>";
    }
}
