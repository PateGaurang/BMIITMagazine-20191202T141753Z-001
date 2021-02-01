<aside id="left-panel" class="left-panel">
    <nav class="navbar navbar-expand-sm navbar-default">

        <div class="navbar-header">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa fa-bars"></i>
            </button>
            <a class="navbar-brand" href="./adminHome.php"><img src="images/logo.png" alt="Logo"></a>
            <a class="navbar-brand hidden" href="./adminHome.php"><img src="images/logo2.png" alt="Logo"></a>
        </div>

        <div id="main-menu" class="main-menu collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active">
                    <a href="adminHome.php"> <i class="menu-icon fa fa-dashboard"></i>Dashboard </a>
                </li>
                <h3 class="menu-title">Magazine Issues</h3><!-- /.menu-title -->
                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-laptop"></i>Manage Issue</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="fa fa-puzzle-piece"></i><a href="addIssue.php">Add Issue</a></li>
                        <li><i class="fa fa-id-badge"></i><a href="manageIssue.php">Manage Issue</a></li>
                        <li><i class="fa fa-bars"></i><a href="changeActiveIssue.php">Change Active Issue</a></li>
                    </ul>
                </li>

                <h3 class="menu-title">Articles</h3>

                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-tasks"></i>Manage Article</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="menu-icon fa fa-upload"></i><a href="uploadRequest.php">Upload Request</a></li>
                        <li><i class="menu-icon fa fa-edit"></i><a href="updateRequest.php">Update Request</a></li>
                        <li><i class="menu-icon fa fa-id-badge"></i><a href="reviewedArticles.php">Reviewed Articles</a></li>
                    </ul>
                </li>
                <li>
                    <a href="featuredArticles.php"> <i class="menu-icon fa fa-wrench"></i>Featured Articles</a>
                </li>
                <li>
                    <a href="moveArticle.php"> <i class="menu-icon fa fa-arrows-alt"></i>Transfer Articles</a>
                </li>
                <h3 class="menu-title">Photographs</h3>

                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-tasks"></i>Manage Photographs</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="menu-icon fa fa-photograph"></i><a href="changePhotographs.php">Change Photographs</a></li>
                    </ul>
                </li>
                <h3 class="menu-title">Committees</h3>
                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-users"></i>Writer Committee</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="menu-icon fa fa-user-plus"></i><a href="editorRequest.php">Student Request</a></li>
                        <li><i class="menu-icon fa fa-edit"></i><a href="manageMembers.php">Manage Members</a></li>
                    </ul>
                </li>
                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-users"></i>Photographer Committee</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="menu-icon fa fa-user-plus"></i><a href="photographerRequest.php">Student Request</a></li>
                        <li><i class="menu-icon fa fa-edit"></i><a href="managePhotographer.php">Manage Members</a></li>
                    </ul>
                </li>
                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-users"></i>Manage Students</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="menu-icon fa fa-edit"></i><a href="manageStudent.php">Manage Students</a></li>
                    </ul>
                </li>
                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-users"></i>Manage User</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="menu-icon fa fa-edit"></i><a href="manageUsers.php">Manage Users</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</aside>