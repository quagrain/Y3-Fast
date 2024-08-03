<?php
  include './settings/core.php'; // check if logged in

  // check if user is a registered Employer
  if (!$_SESSION['role']=='Employer') {
    header("location: index.php");
  }
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
    </div> <!-- .site-mobile-menu -->


    <!-- NAVBAR -->
    <?php include "header.php"; ?>

    <!-- HOME -->
    <section class="section-hero overlay inner-page bg-image" style="background-image: url('images/hero_1.jpg');" id="home-section">
      <div class="container">
        <div class="row">
          <div class="col-md-7">
            <h1 class="text-white font-weight-bold">Post A Job</h1>
            <div class="custom-breadcrumbs">
              <a href="#">Home</a> <span class="mx-2 slash">/</span>
              <a href="#">Job</a> <span class="mx-2 slash">/</span>
              <span class="text-white"><strong>Post a Job</strong></span>
            </div>
          </div>
        </div>
      </div>
    </section>


    <section class="site-section">
      <div class="container">

        <div class="row align-items-center mb-5">
          <div class="col-lg-8 mb-4 mb-lg-0">
            <div class="d-flex align-items-center">
              <div>
                <h2>Post A Job</h2>
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="row justify-content-end">
              <div class="col-6">
                <a href="#" class="btn btn-block btn-light btn-md"><span class="icon-open_in_new mr-2"></span>Preview</a>
              </div>
            </div>
          </div>
        </div>

        <div class="row mb-5">
          <div class="col-lg-12">
            <form class="p-4 p-md-5 border rounded" method="post" action="" id="post-job-form">
              <h3 class="text-black mb-5 border-bottom pb-2">Job Details</h3>

              <div class="form-group">
                <label for="company-website-tw d-block">Upload Featured Image</label> <br>
                <label class="btn btn-primary btn-md btn-file">
                  Browse File <input type="file" id="featured-image" accept=".png, .jpg, .jpeg" hidden>
                </label>
              </div>

              <div class="form-group">
                <label for="email">Email</label>
                <input type="text" class="form-control" id="email" placeholder="you@yourdomain.com">
              </div>

              <div class="form-group">
                <label for="job-title">Job Title</label>
                <input type="text" class="form-control" id="job-title" placeholder="Product Designer">
              </div>

              <div class="form-group row">
                <div class="col-md-6 mb-3 mb-md-0">
                  <label for="job-location">Location</label>
                  <input type="text" class="form-control" id="job-location" placeholder="e.g. Tema">
                </div>

                <div class="col-md mb-3 mb-md-0">
                  <label for="job-region">Job Region</label>
                  <select class="form-control selectpicker border rounded" id="job-region" data-style="btn-black" data-live-search="true" title="Select Region">
                    <option>Anywhere</option>
                    <option>Greater Accra</option>
                    <option>Central</option>
                    <option>Eastern</option>
                    <option>Bono</option>
                    <option>Ahafo</option>
                    <option>Western</option>
                    <option>Oti</option>
                    <option>Upper East</option>
                  </select>
                </div>

                <div class="col-md mb-3 mb-md-0">
                  <label for="gender">Gender</label>
                  <select class="form-control selectpicker border rounded" id="gender" data-style="btn-black" title="Preferred Gender">
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Other">Other</option>
                    <option value="Any">Any</option>
                  </select>
                </div>
              </div>

              <div class="form-group">
                <label for="job_description">Job Description</label>
                <div class="editor editor-1" id="job_description">
                  <p>Write Job Description!</p>
                </div>
              </div>

              <div class="form-group row">
                <div class="col-md-2 mb-3 mb-md-0">
                  <label for="vacancy">Vacancy</label>
                  <input type="number" class="form-control" id="vacancy" placeholder="100" min="1", aria-valuemin="1"/>
                </div>

                <div class="col-md mb-3 mb-md-0">
                  <label for="experience">Experience (min.)</label>
                  <div class="input-group">
                    <input id="experience" type="number" class="form-control" placeholder="0" min="0" aria-valuemin="1"/>
                    <div class="input-group-append">
                      <span class="input-group-text">years</span>
                    </div>
                  </div>
                </div>

                <div class="col-md mb-3 mb-md-0">
                  <label for="salary">Salary</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">$</span>
                    </div>
                    <input id="salary" type="number" class="form-control" placeholder="100,000" min="1" aria-valuemin="1"/>
                  </div>
                </div>



                <div class="col-md mb-3 mb-md-0">
                  <label for="job-type">Employment Status</label>
                  <select class="form-control selectpicker border rounded" id="job-type" data-style="btn-black" title="Select Status">
                    <option value="Part-Time">Part Time</option>
                    <option value="Full-Time">Full Time</option>
                    <option value="Contract">Contract</option>
                  </select>
                </div>
              </div>

              <div class="form-group">
                <label for="benefits">Benefits</label>
                <div class="input-group mb-3">
                  <input id="benefits" class="form-control" type="text" placeholder="Dental care for employee and family members">
                  <div class="input-group-append">
                    <button class="btn btn-primary btn-outline-secondary" type="button" id="add_benefits">+</button>
                  </div>
                </div>
              </div>
              <div id="additional_benefits"></div>

              <div class="form-group">
                <label for="responsibility">Responsibility</label>
                <div class="input-group mb-3">
                  <input id="responsibility" class="form-control" type="text" placeholder="Managing a team of artists to create animations">
                  <div class="input-group-append">
                    <button class="btn btn-primary btn-outline-dark" type="button" id="add_responsibility">+</button>
                  </div>
                </div>
                <div id="additional_responsibilities"></div>
              </div>

                <div class="form-group">
                  <label for="application_deadline">
                    Application Deadline <span class="icon-calendar pl-2"></span>
                  </label>
                  <input id="application_deadline" class="form-control" type="date"/>
                </div>

                <div class="row justify-content-center">
                  <div class="col-6 mt-5">
                    <a class="btn btn-block btn-primary btn-md" onclick="handlePostJob(event)">Post Job</a>
                  </div>
                </div>
            </form>
          </div>
        </div>

      </div>
    </section>

    <?php include "footer.php"; ?>

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

  <script src="js/post_job.js"></script>

  <script src="js/custom.js"></script>
  <script src="js/domContentLoadedListener.js"></script>



  </body>
</html>
