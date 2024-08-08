<?php 
    session_start();
    include './functions/jobBoardStats.php';
?>

<!doctype html>
<html lang="en">
<head>
    <title>JobBoard</title>
    <meta charset="utf-8"/>
    <meta name="viewport"
          content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta name="description" content=""/>
    <meta name="keywords" content=""/>
    <meta name="author" content=""/>
    <link rel-="icon" href="images/logo.svg"/>

    <!-- CSS styles -->
    <link rel="stylesheet" href="css/custom-bs.css"/>
    <link rel="stylesheet" href="css/jquery.fancybox.min.css"/>
    <link rel="stylesheet" href="css/bootstrap-select.min.css"/>
    <link rel="stylesheet" href="fonts/icomoon/style.css"/>
    <link rel="stylesheet" href="fonts/line-icons/style.css"/>
    <link rel="stylesheet" href="css/owl.carousel.min.css"/>
    <link rel="stylesheet" href="css/animate.min.css"/>

    <!-- MAIN CSS -->
    <link rel="stylesheet" href="css/style.css"/>

</head>
<body id="top">
<div id="overlayer"></div>
<div class="loader">
    <div class="spinner-border text-primary" role="status">
        <span class="sr-only">Loading...</span>
    </div>
</div>

<div class="site-wrap">
    <div class="site-mobile-menu site-navbar-target">
        <div class="site-mobile-menu-header">
            <div class="site-mobile-menu-close mt-3">
                <span class="icon-close2 js-menu-toggle"></span>
            </div>
        </div>
        <div class="site-mobile-menu-body"></div>
    </div>
    <!-- .site-mobile-menu -->

    <!-- NAVBAR -->
    <?php include 'header.php' ?>

    <!-- HOME -->
    <!-- If the user is not the employer, show the view for JobSeeker -->
    <?php if (isset($_SESSION['role']) && $_SESSION['role'] !== 'Employer'): ?>
        <section
                class="home-section section-hero overlay bg-image"
                style="background-image: url(&quot;images/hero_1.jpg&quot;)"
                id="home-section">
            <div class="container">
                <div class="row align-items-center justify-content-center">
                    <div class="col-md-12">
                        <div class="mb-5 text-center">
                            <h1 class="text-white font-weight-bold">
                                The Easiest Way To Get Your Dream Job
                            </h1>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur
                                adipisicing elit. Cupiditate est,
                                consequuntur perferendis.
                            </p>
                        </div>
                        <form method="post" class="search-jobs-form">
                            <div class="row mb-5">
                                <div
                                        class="col-12 col-sm-6 col-md-6 col-lg-3 mb-4 mb-lg-0"
                                >
                                    <input
                                            type="text"
                                            class="form-control form-control-lg"
                                            placeholder="Job title, Company..."
                                    />
                                </div>
                                <div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-4 mb-lg-0">
                                    <select class="selectpicker" data-style="btn-white btn-lg" data-width="100%"
                                            data-live-search="true" title="Select Region">
                                        <option>Anywhere</option>
                                        <option>San Francisco</option>
                                        <option>Palo Alto</option>
                                        <option>New York</option>
                                        <option>Manhattan</option>
                                        <option>Ontario</option>
                                        <option>Toronto</option>
                                        <option>Kansas</option>
                                        <option>Mountain View</option>
                                    </select>
                                </div>
                                <div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-4 mb-lg-0">
                                    <select class="selectpicker" data-style="btn-white btn-lg" data-width="100%"
                                            data-live-search="true" title="Select Job Type">
                                        <option>Part Time</option>
                                        <option>Full Time</option>
                                        <option>Contract</option>
                                    </select>
                                </div>
                                <div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-4 mb-lg-0">
                                    <button
                                            type="submit"
                                            class="btn btn-primary btn-lg btn-block text-white btn-search">
                                            <span
                                                    class="icon-search icon mr-2"
                                            ></span
                                            >Search Job
                                    </button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 popular-keywords">
                                    <h3>Trending Keywords:</h3>
                                    <ul
                                            class="keywords list-unstyled m-0 p-0"
                                    >
                                        <li>
                                            <a href="#" class=""
                                            >UI Designer</a
                                            >
                                        </li>
                                        <li>
                                            <a href="#" class="">Python</a>
                                        </li>
                                        <li>
                                            <a href="#" class=""
                                            >Developer</a
                                            >
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <a href="#next" class="scroll-button smoothscroll">
                <span class="icon-keyboard_arrow_down"></span>
            </a>
        </section>

        <section
                class="py-5 bg-image overlay-primary fixed overlay"
                id="next"
                style="background-image: url(&quot;images/hero_1.jpg&quot;)">
            <div class="container">
                <div class="row mb-5 justify-content-center">
                    <div class="col-md-7 text-center">
                        <h2 class="section-title mb-2 text-white">
                            JobBoard Site Stats
                        </h2>
                        <p class="lead text-white">
                            Lorem ipsum dolor sit amet consectetur
                            adipisicing elit. Expedita unde officiis
                            recusandae sequi excepturi corrupti.
                        </p>
                    </div>
                </div>
                <div class="row pb-0 block__19738 section-counter">
                    <div class="col-6 col-md-6 col-lg-3 mb-5 mb-lg-0">
                        <div
                                class="d-flex align-items-center justify-content-center mb-2"
                        >
                            <strong class="number" data-number=<?= getNumCandidates() ?>
                            >0</strong
                            >
                        </div>
                        <span class="caption">Candidates</span>
                    </div>

                    <div class="col-6 col-md-6 col-lg-3 mb-5 mb-lg-0">
                        <div
                                class="d-flex align-items-center justify-content-center mb-2"
                        >
                            <strong class="number" data-number=<?= getNumJobsPosted() ?>
                            >0</strong
                            >
                        </div>
                        <span class="caption">Jobs Posted</span>
                    </div>

                    <div class="col-6 col-md-6 col-lg-3 mb-5 mb-lg-0">
                        <div
                                class="d-flex align-items-center justify-content-center mb-2"
                        >
                            <strong class="number" data-number=<?= getNumJobsFilled() ?>
                            >0</strong
                            >
                        </div>
                        <span class="caption">Jobs Filled</span>
                    </div>

                    <div class="col-6 col-md-6 col-lg-3 mb-5 mb-lg-0">
                        <div
                                class="d-flex align-items-center justify-content-center mb-2"
                        >
                            <strong class="number" data-number=<?= getNumCompanies() ?>
                            >0</strong
                            >
                        </div>
                        <span class="caption">Companies</span>
                    </div>
                </div>
            </div>
        </section>

        <section class="site-section" id="jobListingsA">
            <div class="container">
                <div class="row mb-5 justify-content-center">
                    <div class="col-md-7 text-center">
                        <h2 class="section-title mb-2">
                            <?= getNumJobsPosted() ?> Listed
                        </h2>
                    </div>
                </div>

                <?php
                $totalJobs = getNumJobsPosted();
                $jobsPerPage = 7;
                $totalPages = ceil($totalJobs / $jobsPerPage);
                $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                $start = ($currentPage - 1) * $jobsPerPage + 1;
                $end = min($start + $jobsPerPage - 1, $totalJobs);

                $currentPage = max(1, min($currentPage, $totalPages));
                ?>

                <?php
                include 'functions/getJobListings.php';
                getJobListings($start, $jobsPerPage);
                ?>

                <div class="row pagination-wrap">
                    <div class="col-md-6 text-center text-md-left mb-4 mb-md-0">
                        <span>Showing <?= $start ?>-<?= $end ?> Of <?= $totalJobs ?></span>
                    </div>
                    <div class="col-md-6 text-center text-md-right">
                        <div class="custom-pagination ml-auto">
                            <?php if ($currentPage > 1): ?>
                                <a href="?page=<?= $currentPage - 1 ?>#jobListingsA" class="prev">Prev</a>
                            <?php endif; ?>
                            <div class="d-inline-block">
                                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                                    <a href="?page=<?= $i ?>#jobListingsA" class="<?= $i == $currentPage ? 'active' : '' ?>"><?= $i ?></a>
                                <?php endfor; ?>
                            </div>
                            <?php if ($currentPage < $totalPages): ?>
                                <a href="?page=<?= $currentPage + 1 ?>#jobListingsA" class="next">Next</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <?php if (!isset($_SESSION['role'])): ?>
            <section
                    class="py-5 bg-image overlay-primary fixed overlay"
                    style="background-image: url(&quot;images/hero_1.jpg&quot;)"
            >
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h2 class="text-white">Looking For A Job?</h2>
                            <p class="mb-0 text-white lead">
                                Find a variety of jobs from different companies. You might find your dream job here.
                            </p>
                        </div>
                        <div class="col-md-3 ml-auto">
                            <a href="register.php" class="btn btn-warning btn-block btn-lg">Sign Up</a>
                        </div>
                    </div>
                </div>
            </section>
        <?php endif; ?>

    <?php else: ?>

        <!--
        SHOW CONTENT FOR EMPLOYER
        -->
        <?php 
            include './functions/getEmployerStats.php';
            $emp = getEmployer($_SESSION['user_id']);
        ?>
        <section class="bg-image overlay-primary fixed overlay" id="next" style="padding-top: 200px">
            <div class="container">
                <div class="row mb-5 justify-content-center">
                    <div class="col-md-7 text-center">
                        <h2 class="section-title mb-2 text-white">
                            <?= $emp['org_name'] ?> Application Stats
                        </h2>
                    </div>
                </div>
                <div class="row pb-0 block__19738 section-counter pb-5">
                    <div class="col col-md col-lg mb-5 mb-lg-0 mr-5">
                        <div
                                class="d-flex align-items-center justify-content-center mb-2"
                        >
                            <strong class="number" data-number=<?= getEmpNumCandidates() ?>
                            >0</strong
                            >
                        </div>
                        <span class="caption">Candidates</span>
                    </div>

                    <div class="col col-md col-lg mb-5 mb-lg-0 mr-5">
                        <div
                                class="d-flex align-items-center justify-content-center mb-2"
                        >
                            <strong class="number" data-number=<?= getEmpNumJobsPosted($_SESSION['user_id']) ?>
                            >0</strong
                            >
                        </div>
                        <span class="caption">Jobs Posted</span>
                    </div>

                    <div class="col col-md col-lg mb-5 mb-lg-0 mr-5">
                        <div
                                class="d-flex align-items-center justify-content-center mb-2"
                        >
                            <strong class="number" data-number=<?= getEmpNumJobsFilled($_SESSION['user_id']) ?>
                            >0</strong
                            >
                        </div>
                        <span class="caption">Applications Received</span>
                    </div>
                </div>
            </div>
        </section>

        <section class="site-section" id="jobListingsB">
            <div class="container">
                <div class="row mb-5 justify-content-center">
                    <div class="col-md-7 text-center">
                        <h2 class="section-title mb-2">
                            <?= getNumJobsPosted($_SESSION['user_id']) ?> Posts
                        </h2>
                    </div>
                </div>

                <?php
                $totalJobs = getEmpNumJobsPosted($_SESSION['user_id']);
                $jobsPerPage = 7;
                $totalPages = ceil($totalJobs / $jobsPerPage);
                $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                $start = ($currentPage - 1) * $jobsPerPage + 1;
                $end = min($start + $jobsPerPage - 1, $totalJobs);
                ?>

                <?php
                include 'functions/getJobsPosted.php';
                getJobListings($start, $jobsPerPage, $_SESSION['user_id']);
                ?>

                <div class="row pagination-wrap">
                    <div class="col-md-6 text-center text-md-left mb-4 mb-md-0">
                        <span>Showing <?= $start ?>-<?= $end ?> Of <?= $totalJobs ?></span>
                    </div>
                    <div class="col-md-6 text-center text-md-right">
                        <div class="custom-pagination ml-auto">
                            <?php if ($currentPage > 1): ?>
                                <a href="?page=<?= $currentPage - 1 ?>" class="prev">Prev</a>
                            <?php endif; ?>
                            <div class="d-inline-block">
                                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                                    <a href="?page=<?= $i ?>" class="<?= $i == $currentPage ? 'active' : '' ?>"><?= $i ?></a>
                                <?php endfor; ?>
                            </div>
                            <?php if ($currentPage < $totalPages): ?>
                                <a href="?page=<?= $currentPage + 1 ?>" class="next">Next</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>


    <?php endif; ?>

    <?php include 'footer.php' ?>
</div>

<!-- SCRIPTS -->
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/isotope.pkgd.min.js"></script>
<script src="js/stickyfill.min.js"></script>
<script src="js/jquery.fancybox.min.js"></script>
<script src="js/jquery.easing.1.3.js"></script>

<script src="js/jquery.waypoints.min.js"></script>
<script src="js/jquery.animateNumber.min.js"></script>
<script src="js/owl.carousel.min.js"></script>

<script src="js/bootstrap-select.min.js"></script>

<script src="js/custom.js"></script>

<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function () {
        if (window.location.hash) {
            let element = document.querySelector(window.location.hash);
            if (element) {
                element.scrollIntoView({behavior: 'smooth'});
            }
        }
    });
</script>
</body>
</html>