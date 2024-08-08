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

    <section class="bg-image overlay-primary fixed overlay" id="next" style="padding-top: 200px; padding-bottom: 5px">
        <div class="container">
            <div class="row mb-5 justify-content-center">
                <div class="col-md-7 text-center">
                    <h2 class="section-title mb-2 text-white">
                        Applicants
                    </h2>
                </div>
            </div>
        </div>
    </section>

    <section class="site-section">
        <div class="container">
            <div class="row mb-5 justify-content-center">
                <div class="col-md-7 text-center">
                    <h2 class="section-title mb-2">
                        {Number of} Candidates
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
            echo '<ul class="job-listings mb-5">';
            echo '<li class="job-listing d-block d-sm-flex pb-3 pb-sm-0 align-items-center">';
            echo '<a href="applications.php?job_id=' . 0 . '"></a>';
            echo '<div class="applicant-logo">';
            echo '<img src="images/logo.svg"  alt="Job Logo" class="img-fluid"  width="100px" height="100px"/>';
            echo '</div>';
            echo '<div class="job-listing-about d-sm-flex custom-width w-100 justify-content-between mx-4">';
            echo '<div class="job-listing-position custom-width w-50 mb-3 mb-sm-0 mt-1">';
            echo '<h2>{users.fname + users.lname}</h2>';
            echo '<strong>{applications.date_of_applications}</strong>';
            echo '</div>';
            echo '<div class="mb-3 mb-sm-0 custom-width w-50 mt-2">';
            echo '<span class="btn btn-outline-info dropdown" onclick="{download_Resume}">Resume</span>';
            echo '</div>';
            echo '<div class="job-listing-meta">';
            echo '<span>
                    <select id="application_status" class="btn-danger p-2 mt-2 dropdown" onchange="changeButton()">
                        <option value="Rejected">Rejected</option>
                        <option value="Accepted">Accepted</option>
                        <option value="Pending" selected>Pending</option>
                    </select>
                  </span>';
            echo '</div>';
            echo '</div>';
            echo '</li>';
            echo '</ul>';
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
<script>
    function changeButton() {
        const status = document.getElementById('application_status');
        switch (status.value) {
            case "Pending":
                status.classList.remove('btn-danger', 'btn-success');
                status.classList.add('btn-warning');
                break;
            case "Rejected":
                status.classList.remove('btn-success', 'btn-warning');
                status.classList.add('btn-danger');
                break;
            case "Accepted":
                status.classList.remove('btn-danger', 'btn-warning');
                status.classList.add('btn-success')
                break;
        }
    }

    document.addEventListener('DOMContentLoaded', () => changeButton());
</script>

</body>
</html>