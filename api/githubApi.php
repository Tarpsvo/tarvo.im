<?php
require_once __DIR__.'/mainConfig.php';
require_once __DIR__.'/requestEngine.php';

class githubApi {
    const USER_URL = "https://api.github.com/users/tramvai";
    const REPOS_URL = "https://api.github.com/users/tramvai/repos";

    private $requestEngine;

    public function __construct() {
        $this->requestEngine = new requestEngine;
    }

    public function getListOfRepos() {
        return $this->checkForRateLimitError(json_decode($this->requestEngine->get(githubApi::REPOS_URL)));
    }

    public function getNumberOfCommitsFromRepoUrl($repoUrl) {
        $contributorsDataUrl = $repoUrl."/stats/contributors";
        $result = $this->checkForRateLimitError(json_decode($this->requestEngine->get($contributorsDataUrl)));
        if (isset($result[0])) {
            return $this->checkForRateLimitError(json_decode($this->requestEngine->get($contributorsDataUrl))[0]->total);
        } else {
            return 0;
        }
    }

    private function checkForRateLimitError($result) {
        if (isset($result->message) && strpos($result->message, 'API rate limit exceeded') !== FALSE) {
            die("Github API rate limit exceeded. Stopping script.");
        } else {
            return $result;
        }
    }
}
