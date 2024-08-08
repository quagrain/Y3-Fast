<!-- HOME -->
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

    <!-- NAVBAR -->
    <?php include 'header.php' ?>

    <section class="bg-image overlay-primary fixed overlay" id="next" style="padding-top: 200px">
        <div class="container">
            <div class="row mb-5 justify-content-center">
                <div class="col-md-7 text-center">
                    <h2 class="section-title mb-2 text-white">
                        {First Name} {Last Name} Jobs Applied
                    </h2>
                </div>
            </div>
            <div class="row pb-0 block__19738 section-counter pb-5">
                <div class="col col-md col-lg mb-5 mb-lg-0 mr-5">
                    <div
                            class="d-flex align-items-center justify-content-center mb-2"
                    >
                        <strong class="number" data-number<?= getNumJobsPosted() ?>
                        >0</strong
                        >
                    </div>
                    <span class="caption">Jobs Applied</span>
                </div>

                <div class="col col-md col-lg mb-5 mb-lg-0 mr-5">
                    <div
                            class="d-flex align-items-center justify-content-center mb-2"
                    >
                        <strong class="number" data-number=<?= getNumJobsFilled() ?>
                        >0</strong
                        >
                    </div>
                    <span class="caption">Jobs Approved</span>
                </div>
            </div>
        </div>
    </section>

    <section class="site-section">
        <div class="container">
            <div class="row mb-5 justify-content-center">
                <div class="col-md-7 text-center">
                    <h2 class="section-title mb-2">
                        <?= getNumJobsPosted() ?> Jobs
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
<script src="js/quill.min.js"></script>


<script src="js/bootstrap-select.min.js"></script>

<script src="js/custom.js"></script>


</body>
</html>