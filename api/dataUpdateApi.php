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

    public function updateGithubGeneralStats() {
        $reposList = $this->githubApi->getListOfRepos();

        foreach ($reposList as $key => $repo) {
            $commits = $this->githubApi->getNumberOfCommitsFromRepoUrl($repo->url);

            $unpreparedSQL = "REPLACE INTO github_repos (id, name, created, pushed, commits, html_url)
                                VALUES (:id, :name, :created, :pushed, :commits, :html_url)";

            $query = $this->connection->prepare($unpreparedSQL);
            $query->bindParam(':id', $repo->id);
            $query->bindParam(':name', $repo->name);
            $query->bindParam(':created', $repo->created_at);
            $query->bindParam(':pushed', $repo->pushed_at);
            $query->bindParam(':commits', $commits);
            $query->bindParam(':html_url', $repo->html_url);
            $query->execute();
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
