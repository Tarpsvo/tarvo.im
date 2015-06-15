<?php
class githubApi {
    private $userInfoUrl = "https://api.github.com/users/tramvai";
    private $githubAuthenticationData = "";

    /**
     * Retrieves the number of the user's public repositories from github API
     * @return integer  Number of repositories
     */
    public function getNumberOfRepos() {
        $userData = $this->getJsonDataFromUrl($this->userInfoUrl);

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
        $userData = $this->getJsonDataFromUrl($this->userInfoUrl);
        $reposData = $this->getJsonDataFromUrl($userData->repos_url);

        foreach ($reposData as $repoId => $repo) {
            $contributorsDataUrl = str_replace("{/sha}", "", $repo->url)."/stats/contributors";

            $commitsData = $this->getJsonDataFromUrl($contributorsDataUrl);
            if (isset($commitsData)) $numberOfCommits += $commitsData[0]->total;
        }

        return $numberOfCommits;
    }

    /**
     * Retrieves JSON data from specified URL and decodes it
     * @param  string $url  REST endpoint URL
     * @return array        Decoded JSON data
     */
    private function getJsonDataFromUrl($url) {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_HEADER => 0,
            CURLOPT_USERAGENT => "Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36",
        ));

        if (!empty($this->githubAuthenticationData)) curl_setopt($curl, CURLOPT_USERPWD, $this->githubAuthenticationData);

        return json_decode(curl_exec($curl));
    }
}
