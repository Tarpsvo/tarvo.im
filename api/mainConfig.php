<?php
class mainConfig {
    const MYSQL_HOST = '';
    const MYSQL_DATABASE = '';
    const MYSQL_USERNAME = '';
    const MYSQL_PASSWORD = '';

    const ENDOMONDO_AUTH_DATA = '';
    const GITHUB_AUTH_DATA = '';

    public static function connectToDatabase() {
        try {
            $connection = new PDO("mysql: host=".mainConfig::MYSQL_HOST."; dbname=".mainConfig::MYSQL_DATABASE."; charset=utf8", mainConfig::MYSQL_USERNAME, mainConfig::MYSQL_PASSWORD);
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $connection;
        } catch (PDOException $e) {
            returnError($e->getMessage());
        }
    }
}
