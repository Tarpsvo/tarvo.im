<div id="endomondo-top-info">
    <div class="absolute-center modal-top-info-text">
        <h1>Tarvo</h1>
        <h2><?php echo $endomondoGeneralStats['total_workouts']; ?> workouts &#183; <?php echo $endomondoGeneralStats['total_kilometres']; ?> km</h2>
        <h3>endomondo</h3>
    </div>
</div>

<div id="endomondo-bottom-bars">
    <?php
    foreach ($endomondoLastFiveWeekStats as $weekNumber => $weekStats) {
        $mins = $weekStats->total_duration/60;
        $hours = intval($mins/60);
        $minutes = $mins % 60;
        $totalDuration = $hours."h:".$minutes."m";

        $startDay = date('j', strtotime($weekStats->start_date));
        $endDay = date('j M', strtotime($weekStats->end_date));
        $date = $startDay." - ".$endDay;

        echo "<div class='endomondo-week-bar'>";
            echo "<div class='endomondo-week-bar-overlay'>";
                echo "<div class='endomondo-week-circle-outer'>";
                    echo "<div class='endomondo-week-circle'>";
                        echo "<h2>".$weekStats->total_workouts."</h2>";
                        echo "<h3>total</h3>";
                    echo "</div>";
                echo "</div>";

                echo "<h1>".$date."</h1>";
                echo "<p>".$weekStats->total_distance." &#183; ".$totalDuration." &#183; ".$weekStats->total_calories." calories</p>";
            echo "</div>";
        echo "</div>";
    }
    ?>
</div>
