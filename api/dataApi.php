<?php
require_once __DIR__.'/mainConfig.php';

class dataApi {
    private $connection;

    public function __construct() {
        $this->connection = mainConfig::connectToDatabase();
    }

    /**
     * Retrieves Github general statistics from local database
     * @return array    Contains 'repository_count' and 'total_commits' values
     */
    public function getGithubGeneralStats() {
        $dataArray = array('total_repos' => 0, 'total_commits' => 0);

        $totalReposQuery = "SELECT COUNT(*) FROM github_repos";
        $result = $this->connection->query($totalReposQuery);
        $result = $result->fetchAll(PDO::FETCH_ASSOC)[0]['COUNT(*)'];
        $dataArray['total_repos'] = (isset($result) && is_numeric($result)) ? $result : 0;

        $totalCommitsQuery = "SELECT SUM(commits) FROM github_repos";
        $result = $this->connection->query($totalCommitsQuery);
        $result = $result->fetchAll(PDO::FETCH_ASSOC)[0]['SUM(commits)'];
        $dataArray['total_commits'] = (isset($result) && is_numeric($result)) ? $result : 0;

        return $dataArray;
    }

    public function getEndomondoGeneralStats() {
        $dataArray = array('total_workouts' => 0, 'total_kilometres' => 0);

        $workoutNumberQuery = "SELECT COUNT(*) FROM endomondo_workouts";
        $result = $this->connection->query($workoutNumberQuery);
        $result = $result->fetchAll(PDO::FETCH_ASSOC)[0]['COUNT(*)'];
        $dataArray['total_workouts'] = (isset($result) && is_numeric($result)) ? $result : 0;

        $totalKilometresQuery = "SELECT SUM(distance) FROM endomondo_workouts";
        $result = $this->connection->query($totalKilometresQuery);
        $result = $result->fetchAll(PDO::FETCH_ASSOC)[0]['SUM(distance)'];
        $dataArray['total_kilometres'] = (isset($result) && is_numeric($result)) ? round($result) : 0;

        return $dataArray;
    }

    public function getGithubRepos() {
        $query = "SELECT * FROM github_repos";
        $result = $this->connection->query($query);
        $result = $result->fetchAll(PDO::FETCH_OBJ);
        return $result;
    }

    public function getEndomondoLastFiveWeekWorkouts() {
        for ($i=0; $i <= 4; $i++) {
            $weekWorkouts[$i] = new stdClass();
            $weekWorkouts[$i]->start_date = $this->getPreviousWeeks($i)['start'];
            $weekWorkouts[$i]->end_date = $this->getPreviousWeeks($i)['end'];
        }

        foreach ($weekWorkouts as $key => $week) {
            $sql = "SELECT distance, duration, calories FROM endomondo_workouts WHERE CAST(start_time AS DATE) BETWEEN '".$week->start_date."' AND '".$week->end_date."'";
            $result = $this->connection->query($sql);
            $result = $result->fetchAll(PDO::FETCH_OBJ);
            $weekWorkouts[$key]->workouts = $result;
        }

        return $weekWorkouts;
    }

    public function getEndomondoLastFiveWeekStats() {
        for ($i=0; $i <= 4; $i++) {
            $weekStats[$i] = new stdClass();
            $weekStats[$i]->start_date = $this->getPreviousWeeks($i)['start'];
            $weekStats[$i]->end_date = $this->getPreviousWeeks($i)['end'];
        }

        foreach ($weekStats as $key => $week) {
            $sql = "SELECT SUM(distance), SUM(duration), SUM(calories), COUNT(*) FROM endomondo_workouts WHERE CAST(start_time AS DATE) BETWEEN '".$week->start_date."' AND '".$week->end_date."'";
            $result = $this->connection->query($sql);
            $result = $result->fetchAll(PDO::FETCH_ASSOC);
            $weekStats[$key]->total_distance = (isset($result[0]['SUM(distance)'])) ? round($result[0]['SUM(distance)']) : 0;
            $weekStats[$key]->total_duration = (isset($result[0]['SUM(duration)'])) ? $result[0]['SUM(duration)'] : 0;
            $weekStats[$key]->total_calories = (isset($result[0]['SUM(calories)'])) ? $result[0]['SUM(calories)'] : 0;
            $weekStats[$key]->total_workouts = (isset($result[0]['COUNT(*)'])) ? $result[0]['COUNT(*)'] : 0;
        }

        return $weekStats;
    }

    public function getPreviousWeeks($weeksAgo = 0) {
        date_default_timezone_set(date_default_timezone_get());
        $dateTime = ($weeksAgo == 0) ? strtotime('now') : strtotime('-'.$weeksAgo.' weeks');
        $week['start'] = date('N', $dateTime)==1 ? date('Y-m-d', $dateTime) : date('Y-m-d', strtotime('last monday', $dateTime));
        $week['end'] = date('N', $dateTime)==7 ? date('Y-m-d', $dateTime) : date('Y-m-d', strtotime('next sunday', $dateTime));
        return $week;
    }
}
