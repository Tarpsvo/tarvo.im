<?php
require_once __DIR__.'/mainConfig.php';
require_once __DIR__.'/githubApi.php';
require_once __DIR__.'/endomondoApi.php';

class dataUpdateApi {
    private $connection, $githubApi, $endomondoApi;

    public function __construct() {
        $this->githubApi = new githubApi;
        $this->endomondoApi = new endomondoApi;

        $this->connection = mainConfig::connectToDatabase();
    }

    /**
     * Retrieves Github general stats through the Github API and saves them into local database
     */
    public function updateGithubGeneralStats() {
        $repositoryCount = $this->githubApi->getNumberOfRepos();
        $totalCommits = $this->githubApi->getNumberOfCommits();

        if (isset($repositoryCount) && isset($totalCommits)) {
            if (is_numeric($repositoryCount) && is_numeric($totalCommits)) {
                $unpreparedSQL = "INSERT INTO github_general (repository_count, total_commits) VALUES (:repository_count, :total_commits)";
                $query = $this->connection->prepare($unpreparedSQL);
                $query->bindParam(':repository_count', $repositoryCount);
                $query->bindParam(':total_commits', $totalCommits);
                $query->execute();
            } else {
                // FIXME Value(s) not numeric
            }
        } else {
            // FIXME Value(s) null
        }
    }

    public function updateEndomondoWorkouts() {
        $allWorkouts = $this->endomondoApi->getAllWorkouts();

        foreach ($allWorkouts as $key => $workout) {
            if (isset($workout)) {
                $unpreparedSQL = "INSERT IGNORE INTO endomondo_workouts (sport, distance, duration, speed_avg, calories, start_time, altitude_min, altitude_max, descent, ascent, privacy_workout, workout_id, hydration, peptalks, likes, comments, burgers_burned, device_workout_id, owner_id, privacy_map, speed_max)
                                    VALUES (:sport, :distance, :duration, :speed_avg, :calories, :start_time, :altitude_min, :altitude_max, :descent, :ascent, :privacy_workout, :workout_id, :hydration, :peptalks, :likes, :comments, :burgers_burned, :device_workout_id, :owner_id, :privacy_map, :speed_max)";

                $query = $this->connection->prepare($unpreparedSQL);
                $query->bindParam(':sport', $workout->sport);
                $query->bindParam(':distance', $workout->distance);
                $query->bindParam(':duration', $workout->duration);
                $query->bindParam(':speed_avg', $workout->speed_avg);
                $query->bindParam(':calories', $workout->calories);
                $query->bindParam(':start_time', $workout->start_time);
                $query->bindParam(':altitude_min', $workout->altitude_min);
                $query->bindParam(':altitude_max', $workout->altitude_max);
                $query->bindParam(':descent', $workout->descent);
                $query->bindParam(':ascent', $workout->ascent);
                $query->bindParam(':privacy_workout', $workout->privacy_workout);
                $query->bindParam(':workout_id', $workout->id);
                $query->bindParam(':hydration', $workout->hydration);
                $query->bindParam(':peptalks', $workout->lcp_count->peptalks);
                $query->bindParam(':likes', $workout->lcp_count->likes);
                $query->bindParam(':comments', $workout->lcp_count->comments);
                $query->bindParam(':burgers_burned', $workout->burgers_burned);
                $query->bindParam(':device_workout_id', $workout->device->workout_id);
                $query->bindParam(':owner_id', $workout->owner_id);
                $query->bindParam(':privacy_map', $workout->privacy_map);
                $query->bindParam(':speed_max', $workout->speed_max);
                $query->execute();
            }
        }
    }
}
