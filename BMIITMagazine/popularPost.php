<?php
$query = "select articleId,count(id) from tblcomments group by articleId order by count(id) DESC";
$result = $con->query($query);
$count = 0;
if ($result->num_rows != 0) {
    $row = $result->fetch_array();
    $query = "select * from tblarticles where id=" . $row[0];
    $result2 = $con->query($query);
    $row2 = $result2->fetch_array();
    $aid=$row2["id"];
    ?>
    <div class="popular-post-wrap">
        <h4 class="title">Popular Posts</h4>
        <div class="feature-post relative">
            <div class="feature-img relative">
                <div class="overlay overlay-bg"></div>
                <img class="img-fluid" src="<?php echo $row2["coverImage"]; ?>" alt="">
            </div>
            <div class="details">
                <ul class="tags">
                    <li><a href="#"><?php echo $row2["keyword"]; ?></a></li>
                </ul>
                <a href="viewArticle.php?id=<?php echo $row[0]; ?>">
                    <h3><?php echo $row2["title"]; ?></h3>
                </a>
                <ul class="meta">
                    <li>
                        <a href="#">
                            <span class="lnr lnr-user"></span>
                            <?php
                            $query = "select * from tblstudent where contactNo=$contactNo";
                            $result2 = $con->query($query);
                            $row1 = $result2->fetch_array();
                            $authorName = $row1["fname"] . " " . $row1["lname"];
                            $oldDate = $row2["lastModification"];
                            $newDate = date("d-m-Y", strtotime($oldDate));
                            echo $authorName;
                            ?>
                        </a>
                    </li>
                    <li><a href="#"><span class="lnr lnr-calendar-full"></span><?php echo $newDate; ?></a></li>
                    <li><a href="#"><span class="lnr lnr-bubble"></span><?php echo $row[1] . " Comments"; ?></a></li>
                    <li>
                        <a href="#">
                            <span class="lnr lnr-heart"></span>
                            <?php
                            $query = "select count(*) from tbllikes where articleId=$aid";
                            $result2 = $con->query($query);
                            $row2 = $result2->fetch_array();
                            $totalLikes = $row2[0];
                            echo $totalLikes . " Likes";
                            ?>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="row mt-20 medium-gutters">
            <?php
            $row = $result->fetch_array();
            $query = "select * from tblarticles where id=" . $row[0];
            $result2 = $con->query($query);
            $row2 = $result2->fetch_array();
            $aid=$row2["id"];
            ?>
            <div class="col-lg-6 single-popular-post">
                <div class="feature-img-wrap relative">
                    <div class="feature-img relative">
                        <div class="overlay overlay-bg"></div>
                        <img class="img-fluid" src="<?php echo $row2["coverImage"]; ?>" alt="">
                    </div>
                    <ul class="tags">
                        <li><a href="#"><?php echo $row2["keyword"]; ?></a></li>
                    </ul>
                </div>
                <div class="details">
                    <a href="viewArticle.php?id=<?php echo $row[0]; ?>">
                        <h4><?php echo $row2["title"]; ?></h4>
                    </a>
                    <ul class="meta">
                        <li>
                            <a href="#">
                                <span class="lnr lnr-user"></span>
                                <?php
                                $query = "select * from tblstudent where contactNo=$contactNo";
                                $result2 = $con->query($query);
                                $row1 = $result2->fetch_array();
                                $authorName = $row1["fname"] . " " . $row1["lname"];
                                $oldDate = $row2["lastModification"];
                                $newDate = date("d-m-Y", strtotime($oldDate));
                                $littleText = substr($row2["text"], 0, 75);
                                $littleText .= "...";
                                echo $authorName;
                                ?>
                            </a>
                        </li>
                        <li><a href="#"><span class="lnr lnr-calendar-full"></span><?php echo $newDate; ?></a></li>
                        <li><a href="#"><span class="lnr lnr-bubble"></span><?php echo $row[1] . " Comments"; ?></a></li>
                        <li><a href="#"><span class="lnr lnr-heart"></span><?php
                            $query = "select count(*) from tbllikes where articleId=$aid";
                            $result2 = $con->query($query);
                            $row2 = $result2->fetch_array();
                            $totalLikes = $row2[0];
                            echo $totalLikes . " Likes";
                            ?></a></li>
                    </ul>
                    <p class="excert">
                        <?php echo $littleText; ?>
                    </p>
                </div>
            </div>
            <?php
            $row = $result->fetch_array();
            $query = "select * from tblarticles where id=" . $row[0];
            $result2 = $con->query($query);
            $row2 = $result2->fetch_array();
            $aid=$row2["id"];
            ?>
            <div class="col-lg-6 single-popular-post">
                <div class="feature-img-wrap relative">
                    <div class="feature-img relative">
                        <div class="overlay overlay-bg"></div>
                        <img class="img-fluid" src="<?php echo $row2["coverImage"]; ?>" alt="">
                    </div>
                    <ul class="tags">
                        <li><a href="#"><?php echo $row2["keyword"]; ?></a></li>
                    </ul>
                </div>
                <div class="details">
                    <a href="viewArticle.php?id=<?php echo $row[0]; ?>">
                        <h4><?php echo $row2["title"]; ?></h4>
                    </a>
                    <ul class="meta">
                        <li>
                            <a href="#">
                                <span class="lnr lnr-user"></span>
                                <?php
                                $query = "select * from tblstudent where contactNo=$contactNo";
                                $result2 = $con->query($query);
                                $row1 = $result2->fetch_array();
                                $authorName = $row1["fname"] . " " . $row1["lname"];
                                $oldDate = $row2["lastModification"];
                                $newDate = date("d-m-Y", strtotime($oldDate));
                                $littleText = substr($row2["text"], 0, 75);
                                $littleText .= "...";
                                echo $authorName;
                                ?>
                            </a>
                        </li>
                        <li><a href="#"><span class="lnr lnr-calendar-full"></span><?php echo $newDate; ?></a></li>
                        <li><a href="#"><span class="lnr lnr-bubble"></span><?php echo $row[1] . " Comments"; ?></a></li>
                        <li><a href="#"><span class="lnr lnr-heart"></span><?php
                            $query = "select count(*) from tbllikes where articleId=$aid";
                            $result2 = $con->query($query);
                            $row2 = $result2->fetch_array();
                            $totalLikes = $row2[0];
                            echo $totalLikes . " Likes";
                            ?></a></li>
                    </ul>
                    <p class="excert">
                        <?php echo $littleText; ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <?php
}
?>