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

    <!-- HOME -->
    <section class="section-hero overlay inner-page bg-image" style="background-image: url('images/hero_1.jpg');" id="home-section">
      <div class="container">
        <div class="row">
          <div class="col-md-7">
            <h1 class="text-white font-weight-bold">Profile</h1>
            <div class="custom-breadcrumbs">
              <a href="index.php">Home</a> <span class="mx-2 slash">/</span>
              <span class="text-white"><strong>Profile</strong></span>
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
                <h2>Welcome <span id="welcome-username">{username}</span></h2>
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="d-flex justify-content-end">
              <button class="btn btn-primary" id="edit-profile-btn" onclick="toggleEdit()">
                Edit <span class="icon-pencil pl-4"></span>
              </button>
            </div>
          </div>
        </div>

        <div class="row mb-5">
          <div class="col-lg-12">
            <form class="p-4 p-md-5 border" method="post" action="" id="user_profile_form">
              <div class="form-group row justify-content-center">
                <div class="row justify-content-center">
                    <label class="btn btn-primary btn-file border rounded-circle p-4">
                      <input type="file" id="profile_picture" accept=".png, .jpg, .jpeg" class="editable" disabled hidden/>
                      <span class="icon-line-profile-male" style="font-size:10vh;"></span>
                      <!-- could be based on gender: icon-line-profile-female for female outline-->
                    </label>
                </div>
              </div>

              <div class="form-group row">
                <div class="col-md mb-3 mb-md-0">
                  <label for="email">Email</label>
                  <input type="text" class="form-control" id="email" placeholder="{Replace with current user's email}" readonly>
                </div>

                <div class="col">
                  <label for="username">Username</label>
                  <input type="text" class="form-control" id="username" placeholder="{Replace with current username}" readonly>
                </div>
              </div>

              <div class="form-group row">
                <div class="col-md-6 mb-3 mb-md-0">
                  <label for="fname">First Name</label>
                  <input type="text" class="form-control editable" id="fname" placeholder="Jane" disabled>
                </div>

                <div class="col-md mb-3 mb-md-0">
                  <label for="lname">Last Name</label>
                  <input id="lname" type="text" placeholder="Doe" class="form-control editable" disabled>
                </div>
              </div>

              <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" class="form-control no-resize editable" rows="4" style="resize:none" placeholder="Enter some information about yourself" disabled>{Fill with description from db}</textarea>
              </div>

              <div class="form-group">
                <label for="date_of_birth">
                  Date of Birth <span class="icon-calendar pl-2"></span>
                </label>
                <input id="date_of_birth" class="form-control editable" type="date" disabled>
              </div>

              <div class="form-group">
                <label for="cv">Upload Resume</label> <br>
                <label class="btn btn-primary btn-md btn-file">
                  Browse File <input type="file" id="cv" accept=".pdf" class="editable" hidden disabled>
                </label>
              </div>

              <div class="row justify-content-center">
                <div class="col-6 mt-5">
                  <button class="btn btn-block btn-primary btn-md text-white" id="update-profile-btn" onclick="handleUpdateProfile(event)" disabled>Update Profile</button>
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

  <script src="js/edit_profile.js"></script>

  <script src="js/custom.js"></script>
  <script src="js/domContentLoadedListener.js"></script>



  </body>
</html>