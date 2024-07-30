
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">



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
    <?php include 'header.php'?>

    <!-- HOME -->
    <section class="section-hero overlay inner-page bg-image" style="background-image: url('images/hero_1.jpg');" id="home-section">
      <div class="container">
        <div class="row">
          <div class="col-md-7">
            <h1 class="text-white font-weight-bold">Login</h1>
            <div class="custom-breadcrumbs">
              <a href="index.html">Home</a> <span class="mx-2 slash">/</span>
              <span class="text-white"><strong>Log In</strong></span>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="site-section">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-6">
            <h2 class="mb-4">Log In To JobBoard</h2>

            <form action="login_user_action.php" class="p-4 border rounded shadow">

              <div class="row form-group">
                <div class="col-md-12 mb-3 mb-md-0">
                  <label class="text-black" for="email">Email</label>
                  <input type="email" id="email" class="form-control" placeholder="Email address" required aria-required="true">
                </div>
              </div>

              <div class="row form-group mb-4">
                <div class="col-md-12 mb-3 mb-md-0">
                  <label class="text-black" for="passwd">Password</label>
                  <div class="input-group">
                    <input type="password" id="passwd" class="form-control" placeholder="Password" minlength="5" maxlength="50" required aria-required="true">
                    <div class="input-group-append">
                      <button class="btn btn-outline-secondary" type="button" id="togglePassword" aria-label="Toggle password visibility">
                        <i class="fa fa-eye" aria-hidden="true"></i>
                      </button>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row form-group">
                <div class="col-md-12">
                  <input type="submit" value="Log In" class="btn px-4 btn-primary text-white" onclick="handleLogin(event)">
                </div>
              </div>

              <div class="row justify-content-end pr-3">
                <a href="signup.html" class="font-weight-light text-primary small">Don't have an account? Create one!</a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>
    
    <!-- FOOTER -->
    <?php include 'footer.php'?>
  
  </div>

    <!-- SCRIPTS -->
  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.bundle.min.js"></script>
  <script src="js/stickyfill.min.js"></script>
  <script src="js/isotope.pkgd.min.js"></script>
  <script src="js/jquery.fancybox.min.js"></script>
  <script src="js/jquery.easing.1.3.js"></script>

  <script src="js/jquery.waypoints.min.js"></script>
  <script src="js/jquery.animateNumber.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/quill.min.js"></script>
  <script src="js/bootstrap-select.min.js"></script>
  <script src="js/custom.js"></script>
  <script src="js/login_user.js"></script>

  <script src="js/domContentLoadedListener.js"></script>

     
  </body>
</html>