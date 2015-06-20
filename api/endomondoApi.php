<?php
require_once '/mainConfig.php';
require_once '/requestEngine.php';
require_once '../utils/Uuid.php';

class endomondoApi {
    const URL_AUTH = 'https://api.mobile.endomondo.com/mobile/auth';
    const URL_WORKOUTS = 'https://api.mobile.endomondo.com/mobile/api/workouts';

    private $authToken, $requestEngine;

    public function __construct() {
        $this->requestEngine = new requestEngine;
        $this->authToken = $this->requestAuthToken();
    }

    private function requestAuthToken() {
        $deviceInfo = array(
            'v' => "2.4",
            'action' => 'PAIR',
            'email' => explode(':', mainConfig::ENDOMONDO_AUTH_DATA)[0],
            'password' => explode(':', mainConfig::ENDOMONDO_AUTH_DATA)[1],
            'country' => 'GB',
            'deviceId' => Uuid::v5(Uuid::NAMESPACE_DNS, gethostname()),
            'os' => 'Android',
            'appVersion' => '7.1',
            'appVariant' => 'M-Pro',
            'osVersion' => '5.1.1',
            'model' => 'SM G800F'
        );

        $response = $this->requestEngine->get(endomondoApi::URL_AUTH, $deviceInfo);


        if ($response) {
            $lines = explode("\n", $response);

            if ($lines[0] == "OK") {
                foreach ($lines as $line) {
                    if(substr($line, 0, 9) == "authToken") return substr($line, 10);
                }
            } else {
                echo "Failed to obtain authToken from endomondo";
                return false;
            }
        }
    }

    public function getAllWorkouts() { //Fetches a list of workouts, either your own or specified user's
		$params = array(
			'authToken' =>	$this->authToken,
			'fields' =>	'device,simple,basic,lcp_count',
			'maxResults' =>	2000,
			'gzip' =>	'true',
			'compression' =>'gzip'
		);

		return json_decode($this->requestEngine->get(endomondoApi::URL_WORKOUTS, $params))->data;
	}
}
