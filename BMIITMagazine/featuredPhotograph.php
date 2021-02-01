<section class="top-post-area pt-10">
    <div class="container no-padding">
        <div class="row small-gutters">
            <?php
            $query = "select * from tblphotographs where isSelected=1";
            $result = $con->query($query);
            if ($result->num_rows == 1) {
                $row = $result->fetch_array();
                ?>
                <div class="col-lg-8 top-post-left">
                    <div class="feature-image-thumb relative">
                        <div class="overlay overlay-bg"></div>
                        <img class="img-fluid" src="<?php echo $row["coverImage"]; ?>" style="max-height: 424px;" alt="">
                    </div>
                    <div class="top-post-details">
                        <a>
                            <h3><?php echo $row["title"]; ?></h3>
                        </a>
                        <ul class="meta">
                            <li>
                                <a>
                                    <span class="lnr lnr-user"></span>
                                    <?php
                                    $contactNo = $row["pid"];
                                    $query = "select * from tblstudent where contactNo=$contactNo";
                                    $result2 = $con->query($query);
                                    $row1 = $result2->fetch_array();
                                    $authorName = $row1["fname"] . " " . $row1["lname"];
                                    echo $authorName;
                                    ?>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <?php
            } else {
                ?>
                <div class="col-lg-8 top-post-left">
                    <div class="feature-image-thumb relative">
                        <div class="overlay overlay-bg"></div>
                        <img class="img-fluid" src="img/top-post1.jpg" alt="">
                    </div>
                    <div class="top-post-details">
                        <a href="#">
                            <h3>A Discount Toner Cartridge Is Better Than Ever.</h3>
                        </a>
                        <ul class="meta">
                            <li><a href="#"><span class="lnr lnr-user"></span>Dhruv Bandaria</a></li>
                        </ul>
                    </div>
                </div>
                <?php
            }
            ?>
            <div class="col-lg-4 top-post-right">
                <?php
                $query = "select * from tblphotographs where isSelected=2";
                $result = $con->query($query);
                if ($result->num_rows == 1) {
                    $row = $result->fetch_array();
                    ?>
                    <div class="single-top-post">
                        <div class="feature-image-thumb relative">
                            <div class="overlay overlay-bg"></div>
                            <img class="img-fluid" src="<?php echo $row["coverImage"]; ?>" style="max-height: 206px;" alt="">
                        </div>
                        <div class="top-post-details">
                            <a>
                                <h4><?php echo $row["title"]; ?></h4>
                            </a>
                            <ul class="meta">
                                <li>
                                    <a>
                                        <span class="lnr lnr-user"></span>
                                        <?php
                                        $contactNo = $row["pid"];
                                        $query = "select * from tblstudent where contactNo=$contactNo";
                                        $result2 = $con->query($query);
                                        $row1 = $result2->fetch_array();
                                        $authorName = $row1["fname"] . " " . $row1["lname"];
                                        echo $authorName;
                                        ?>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <?php
                } else {
                    ?>
                    <div class="single-top-post">
                        <div class="feature-image-thumb relative">
                            <div class="overlay overlay-bg"></div>
                            <img class="img-fluid" src="img/top-post2.jpg" style="max-height: 206px;" alt="">
                        </div>
                        <div class="top-post-details">
                            <a href="image-post.html">
                                <h4>A Discount Toner Cartridge Is Better Than Ever.</h4>
                            </a>
                            <ul class="meta">
                                <li><a href="#"><span class="lnr lnr-user"></span>Dhruv Bandaria</a></li>
                            </ul>
                        </div>
                    </div>
                    <?php
                }
                ?>
                <?php
                $query = "select * from tblphotographs where isSelected=3";
                $result = $con->query($query);
                if ($result->num_rows == 1) {
                    $row = $result->fetch_array();
                    ?>
                    <div class="single-top-post mt-10">
                        <div class="feature-image-thumb relative">
                            <div class="overlay overlay-bg"></div>
                            <img class="img-fluid" src="<?php echo $row["coverImage"]; ?>" style="max-height: 206px;" alt="">
                        </div>
                        <div class="top-post-details">
                            <a href="image-post.html">
                                <h4><?php echo $row["title"]; ?></h4>
                            </a>
                            <ul class="meta">
                                <li>
                                    <a>
                                        <span class="lnr lnr-user"></span>
                                        <?php
                                        $contactNo = $row["pid"];
                                        $query = "select * from tblstudent where contactNo=$contactNo";
                                        $result2 = $con->query($query);
                                        $row1 = $result2->fetch_array();
                                        $authorName = $row1["fname"] . " " . $row1["lname"];
                                        echo $authorName;
                                        ?>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <?php
                } else {
                    ?>
                    <div class="single-top-post mt-10">
                        <div class="feature-image-thumb relative">
                            <div class="overlay overlay-bg"></div>
                            <img class="img-fluid" src="img/top-post3.jpg" style="max-height: 206px; max-width: 373px;" alt="">
                        </div>
                        <div class="top-post-details">
                            <a href="image-post.html">
                                <h4>A Discount Toner Cartridge Is Better</h4>
                            </a>
                            <ul class="meta">
                                <li><a href="#"><span class="lnr lnr-user"></span>Mark wiens</a></li>
                            </ul>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
</section>