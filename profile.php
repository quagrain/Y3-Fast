<?php
include './settings/core.php';
include './functions/getProfileData.php';
$userData = getProfileData($_SESSION['user_id'], $_SESSION['role']);
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
                            <?php if ($_SESSION['role']=='JobSeeker' || $_SESSION['role']=='Employer'): ?>
                                <h2>Welcome <span id="welcome-username"><?= $userData['username'] ?></span></h2>
                            <?php else: ?>
                                <h2>Welcome <span id="welcome-username"></span>ADMIN</h2>
                            <?php endif; ?>
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
                                <label class="btn btn-primary btn-file border rounded-circle p-4 user_img" id="img_div">
                                    <img src="" id="photo" width="250px" height="250px" class="icon-line-profile-male border rounded-circle" style="object-fit: cover; display: none"/>
                                    <input type="file" id="profile_picture" name="profile_picture" accept=".png, .jpg, .jpeg" class="editable" disabled hidden/>
                                    <span id="placeholder_icon" class="icon-line-profile-male" style="font-size:200px;"></span>
                                </label>
                            </div>
                        </div>

                        <span id="usertype" style="display: none;"><?= $_SESSION['role'] ?></span>
                        <div class="form-group row">
                            <div class="col-md mb-3 mb-md-0">
                                <label for="email">Email</label>
                                <input type="text" class="form-control" id="email" placeholder=<?= $userData['email'] ?> readonly>
                            </div>
                
                            <div class="col">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" id="username" placeholder=<?= $userData['username'] ?> readonly>
                            </div>
                        </div>
                        <div class="row form-group mb-4">
                            <div class="col-md-12 mb-3 mb-md-0">
                                <label class="text-black" for="passwd">Password</label>
                                <div class="input-group">
                                    <h3 id="oldHashPass" style="display: none;"><?= $userData['passwd'] ?></h3>
                                    <input type="password" id="passwd" class="form-control editable" placeholder="Password" minlength="5" maxlength="50" aria-required="false">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary editable" type="button" id="togglePassword" aria-label="Toggle password visibility">
                                        <i class="fa fa-eye editable"></i>
                                        </button>
                                    </div>
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
                        </div>
                        <?php
                        // Content to display when the user is an employer
                        if (isset($_SESSION['role']) && $_SESSION['role'] == 'Employer') {
                            // Start of HTML block
                            echo '                        
                                <div class="form-group row">
                                    <div class="col-md-6 mb-3 mb-md-0">
                                        <label for="org_name">Company Name</label>
                                        <input type="text" class="form-control editable" id="org_name" placeholder="' . htmlspecialchars($userData['org_name'], ENT_QUOTES, 'UTF-8') . '" 
                                            value="' . htmlspecialchars($userData['org_name'], ENT_QUOTES, 'UTF-8') . '" disabled>
                                    </div>
                                    
                                    <div class="col-md-6 mb-3 mb-md-0">
                                        <label for="industry">Industry</label>
                                        <input type="text" class="form-control editable" id="industry" placeholder="' . htmlspecialchars($userData['industry'], ENT_QUOTES, 'UTF-8') . '" 
                                            value="' . htmlspecialchars($userData['industry'], ENT_QUOTES, 'UTF-8') . '" disabled>
                                    </div>
                                </div>
                                                                                           
                                <div class="form-group">
                                    <label for="creation_date">
                                        Date Established<span class="icon-calendar pl-2"></span>
                                    </label>
                                    ' . htmlspecialchars($userData['creation_date'], ENT_QUOTES, 'UTF-8') . '
                                    <input id="creation_date" class="form-control editable" type="date" value="' . htmlspecialchars($userData['creation_date'], ENT_QUOTES, 'UTF-8') . '" disabled>
                                </div>
                                
                      
                                <div class="row form-group">
                                    <div class="col-md mb-4 mb-md-0">
                                        <label for="tag_id">
                                            Search Tags
                                            <span class="icon-info-circle" data-toggle="tooltip" data-placement="right" title="Search tags help categorize and find jobs more easily"></span>
                                        </label>';

                                    // Include PHP script
                                    include './actions/get_tags_4_dropdown.php';

                                    // Continue HTML block
                                    echo '<select id="tags" class="selectpicker form-control border rounded" multiple>';

                                    // Check for tags and output options
                                    if ($tags->num_rows > 0) {
                                        foreach ($tags as $tag) {
                                            if (in_array($tag['tag_id'], json_decode($userData['tag_ids'], true))) {
                                                echo '<option value="' . htmlspecialchars($tag['tag_id']) . '" selected>' . htmlspecialchars($tag['tag_name']) . '</option>';
                                            } else {
                                                echo '<option value="' . htmlspecialchars($tag['tag_id']) . '">' . htmlspecialchars($tag['tag_name']) . '</option>';
                                            }
                                        }
                                    } else {
                                        echo '<option disabled>No tags found</option>';
                                    }

                                    // Close HTML
                                    echo '</select>
                                </div>
                            </div>';
                        } else { 
                            // Content when user is a JobSeeker
                            echo '

                            <div class="form-group row">
                                <div class="col-md-6 mb-3 mb-md-0">
                                    <label for="fname">First Name</label>
                                    <input type="text" class="form-control editable" id="fname" placeholder="Jane" 
                                        value="' . htmlspecialchars($userData['fname'], ENT_QUOTES, 'UTF-8') . '" disabled>
                                </div>

                                <div class="col-md mb-3 mb-md-0">
                                    <label for="lname">Last Name</label>
                                    <input id="lname" type="text" placeholder="Doe" class="form-control editable" 
                                        value="' . htmlspecialchars($userData['lname'], ENT_QUOTES, 'UTF-8') . '" disabled>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-6 mb-3 mb-md-0">
                                    <label for="occupation">Occupation</label>
                                    <input type="text" class="form-control editable" id="occupation" placeholder="Student" 
                                        value="' . htmlspecialchars($userData['occupation'], ENT_QUOTES, 'UTF-8') . '" disabled>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea id="description" class="form-control no-resize editable" rows="4" style="resize:none" placeholder="Enter some information about yourself" disabled>
                                    ' . htmlspecialchars($userData['description'], ENT_QUOTES, 'UTF-8') . '
                                </textarea>
                            </div>

                            <div class="form-group">
                                <label for="date_of_birth">
                                    Date of Birth <span class="icon-calendar pl-2"></span>
                                </label>
                                <input id="date_of_birth" class="form-control editable" type="date" value="' . htmlspecialchars($userData['date_of_birth'], ENT_QUOTES, 'UTF-8') . '" disabled>
                            </div>

                            <div class="form-group">
                                <label for="cv">Upload Resume</label> <br>
                                <label class="btn btn-primary btn-md btn-file">
                                    Browse File <input type="file" id="cv" name="cv" accept=".pdf" class="editable" hidden disabled>
                                </label>
                                <span id="cv_name">No file chosen</span>
                            </div>
                            ';
                        }
                        ?>

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
<script src="js/validation.js"></script>


</body>
</html>
