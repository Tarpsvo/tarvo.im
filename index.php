<?php
require_once('api/dataApi.php');
$dataApi = new dataApi;
$githubGeneralStats = $dataApi->getGithubGeneralStats();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Tarvo.im</title>

        <link rel="stylesheet" href="css/reset.css" charset="utf-8">
        <link rel="stylesheet" href="css/main.css" charset="utf-8">
        <link rel="stylesheet" href="css/boxes.css" charset="utf-8">
        <link rel="stylesheet" href="css/ripple.css" charset="utf-8">
        <link rel="stylesheet" href="css/modal.css" charset="utf-8">
    </head>

    <body>
        <div id="page-loading-indicator" class="absolute-center"></div>

        <div class="absolute-center" id="page-content-wrap">
            <div class="left-side-box" style="top: 0;" id="sport-box">
                <h1 class="box-title">SPORT</h1>

                <div class="box-content left-side-box-content ripple modal-trigger">
                    <a class="close-modal-button">×</a>

                    <div class="large-stats absolute-center">
                        <h2>423 workouts</h2>
                        <h2>6923 kilometres</h2>

                        <div class="modal-loading-indicator"></div>
                    </div>

                    <div class="tracker-logo" id="tracker-endomondo"><p>endomondo</p></div>
                </div>
            </div>

            <div class="left-side-box" style="bottom: 0;" id="coding-box">
                <h1 class="box-title">CODING</h1>

                <div class="box-content left-side-box-content ripple modal-trigger">
                    <a class="close-modal-button">×</a>

                    <div class="large-stats absolute-center">
                        <h2><?php echo $githubGeneralStats['repository_count']; ?> repos</h2>
                        <h2><?php echo $githubGeneralStats['total_commits']; ?> commits</h2>

                        <div class="modal-loading-indicator"></div>
                    </div>

                    <div class="tracker-logo" id="tracker-github"><p>github</p></div>
                </div>
            </div>

            <div id="notes-box">
                <h1 class="box-title">NOTES</h1>

                <div id="notes-box-content" class="box-content ripple modal-trigger">
                    <a class="close-modal-button">×</a>

                    <div class="large-stats absolute-center">
                        <h2>todo</h2>

                        <div class="modal-loading-indicator"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main scripts -->
        <script src="js/jquery-1.11.3.js"></script>
        <script src="js/underscore.js"></script>
        <script src="js/backbone.js"></script>

        <!-- Angular -->
        <script src="js/tramvai/mainPage.js"></script>

        <!-- UI effects -->
        <script src="js/ui/ripple.js"></script>
    </body>
</html>
