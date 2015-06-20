<?php
require_once '/mainConfig.php';
require_once '/requestEngine.php';

class githubApi {
    const USER_URL = "https://api.github.com/users/tramvai";

    private $requestEngine;

    public function __construct() {
        $this->requestEngine = new requestEngine;
    }

    /**
     * Retrieves the number of the user's public repositories from github API
     * @return integer  Number of repositories
     */
    public function getNumberOfRepos() {
        $userData = json_decode($this->requestEngine->get(githubApi::USER_URL));

        if (isset($userData->public_repos) && is_numeric($userData->public_repos)) {
            return $userData->public_repos;
        } else {
            // FIXME Number of repos null/not numeric
        }
    }

    /**
     * Retrieves sum of all commits from all the user's repositories from github API
     * @return integer  Total number of commits
     */
    public function getNumberOfCommits() {
        $numberOfCommits = 0;
        $userData = json_decode($this->requestEngine->get(githubApi::USER_URL));
        $reposData = json_decode($this->requestEngine->get($userData->repos_url));

        foreach ($reposData as $repoId => $repo) {
            $contributorsDataUrl = str_replace("{/sha}", "", $repo->url)."/stats/contributors";

            $commitsData = json_decode($this->requestEngine->get($contributorsDataUrl));

            if (isset($commitsData[0])) $numberOfCommits += $commitsData[0]->total;
        }

        return $numberOfCommits;
    }
}
