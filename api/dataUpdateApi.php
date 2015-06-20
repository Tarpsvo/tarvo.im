<?php
require_once '/mainConfig.php';
require_once '/githubApi.php';

class dataUpdateApi {
    private $connection, $githubApi;

    public function __construct() {
        $this->githubApi = new githubApi;

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
}
