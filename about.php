<?php include './functions/jobBoardStats.php'; ?>

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
    <link rel="stylesheet" href="css/quill.snow.css">


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
    </div>


    <!-- NAVBAR -->
    <?php include 'header.php'; ?>

    <!-- HOME -->
    <section class="section-hero overlay inner-page bg-image" style="background-image: url('images/hero_1.jpg');" id="home-section">
        <div class="container">
            <div class="row">
                <div class="col-md-7">
                    <h1 class="text-white font-weight-bold">About Us</h1>
                    <div class="custom-breadcrumbs">
                        <a href="#">Home</a> <span class="mx-2 slash">/</span>
                        <span class="text-white"><strong>About Us</strong></span>
                    </div>
                </div>
            </div>
        </div>
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


    <section class="site-section pb-0">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-5 mb-lg-0">
                    <img src="images/bw_using_pc.svg" alt="Image" class="img-fluid">
                </div>
                <div class="col-lg-5 ml-auto">
                    <h2 class="section-title mb-3">JobBoard For Workers</h2>
                    <p class="lead">Looking for your next job? Are you a freelancer or someone looking for a side job to make extra money?</p>
                    <p>JobBoard is for everyone. Put what you know to use to make some money. It could be your hobby or something new you are learning.
                        It never hurt anyone to try. Remember, you miss 100% of the shots you do not take!
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="site-section pt-0">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-5 mb-lg-0 order-md-2">
                    <img src="images/bm_office_chat.svg" alt="Image" class="img-fluid">
                </div>
                <div class="col-lg-5 mr-auto order-md-1  mb-5 mb-lg-0">
                    <h2 class="section-title mb-3">JobBoard For Employers & Recruiters</h2>
                    <p class="lead">Are you a company, recruiter or an employer looking for employees? Look no further!</p>
                    <p>JobBoard allows you to recruit the best of the best in your industry, or contract a freelancer, you are not looking
                        for permanent additions to the company. Post a job with the details, and watch the applications fly in!</p>
                </div>
            </div>
        </div>
    </section>


    <section class="site-section">
        <div class="container">
            <div class="row mb-5">
                <div class="col-12 text-center" data-aos="fade">
                    <h2 class="section-title mb-3">Our Team</h2>
                </div>
            </div>

            <div class="row align-items-center block__64">

                <div class="col-md-6">
                    <img src="images/bm_standing_office.svg" alt="Image" class="img-fluid mb-4 rounded">
                </div>
                <div class="col-md-6">
                    <h3>Emmanuel Agyei Brewu</h3>
                    <p class="text-muted">FRONT-END DEVELOPER</p>
                    <p>You like how the website looks and feels. He did it! He's not available for hire though, find someone else!</p>
                    <div class="social mt-4">
                        <a href="#"><span class="icon-facebook"></span></a>
                        <a href="#"><span class="icon-twitter"></span></a>
                        <a href="#"><span class="icon-instagram"></span></a>
                        <a href="#"><span class="icon-linkedin"></span></a>
                    </div>
                </div>

                <div class="col-md-6">
                    <img src="images/bm_standing_office.svg" alt="Image" class="img-fluid mb-4 rounded">
                </div>
                <div class="col-md-6">
                    <h3>Mohamed Habib Soumahoro</h3>
                    <p class="text-muted">BACKEND-DEVELOPER</p>
                    <p>You can't see the work he's done but without it, the site will only be good for reading.</p>
                    <div class="social mt-4">
                        <a href="#"><span class="icon-facebook"></span></a>
                        <a href="#"><span class="icon-twitter"></span></a>
                        <a href="#"><span class="icon-instagram"></span></a>
                        <a href="#"><span class="icon-linkedin"></span></a>
                    </div>
                </div>


                <div class="col-md-6">
                    <img src="images/bm_standing_office.svg" alt="Image" class="img-fluid mb-4 rounded">
                </div>
                <div class="col-md-6">
                    <h3>Delali Nsiah-Asare</h3>
                    <p class="text-muted">BACKEND DEVELOPER</p>
                    <p>Another backend developer. Forgot to pull on his first day and caused our greatest merge conflict yet.
                        We still cherish him though.</p>
                    <div class="social mt-4">
                        <a href="#"><span class="icon-facebook"></span></a>
                        <a href="#"><span class="icon-twitter"></span></a>
                        <a href="#"><span class="icon-instagram"></span></a>
                        <a href="#"><span class="icon-linkedin"></span></a>
                    </div>
                </div>

                <div class="col-md-6">
                    <img src="images/bm_standing_office.svg" alt="Image" class="img-fluid mb-4 rounded">
                </div>
                <div class="col-md-6">
                    <h3>Victor Quagraine</h3>
                    <p class="text-muted">FRONT-END DEVELOPER</p>
                    <p>A front-end developer who has no idea how to center a div. Cannot, design a simple button without a Figma design.</p>
                    <div class="social mt-4">
                        <a href="#"><span class="icon-facebook"></span></a>
                        <a href="#"><span class="icon-twitter"></span></a>
                        <a href="#"><span class="icon-instagram"></span></a>
                        <a href="#"><span class="icon-linkedin"></span></a>
                    </div>
                </div>
            </div>

    </section>

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
<script src="js/quill.min.js"></script>


<script src="js/bootstrap-select.min.js"></script>

<script src="js/custom.js"></script>


</body>
</html>
