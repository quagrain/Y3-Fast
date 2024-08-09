<!-- HOME -->
<?php
session_start();
include './functions/getApplicantsData.php';
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

    <section class="site-section" id="applicants">
        <div class="container">
            <div class="row mb-5 justify-content-center">
                <div class="col-md-7 text-center">
                    <h2 class="section-title mb-2">
                        <?= getNumApplicantsPerJob($_SESSION['user_id'], $_GET['job_id']) ?> Candidates
                    </h2>
                </div>
            </div>

            <?php
            $totalApplicants = getNumApplicantsPerJob($_SESSION['user_id'], $_GET['job_id']);
            $applicantsPerPage = 10;
            $totalPages = ceil($totalApplicants / $applicantsPerPage);
            $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
            $start = ($currentPage - 1) * $applicantsPerPage + 1;
            $end = min($start + $applicantsPerPage - 1, $totalApplicants);
            ?>

            <?php
            include './functions/getApplicantsList.php';
            getApplicantsList($start, $applicantsPerPage, $_SESSION['user_id'], $_GET['job_id']);
            ?>


            <div class="row pagination-wrap">
                <div class="col-md-6 text-center text-md-left mb-4 mb-md-0">
                    <span>Showing <?= $start ?>-<?= $end ?> Of <?= $totalApplicants ?></span>
                </div>
                <div class="col-md-6 text-center text-md-right">
                    <div class="custom-pagination ml-auto">
                        <?php if ($currentPage > 1): ?>
                            <a href="?job_id=<?= $_GET['job_id'] ?>&page=<?= $currentPage - 1 ?>#applicants" class="prev">Prev</a>
                        <?php endif; ?>
                        <div class="d-inline-block">
                            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                                <a href="?job_id=<?= $_GET['job_id'] ?>&page=<?= $i ?>#applicants" class="<?= $i == $currentPage ? 'active' : '' ?>"><?= $i ?></a>
                            <?php endfor; ?>
                        </div>
                        <?php if ($currentPage < $totalPages): ?>
                            <a href="?job_id=<?= $_GET['job_id'] ?>&page=<?= $currentPage + 1 ?>#applicants" class="next">Next</a>
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
    function changeButton(event, appId) {
        const status = document.querySelector(`#application_status_${appId}`);
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
                status.classList.add('btn-success');
                break;
        }
        handleApplication(event, appId);
    }

    function handleApplication(event, appId) {
        const selectedStatus = event.target.value;

        console.log('Application status changed to:', selectedStatus, 'for appId:', appId);

        updateApplicationStatus(selectedStatus, appId);
    }

    function updateApplicationStatus(status, appId) {
        fetch('./actions/update_application_status.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                status: status,
                appId: appId
            })
        })
            .then(response => response.json())
            .then(response => {
                if (response.status === 1) {
                    console.log(response.message);
                } else {
                    throw new Error(response.message);
                }
            })
            .catch((error) => {
                console.error('Error:', error);
            });
    }

    function downloadCV(event) {
        // Prevent default action
        event.preventDefault();

        // Get the CV file URL from the data-src attribute
        const cvUrl = $(event.target).attr('data-src');

        // Perform an AJAX request or simply redirect to download the file
        if (cvUrl) {
            // Using window.location to trigger the download
            window.open(cvUrl, '_blank');
        } else {
            console.error('No CV file found for download.');
        }
    }

    document.addEventListener('DOMContentLoaded', () => {
        const statuses = document.querySelectorAll('.application_status');
        statuses.forEach((statusElement) => {
            const appId = statusElement.id.split('_').pop();
            changeButton(null, appId);
        });
    });
</script>

</body>
</html>