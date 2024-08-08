<header class="site-navbar mt-3">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div>
                <div class="site-logo col-6">
                    <a href="index.php" style="font-weight: bold; font-size: 30px;">Y3-FAST</a>
                </div>
            </div>

            <nav class="mx-auto site-navigation">
                <ul
                        class="site-menu js-clone-nav d-none d-xl-block ml-0 pl-0"
                >
                    <li>
                        <a href="./index.php" class="nav-link active"
                        >Home</a
                        >
                    </li>
                    <li><a href="about.php">About</a></li>

                    <li><a href="contact.php">Contact</a></li>
                    <li class="d-lg-none">
                        <a href="post-job.php">
                            <span class="mr-2">+</span>
                            Post a Job
                        </a>
                    </li>

                </ul>
            </nav>

            <div class="right-cta-menu text-right d-flex align-items-center">
                <div class="ml-auto row">
                    <?php
                    if (isset($_SESSION['user_id'])) { // If the user is logged in display these buttons
                        if (isset($_SESSION['role']) && $_SESSION['role'] == "Employer") { // if the current user is an employer show the post job button
                            echo '
                                <a href="post-job.php" class="col btn btn-outline-white border-width-2 d-none d-lg-inline-block">
                                <span class="icon-add"></span>Add Job</a>';
                        }
                        echo '
                              <a href="profile.php" class="col btn btn-outline-white border-width-2 d-none d-lg-inline-block">
                                <span class="icon-user-o"></span>Profile</a>';
                        echo '
                              <a href="./actions/logout.php" class="col btn btn-outline-white border-width-2 d-none d-lg-inline-block">
                                <span class="icon-exit_to_app"></span></a>';
                    } else {
                        $current_page = basename($_SERVER['PHP_SELF']);
                        if ($current_page == 'login.php') {
                            echo '
                            <a href="register.php" class="col btn btn-primary border-width-2 d-none d-lg-inline-block">
                                    <span class="icon-user-plus"></span>Sign Up</a>';
                        } else {
                            echo '
                                <a href="login.php" class="col btn btn-primary border-width-2 d-none d-lg-inline-block">
                                    <span class="icon-lock_outline"></span>Login</a>';
                        }
                    }
                    ?>
                </div>
                <a href="#"
                   class="site-menu-toggle js-menu-toggle d-inline-block d-xl-none mt-lg-2 ml-3"
                ><span class="icon-menu h3 m-0 p-0 mt-2"></span>
                </a>
            </div>
        </div>
    </div>
</header>