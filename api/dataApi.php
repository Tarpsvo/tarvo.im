<?php
require_once '/mainConfig.php';

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
        $dataArray = array('repository_count' => 0, 'total_commits' => 0);

        $query = "SELECT repository_count, total_commits FROM github_general ORDER BY 'created' DESC LIMIT 1";

        $result = $this->connection->query($query);
        $result = $result->fetchAll(PDO::FETCH_ASSOC)[0];

        if (!empty($result)) {
            $dataArray['repository_count'] = (isset($result['repository_count'])) ? $result['repository_count'] : 0;
            $dataArray['total_commits'] = (isset($result['total_commits'])) ? $result['total_commits'] : 0;
        }

        return $dataArray;
    }
}
