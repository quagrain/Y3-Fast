<?php
include './settings/core.php';
include './functions/getJobReqByID.php';
$jobReqData = getJobReqByID($_GET['job_id']);

include './functions/hasApplied.php';
$hasApplied = hasApplied($_SESSION['user_id'], $_GET['job_id']);
?>

<!doctype html>
<html lang="en">
<head>
    <title>JobBoard</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="css/custom-bs.css">
    <link rel="stylesheet" href="css/jquery.fancybox.min.css">
    <link rel="stylesheet" href="css/bootstrap-select.min.css">
    <link rel="stylesheet" href="fonts/icomoon/style.css">
    <link rel="stylesheet" href="fonts/line-icons/style.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/animate.min.css">


    <!-- MAIN CSS -->
    <link rel="stylesheet" href="css/style.css">
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
    </div> <!-- .site-mobile-menu -->


    <!-- NAVBAR -->
    <?php include 'header.php' ?>

    <!-- HOME -->
    <section class="section-hero overlay inner-page bg-image" style="background-image: url('images/hero_1.jpg');" id="home-section">
        <div class="container">
            <div class="row">
                <div class="col-md-7">
                    <h1 class="text-white font-weight-bold"><?= $jobReqData['job_title'] ?></h1>
                    <div class="custom-breadcrumbs">
                        <a href="index.php">Home</a> <span class="mx-2 slash">/</span>
                        <a href="job-listings.php">Job</a> <span class="mx-2 slash">/</span>
                        <span class="text-white"><strong><?= $jobReqData['job_title'] ?></strong></span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <h3 id="hasApplied" style="display: none;"><?= $hasApplied ? 'true' : 'false' ?></h3>
    <section class="site-section">
        <div class="container">
            <div class="row align-items-center mb-5">
                <div class="col-lg-8 mb-4 mb-lg-0">
                    <div class="d-flex align-items-center">
                        <div class="border p-2 d-inline-block mr-3 rounded">
                            <img src=<?= $jobReqData['profile_pic'] ?> height="100px" width="100px"/>
                        </div>
                        <div>
                            <h2><?= $jobReqData['job_title'] ?></h2>
                            <div>
                                <span class="ml-0 mr-2 mb-2"><span class="icon-briefcase mr-2"></span><?= $jobReqData['org_name'] ?></span>
                                <span class="m-2"><span class="icon-room mr-2"></span><?= $jobReqData['job_location'] ?></span>
                                <span class="m-2"><span class="icon-clock-o mr-2"></span><span class="text-primary"><?= $jobReqData['status'] ?></span></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="row">
                        <?php if ($_SESSION['role'] == 'JobSeeker'): ?>
                            <div class="col">
                                <a class="btn btn-block btn-primary btn-md applyButton text-white" onclick="handleJobApplication(event, <?= $_SESSION['user_id'] ?>, <?= $_GET['job_id'] ?>)">Apply Now</a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8">
                    <div class="mb-5">
                        <figure class="mb-5"><img src=<?= $jobReqData['featured_image'] ?> alt="Image" class="img-fluid rounded"></figure>
                        <h3 class="h5 d-flex align-items-center mb-4 text-primary"><span class="icon-align-left mr-3"></span>Job Description</h3>
                        <p><?= $jobReqData['job_description'] ?></p>
                    </div>
                    <div class="mb-5">
                        <h3 class="h5 d-flex align-items-center mb-4 text-primary"><span class="icon-rocket mr-3"></span>Responsibilities</h3>
                        <?php $responsibilities = json_decode($jobReqData['responsibility'], true); ?>
                        <ul class="list-unstyled m-0 p-0">
                            <?php foreach ($responsibilities as $responsibility): ?>
                                <li class="d-flex align-items-start mb-2">
                                    <span class="icon-check_circle mr-2 text-muted"></span>
                                    <span><?= htmlspecialchars($responsibility) ?></span>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>

                    <div class="mb-5">
                        <h3 class="h5 d-flex align-items-center mb-4 text-primary"><span class="icon-turned_in mr-3"></span>Related Benefits</h3>
                        <?php $benefits = json_decode($jobReqData['benefits'], true); ?>
                        <ul class="list-unstyled m-0 p-0">
                            <?php foreach ($benefits as $benefit): ?>
                                <li class="d-flex align-items-start mb-2">
                                    <span class="icon-check_circle mr-2 text-muted"></span>
                                    <span><?= htmlspecialchars($benefit) ?></span>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>

                    <div class="row mb-5">
                        <?php if ($_SESSION['role'] == 'JobSeeker'): ?>
                            <div class="col">
                                <a class="applyButton btn btn-block btn-primary btn-md text-white" onclick="handleJobApplication(event, <?= $_SESSION['user_id'] ?>, <?= $_GET['job_id'] ?>)">Apply Now</a>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- <script></script> -->

                </div>
                <div class="col-lg-4">
                    <div class="bg-light p-3 border rounded mb-4">
                        <h3 class="text-primary  mt-3 h5 pl-3 mb-3 ">Job Summary</h3>
                        <ul class="list-unstyled pl-3 mb-0">
                            <li class="mb-2"><strong class="text-black">Published on: </strong><?= $jobReqData['published_on'] ?></li>
                            <li class="mb-2"><strong class="text-black">Vacancy: </strong><?= $jobReqData['vacancy'] ?></li>
                            <li class="mb-2"><strong class="text-black">Employment Status: </strong><?= $jobReqData['status'] ?></li>
                            <li class="mb-2"><strong class="text-black">Experience: </strong><?= $jobReqData['experience'] ?></li>
                            <li class="mb-2"><strong class="text-black">Job Location: </strong><?= $jobReqData['job_location'] ?></li>
                            <li class="mb-2"><strong class="text-black">Base Salary:</strong> $<?= $jobReqData['salary'] ?></li>
                            <li class="mb-2"><strong class="text-black">Gender: </strong><?= $jobReqData['gender'] ?></li>
                            <li class="mb-2"><strong class="text-black">Application Deadline: </strong><?= $jobReqData['application_deadline'] ?></li>
                        </ul>
                    </div>

                    <div class="bg-light p-3 border rounded">
                        <h3 class="text-primary  mt-3 h5 pl-3 mb-3 ">Share</h3>
                        <div class="px-3">
                            <a href="#" class="pt-3 pb-3 pr-3 pl-0"><span class="icon-facebook"></span></a>
                            <a href="#" class="pt-3 pb-3 pr-3 pl-0"><span class="icon-twitter"></span></a>
                            <a href="#" class="pt-3 pb-3 pr-3 pl-0"><span class="icon-linkedin"></span></a>
                            <a href="#" class="pt-3 pb-3 pr-3 pl-0"><span class="icon-pinterest"></span></a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <?php
    include './functions/getRelatedJobs.php';

    $totalJobs = getNumRelatedJobs($jobId = $_GET['job_id']);
    $jobsPerPage = 3;
    $totalPages = ceil($totalJobs / $jobsPerPage);
    $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $start = ($currentPage - 1) * $jobsPerPage + 1;
    $end = min($start + $jobsPerPage - 1, $totalJobs);

    $relatedJobListings = getJobWithRelatedListings($jobId = $_GET['job_id'], $start, $jobsPerPage);
    ?>

    <section class="site-section" id="relatedJobListings">
        <div class="container">
            <div class="row mb-5 justify-content-center">
                <div class="col-md-7 text-center">
                    <h2 class="section-title mb-2"><?= $totalJobs ?> Related Jobs</h2>
                </div>
            </div>

            <ul class="job-listings mb-5">
                <?php foreach ($relatedJobListings as $job): ?>
                    <li class="job-listing d-block d-sm-flex pb-3 pb-sm-0 align-items-center">
                        <a href="job-single.php?job_id=<?= htmlspecialchars($job['job_id']) ?>"></a>
                        <div class="job-listing-logo">
                            <img src="<?= htmlspecialchars($job['profile_pic']) ?>" alt="Image" class="img-fluid">
                        </div>

                        <div class="job-listing-about d-sm-flex custom-width w-100 justify-content-between mx-4">
                            <div class="job-listing-position custom-width w-50 mb-3 mb-sm-0">
                                <h2><?= htmlspecialchars($job['job_title']) ?></h2>
                                <strong><?= htmlspecialchars($job['org_name']) ?></strong>
                            </div>
                            <div class="job-listing-location mb-3 mb-sm-0 custom-width w-25">
                                <span class="icon-room"></span> <?= htmlspecialchars($job['job_location']) ?>
                            </div>
                            <div class="job-listing-meta">
                                <span class="badge badge-danger"><?= htmlspecialchars($job['status']) ?></span>
                            </div>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>

            <div class="row pagination-wrap">
                <div class="col-md-6 text-center text-md-left mb-4 mb-md-0">
                    <span>Showing <?= $start ?>-<?= $end ?> Of <?= $totalJobs ?></span>
                </div>
                <div class="col-md-6 text-center text-md-right">
                    <div class="custom-pagination ml-auto">
                        <?php if ($currentPage > 1): ?>
                            <a href="?job_id=<?= $jobId ?>&page=<?= $currentPage - 1 ?>#relatedJobListings" class="prev">Prev</a>
                        <?php endif; ?>
                        <div class="d-inline-block">
                            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                                <a href="?job_id=<?= $jobId ?>&page=<?= $i ?>#relatedJobListings" class="<?= $i == $currentPage ? 'active' : '' ?>"><?= $i ?></a>
                            <?php endfor; ?>
                        </div>
                        <?php if ($currentPage < $totalPages): ?>
                            <a href="?job_id=<?= $jobId ?>&page=<?= $currentPage + 1 ?>#relatedJobListings" class="next">Next</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="site-footer">

        <a href="#top" class="smoothscroll scroll-top">
            <span class="icon-keyboard_arrow_up"></span>
        </a>

        <div class="container">
            <div class="row mb-5">
                <div class="col-6 col-md-3 mb-4 mb-md-0">
                    <h3>Search Trending</h3>
                    <ul class="list-unstyled">
                        <li><a href="#">Web Design</a></li>
                        <li><a href="#">Graphic Design</a></li>
                        <li><a href="#">Web Developers</a></li>
                        <li><a href="#">Python</a></li>
                        <li><a href="#">HTML5</a></li>
                        <li><a href="#">CSS3</a></li>
                    </ul>
                </div>
                <div class="col-6 col-md-3 mb-4 mb-md-0">
                    <h3>Company</h3>
                    <ul class="list-unstyled">
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Career</a></li>
                        <li><a href="#">Blog</a></li>
                        <li><a href="#">Resources</a></li>
                    </ul>
                </div>
                <div class="col-6 col-md-3 mb-4 mb-md-0">
                    <h3>Support</h3>
                    <ul class="list-unstyled">
                        <li><a href="#">Support</a></li>
                        <li><a href="#">Privacy</a></li>
                        <li><a href="#">Terms of Service</a></li>
                    </ul>
                </div>
                <div class="col-6 col-md-3 mb-4 mb-md-0">
                    <h3>Contact Us</h3>
                    <div class="footer-social">
                        <a href="#"><span class="icon-facebook"></span></a>
                        <a href="#"><span class="icon-twitter"></span></a>
                        <a href="#"><span class="icon-instagram"></span></a>
                        <a href="#"><span class="icon-linkedin"></span></a>
                    </div>
                </div>
            </div>

            <div class="row text-center">
                <div class="col-12">
                    <p class="copyright"><small>
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                            Copyright &copy;<script>document.write(new Date().getFullYear());</script>
                            All rights reserved | This template is made with <i class="icon-heart text-danger" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></small></p>
                </div>
            </div>
        </div>
    </footer>

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

<script src="js/job_single.js"></script>

<script src="js/custom.js"></script>

</body>
</html>