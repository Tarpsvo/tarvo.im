<?php
require __DIR__.'/api/dataApi.php';
$dataApi = new dataApi;
$githubGeneralStats = $dataApi->getGithubGeneralStats();
$endomondoGeneralStats = $dataApi->getEndomondoGeneralStats();
$githubRepos = $dataApi->getGithubRepos();
$endomondoLastFiveWeekStats = $dataApi->getEndomondoLastFiveWeekStats();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Tarvo.im</title>

        <link rel="stylesheet" href="css/reset.css" charset="utf-8">
        <link rel="stylesheet" href="css/main.css" charset="utf-8">
        <link rel="stylesheet" href="css/boxes.css" charset="utf-8">
        <link rel="stylesheet" href="css/modal.css" charset="utf-8">
        <link rel="stylesheet" href="css/github.css" charset="utf-8">
        <link rel="stylesheet" href="css/endomondo.css" charset="utf-8">
    </head>

    <body>
        <div id="page-loading-indicator" class="absolute-center"></div>

        <div class="absolute-center" id="page-content-wrap">
            <div class="main-page-top-box">
                <h1>Tarvo<span class="underscore">_</span></h1>
            </div>

            <div class="main-page-box" style="left: 0;" id="sport-box">
                <div class="box-content main-page-box-content modal-trigger">
                    <a class="close-modal-button">×</a>

                    <div class="center-text-img absolute-center">
                        <h2>SPORT</h2>
                    </div>

                    <div class="modal-content absolute-center" id="endomondo-modal-content">
                        <?php include 'tmpl/endomondo-main.php'; ?>
                    </div>
                </div>
            </div>

            <div class="main-page-box" style="right: 0;" id="coding-box">
                <div class="box-content main-page-box-content modal-trigger">
                    <a class="close-modal-button">×</a>

                    <div class="modal-content-wrapper">
                        <div class="center-text-img absolute-center">
                            <h2>CODING</h2>
                        </div>

                        <div class="modal-content absolute-center" id="github-modal-content">
                            <?php include 'tmpl/github-main.php'; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main scripts -->
        <script src="js/jquery-1.11.3.js"></script>

        <!-- Page scripts  -->
        <script src="js/tramvai/endomondoView.js"></script>
        <script src="js/tramvai/githubView.js"></script>
        <script src="js/tramvai/mainPage.js"></script>
        <script src="js/main.js"></script>
    </body>
</html>
