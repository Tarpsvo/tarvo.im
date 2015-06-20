<?php
require_once __DIR__.'/mainConfig.php';

class requestEngine {
    public function get($url, $queryData = null) {
        if (isset($queryData)) $url .= '?'.http_build_query($queryData);

        $ch = curl_init();
        curl_setopt_array($ch, array(
            CURLOPT_URL => $url,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_USERAGENT => "Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36",
        ));

        if (strpos($url, 'github') > 0 && defined(mainConfig::GITHUB_AUTH_DATA)) curl_setopt($ch, CURLOPT_USERPWD, mainConfig::GITHUB_AUTH_DATA);

        $response = curl_exec($ch);

        if (!$response && curl_error($ch)) {
            echo "Something went wrong. CURL Error: ".curl_error($ch);
            curl_close($ch);
            return false;
        } else {
            curl_close($ch);

            if (isset($queryData['compression'])) {
                switch ($queryData['compression']) {
                    case 'gzip':
                        return gzinflate(substr($response, 10));
                    break;
                    case 'deflate':
                        return gzinflate(substr($response, 2));
                    break;
                }
            } else {
                return $response;
            }
        }
    }
}
