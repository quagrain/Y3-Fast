<!doctype html>
<html lang="en">
<head>
    <title>JobBoard</title>
    <meta charset="utf-8"/>
    <meta
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
            name="viewport"
    />

    <link href="css/custom-bs.css" rel="stylesheet"/>
    <link href="css/jquery.fancybox.min.css" rel="stylesheet"/>
    <link href="css/bootstrap-select.min.css" rel="stylesheet"/>
    <link href="fonts/icomoon/style.css" rel="stylesheet"/>
    <link href="fonts/line-icons/style.css" rel="stylesheet"/>
    <link href="css/owl.carousel.min.css" rel="stylesheet"/>
    <link href="css/animate.min.css" rel="stylesheet"/>
    <link href="css/quill.snow.css" rel="stylesheet"/>

    <!-- MAIN CSS -->
    <link href="css/style.css" rel="stylesheet"/>
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

    <!-- HOME -->
    <section
            class="section-hero overlay inner-page bg-image"
            id="home-section"
            style="background-image: url(&quot;images/hero_1.jpg&quot;)"
    >
        <div class="container">
            <div class="row">
                <div class="col-md-7">
                    <h1 class="text-white font-weight-bold">
                        Contact Us
                    </h1>
                    <div class="custom-breadcrumbs">
                        <a href="#">Home</a>
                        <span class="mx-2 slash">/</span>
                        <span class="text-white"
                        ><strong>Contact Us</strong></span
                        >
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="site-section" id="next-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mb-5 mb-lg-0">
                    <form action="#" class="">
                        <div class="row form-group">
                            <div class="col-md-6 mb-3 mb-md-0">
                                <label class="text-black" for="fname"
                                >First Name</label
                                >
                                <input
                                        class="form-control"
                                        id="fname"
                                        type="text"
                                />
                            </div>
                            <div class="col-md-6">
                                <label class="text-black" for="lname"
                                >Last Name</label
                                >
                                <input
                                        class="form-control"
                                        id="lname"
                                        type="text"
                                />
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-12">
                                <label class="text-black" for="email"
                                >Email</label
                                >
                                <input
                                        class="form-control"
                                        id="email"
                                        type="email"
                                />
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-12">
                                <label class="text-black" for="subject"
                                >Subject</label
                                >
                                <input
                                        class="form-control"
                                        id="subject"
                                        type="subject"
                                />
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-12">
                                <label class="text-black" for="message"
                                >Message</label
                                >
                                <textarea
                                        class="form-control"
                                        cols="30"
                                        id="message"
                                        name="message"
                                        placeholder="Write your notes or questions here..."
                                        rows="7"
                                ></textarea>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-12">
                                <input
                                        class="btn btn-primary btn-md text-white"
                                        type="submit"
                                        value="Send Message"
                                />
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-lg-5 ml-auto">
                    <div class="p-4 mb-3 bg-white">
                        <p class="mb-0 font-weight-bold">Address</p>
                        <p class="mb-4">
                            1 University Avenue, Berekuso, Ghana
                        </p>

                        <p class="mb-0 font-weight-bold">Phone</p>
                        <p class="mb-4">
                            <a href="tel:+233 54 286 5328"
                            >+233 54 286 5328</a
                            >
                        </p>

                        <p class="mb-0 font-weight-bold">
                            Email Address
                        </p>
                        <p class="mb-0">
                            <a href="mailto:victor.quagraine@ashesi.edu.gh">victor.quagraine@ashesi.edu.gh</a>
                        </p>
                        <p class="mb-0">
                            <a href="mailto:delali.nsiah@ashesi.edu.gh">delali.nsiah@ashesi.edu.gh</a>
                        </p>
                        <p class="mb-0">
                            <a href="mailto:mohamed.habib@ashesi.edu.gh">mohamed.habib@ashesi.edu.gh</a>
                        </p>
                        <p class="mb-0">
                            <a href="mailto:emmanuel.agyei@ashesi.edu.gh">emmanuel.agyei@ashesi.edu.gh</a>
                        </p>
                    </div>
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
