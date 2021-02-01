<?php
$query = "select * from tblarticles where isFeatured in(1,2,3,4) order by isFeatured";
$result = $con->query($query);
?>
<div class="col-lg-4">
    <div class="sidebars-area">
        <?php
        if ($result->num_rows > 0) {
            $row = $result->fetch_array();
            $contactNo = $row["studentId"];
            $query = "select * from tblstudent where contactNo=$contactNo";
            $result2 = $con->query($query);
            $row1 = $result2->fetch_array();
            $authorName = $row1["fname"] . " " . $row1["lname"];
            $oldDate = $row["publishingDate"];
            $newDate = date("d-m-Y", strtotime($oldDate));
            $littleText = substr($row["text"], 0, 75);
            $littleText .= "...";
            ?>
            <div class="single-sidebar-widget editors-pick-widget">
                <h6 class="title">Featured Articles</h6>
                <div class="editors-pick-post">
                    <div class="feature-img-wrap relative">
                        <div class="feature-img relative">
                            <div class="overlay overlay-bg"></div>
                            <img class="img-fluid" src="<?php echo $row["coverImage"]; ?>" alt="">
                        </div>
                        <ul class="tags">
                            <li><a href="#"><?php echo $row["keyword"]; ?></a></li>
                        </ul>
                    </div>
                    <div class="details">
                        <a href="viewArticle.php?id=<?php echo $row["id"]; ?>">
                            <h4 class="mt-20"><?php echo $row["title"]; ?></h4>
                        </a>
                        <ul class="meta">
                            <li><a href="#"><span class="lnr lnr-user"></span><?php echo $authorName; ?></a></li>
                            <li><a href="#"><span class="lnr lnr-calendar-full"></span><?php echo $newDate; ?></a></li>
                            <li><a href="#"><span class="lnr lnr-heart"></span>06</a></li>
                        </ul>
                        <p class="excert">
                            <?php
                            echo $littleText;
                            ?>
                        </p>
                    </div>
                    <div class="post-lists">
                        <?php
                        while ($row = $result->fetch_array()) {
                            $query = "select * from tblstudent where contactNo=$contactNo";
                            $result2 = $con->query($query);
                            $row1 = $result2->fetch_array();
                            $authorName = $row1["fname"] . " " . $row1["lname"];
                            $oldDate = $row["publishingDate"];
                            $newDate = date("d-m-Y", strtotime($oldDate));
                            ?>
                            <div class="single-post d-flex flex-row">
                                <div class="thumb">
                                    <img src="<?php echo $row["coverImage"]; ?>" style="height: 80px; width: 100px;" alt="">
                                </div>
                                <div class="detail">
                                    <a href="viewArticle.php?id=<?php echo $row["id"]; ?>"><h6><?php echo $row["title"]; ?></h6></a>
                                    <ul class="meta">
                                        <li><a href="#"><span class="lnr lnr-user"></span><?php echo $authorName; ?></a></li>
                                        <li><a href="#"><span class="lnr lnr-calendar-full"></span><?php echo $newDate; ?></a></li>
                                        <li><a href="#"><span class="lnr lnr-heart"></span>06 </a></li>
                                    </ul>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
            <?php
        }
        if (isset($_POST["btnSubscribe"])) {
            $flag = TRUE;
            $email = $_POST["email"];
            if (empty($email)) {
                $flag = FALSE;
            }
            if ($flag) {
                $query = "select * from tblnewsletters where email='$email'";
                $result = $con->query($query);
                if ($result->num_rows == 0) {
                    $query = "insert into tblnewsletters values('$email')";
                    if ($con->query($query)) {
                        echo "<script>swal('Your Email Rgistered Successfully','','success');</script>";
                    }
                }
                else{
                    echo "<script>swal('Your Email is Already Rgistered','','info');</script>";
                }
            }
        }
        ?>
        <div class="single-sidebar-widget newsletter-widget">
            <h6 class="title">Newsletter</h6>
            <p>
                Here, You can read latest articles first. You will get email notification for new articles.
            </p>
            <div class="form-group d-flex flex-row">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="col-autos">
                        <div class="input-group">
                            <input class="form-control" name="email" style="color: black;" placeholder="Email Address" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Email Address'" type="email">
                            <button type="submit" name="btnSubscribe" class="bbtns">Subscribe</button>
                        </div>
                    </div>
                </form>
            </div>
            <p>
                You can unsubscribe us at any time
            </p>
        </div>
        <div class="single-sidebar-widget most-popular-widget">
            <h6 class="title">Most Popular</h6>
            <?php
            $query = "SELECT articleId,count(id) as 'total likes' from tbllikes GROUP BY articleId ORDER BY COUNT(id) DESC";
            $result = $con->query($query);
            if ($result->num_rows != 0) {
                $count = 1;
                while ($row = $result->fetch_array()) {
                    if ($count <= 5) {
                        $articleId = $row[0];
                        $query = "select * from tblarticles where id=$articleId";
                        $result2 = $con->query($query);
                        $row1 = $result2->fetch_array();
                        $count++;
                        ?>
                        <div class="single-list flex-row d-flex">
                            <div class="thumb">
                                <img src="<?php echo $row1["coverImage"]; ?>" style="height: 80px; width: 100px;" alt="">
                            </div>
                            <div class="details">
                                <a href="viewArticle.php?id=<?php echo $row1["id"]; ?>">
                                    <h6><?php echo $row1["title"]; ?></h6>
                                </a>
                                <ul class="meta">
                                    <li><a href="#"><span class="lnr lnr-calendar-full"></span><?php echo $row1["publishingDate"]; ?></a></li>
                                    <li><a href="#"><span class="lnr lnr-heart"></span><?php echo $row[1]; ?></a></li>
                                </ul>
                            </div>
                        </div>
                        <?php
                    }
                }
            }
            ?>
        </div>
    </div>
</div>