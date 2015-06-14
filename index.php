<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Tramvai.im</title>

        <link rel="stylesheet" href="css/reset.css" charset="utf-8">
        <link rel="stylesheet" href="css/main.css" charset="utf-8">
        <link rel="stylesheet" href="css/boxes.css" charset="utf-8">
        <link rel="stylesheet" href="css/ripple.css" charset="utf-8">
        <link rel="stylesheet" href="css/modal.css" charset="utf-8">
    </head>

    <body>
        <div class="absolute-center" id="page-content-wrap">
            <div class="left-side-box" style="top: 0;" id="sport-box">
                <h1 class="box-title">Sport</h1>

                <div class="box-content left-side-box-content ripple modal-trigger">
                    <div class="large-stats absolute-center">
                        <h2>423 workouts</h2>
                        <h2>6923 kilometres</h2>
                    </div>

                    <div class="tracker-logo" id="tracker-endomondo"><p>endomondo</p></div>
                </div>
            </div>

            <div class="left-side-box" style="bottom: 0;" id="coding-box">
                <h1 class="box-title">Coding</h1>

                <div class="box-content left-side-box-content ripple modal-trigger">
                    <div class="large-stats absolute-center">
                        <h2>6 projects</h2>
                        <h2>123 commits</h2>
                    </div>

                    <div class="tracker-logo" id="tracker-github"><p>github</p></div>
                </div>
            </div>

            <div id="notes-box">
                <h1 class="box-title">Notes</h1>

                <div id="notes-box-content" class="box-content ripple modal-trigger">
                    <div class="large-stats absolute-center">
                        <h2>todo</h2>
                    </div>
                </div>
            </div>
        </div>

        <script src="js/jquery-1.11.3.min.js"></script>
        <script src="js/boxes.js"></script>
        <script src="js/modal.js"></script>
        <script src="js/ripple.js"></script>
    </body>
</html>
