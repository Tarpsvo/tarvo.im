<?php
require_once('githubApi.php');

class dataUpdateApi {
    private $db, $githubApi;

    public function __construct() {
        $this->githubApi = new githubApi;

        $dbFile = dirname(__FILE__).'/tramvai.db';
        $this->db = new SQLite3($dbFile);
    }

    /**
     * Retrieves Github general stats through the Github API and saves them into local database
     */
    public function updateGithubGeneralStats() {
        $repositoryCount = $this->githubApi->getNumberOfRepos();
        $totalCommits = $this->githubApi->getNumberOfCommits();

        if (isset($repositoryCount) && isset($totalCommits)) {
            if (is_numeric($repositoryCount) && is_numeric($totalCommits)) {
                $query = "INSERT INTO github_general ('repository_count', 'total_commits') VALUES (".$repositoryCount.", ".$totalCommits.")";
                $this->db->exec($query);
            } else {
                // FIXME Value(s) not numeric
            }
        } else {
            // FIXME Value(s) null
        }
    }
}
