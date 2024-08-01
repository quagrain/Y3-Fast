<!doctype html>
<html lang="en">
<head>
    <title>JobBoard</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="../css/custom-bs.css">
    <link rel="stylesheet" href="../css/jquery.fancybox.min.css">
    <link rel="stylesheet" href="../css/bootstrap-select.min.css">
    <link rel="stylesheet" href="../fonts/icomoon/style.css">
    <link rel="stylesheet" href="../fonts/line-icons/style.css">
    <link rel="stylesheet" href="../css/owl.carousel.min.css">
    <link rel="stylesheet" href="../css/animate.min.css">
    <link rel="stylesheet" href="../css/quill.snow.css">
    <!-- <link rel="stylesheet" href="../css/bootstrap.min.css"> -->

    <!-- MAIN CSS -->
    <link rel="stylesheet" href="../css/style.css">
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
   <?php include "../header.php"; ?>

    <!-- HOME -->
    <section class="section-hero overlay inner-page bg-image" style="background-image: url('../images/hero_1.jpg');" id="home-section">
        <div class="container">
            <div class="row">
                <div class="col-md-7">
                    <h1 class="text-white font-weight-bold">SignUp</h1>
                    <div class="custom-breadcrumbs">
                        <a href="../index.php">Home</a> <span class="mx-2 slash">/</span>
                        <span class="text-white"><strong>Sign Up</strong></span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="site-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 mb-5">
                    <h2 class="mb-4">Sign Up To JobBoard</h2>

                    <form action="" class="p-4 border rounded shadow" novalidate>

                        <div class="row form-group">
                            <div class="col-md-12 mb-3 mb-md-0">
                                <label class="text-black" for="email">Email</label>
                                <input type="email" id="email" class="form-control" placeholder="Email address" required>
                                <div class="invalid-feedback">
                                    Please enter a valid email address (e.g., user@example.com).
                                </div>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-7 mb-3 mb-md-0">
                                <label class="text-black" for="username">Username</label>
                                <input type="text" id="username" class="form-control" placeholder="Username" required>
                                <div class="invalid-feedback">
                                    Username must be 3-20 characters long and contain only letters, numbers, and underscores.
                                </div>
                            </div>

                            <div class="col-md-5 mb-3 mb-md-0">
                                <label class="text-black" for="usertype">Account Type</label>
                                <select id="usertype" class="form-control selectpicker border rounded" required onchange="showAdditionalFields()">
                                    <option value="">Select account type</option>
                                    <option value="JobSeeker">Job Seeker</option>
                                    <option value="Employer">Employer</option>
                                </select>
                                <div class="invalid-feedback">
                                    Please select an account type.
                                </div>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-12 mb-3 mb-md-0">
                                <label class="text-black" for="passwd">Password</label>
                                <input type="password" id="passwd" class="form-control" placeholder="Password" required>
                                <div class="invalid-feedback" id="passwordFeedback">
                                    <ul>
                                        <li id="lengthError">Password must be 5-50 characters long.</li>
                                        <li id="letterError">Password must include at least one letter.</li>
                                        <li id="numberError">Password must include at least one number.</li>
                                        <li id="specialError">Password must include at least one special character (@$!%*#?&).</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-12 mb-3 mb-md-0">
                                <label class="text-black" for="re_passwd">Re-Type Password</label>
                                <input type="password" id="re_passwd" class="form-control" placeholder="Re-type Password" required>
                                <div class="invalid-feedback">
                                    Passwords do not match.
                                </div>
                            </div>
                        </div>

                        <!--Show these fields if dropdown is job seeker -->
                        <div id="job_seeker_fields" style="display:none">
                            <div class="row form-group">
                                <div class="col-md mb-3 mb-md-0">
                                    <label for="fname">First Name</label>
                                    <input id="fname" type="text" class="form-control" placeholder="John" maxlength="50" required/>
                                </div>
                                <div class="col-md">
                                    <label for="lname">Last Name</label>
                                    <input id="lname" type="text" class="form-control" placeholder="Doe" maxlength="50" required/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="date_of_birth">Date of Birth</label>
                                <input id="date_of_birth" class="form-control" type="date" max="2005-12-31" required aria-required="true"/>
                            </div>

                            <div class="form-group">
                                <label for="occupation">Occupation</label>
                                <input id="occupation" type="text" class="form-control" placeholder="Web Developer" maxlength="255"/>
                            </div>

                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea id="description" class="form-control no-resize" rows="4" style="resize:none" placeholder="Enter some information about yourself"></textarea>
                            </div>
                        </div>


                        <!--Additional fields for employers-->
                        <div id="employer_fields" style="display:none">
                            <div class="form-group">
                                <label for="org_name">Company Name</label>
                                <input id="org_name" type="text" class="form-control" placeholder="Y3 Fast" maxlength="100"/>
                            </div>

                            <div class="form-group">
                                <label for="industry">Industry</label>
                                <input id ="industry" type="text" class="form-control" placeholder="Technology"/>
                            </div>

                            <div class="form-group">
                                <label for="creation_date">Date Established</label>
                                <input id="creation_date" type="date" class="form-control"/>
                            </div>

                            <div class="form-group">
                                <label for="tag_id">
                                    Search Tags
                                    <span class="icon-info-circle" data-toggle="tooltip" data-placement="right" title="Search tags help categorize and find jobs more easily"></span>
                                </label>
                                <script>
                                    $(function () {
                                        $('[data-toggle="tooltip"]').tooltip()
                                    })
                                </script>
                                <div class="input-group mb-3">
                                    <input id="tag_id" type="text" class="form-control" placeholder="Fintech">
                                    <div class="input-group-append">
                                    <button class="btn btn-primary btn-outline-dark" type="button" id="add_tag">+</button>
                                    </div>
                                </div>
                                <div id="additional_tags"></div>
                            </div>
                        </div>



                        <div class="row form-group">
                            <div class="col-md-12">
                                <input type="submit" value="Sign Up" class="btn px-4 btn-primary text-white" id="submitBtn" onclick="handleSignUp(event)">
                            </div>
                        </div>

                        <div class="row justify-content-end pr-3">
                            <a href="../login/login.php" class="font-weight-light text-primary small">Have an account? Log in!</a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </section>

    <?php include "../footer.php"; ?>

</div>

<!-- SCRIPTS -->

<script src="../js/jquery.min.js"></script>
<script src="../js/bootstrap.bundle.min.js"></script>
<script src="../js/isotope.pkgd.min.js"></script>
<script src="../js/stickyfill.min.js"></script>
<script src="../js/jquery.fancybox.min.js"></script>
<script src="../js/jquery.easing.1.3.js"></script>
<script src="../js/jquery.waypoints.min.js"></script>
<script src="../js/jquery.animateNumber.min.js"></script>
<script src="../js/owl.carousel.min.js"></script>
<script src="../js/quill.min.js"></script>
<script src="../js/bootstrap-select.min.js"></script>
<script src="../js/custom.js"></script>
<script src="../js/validation.js"></script>
<script src="../js/onChangeEvents.js"></script>

<script src="../js/register_user.js"></script>

</body>
</html>
