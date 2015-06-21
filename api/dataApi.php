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
}
