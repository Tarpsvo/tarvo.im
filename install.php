<?php
require_once 'api/mainConfig.php';
require_once 'api/dataUpdateApi.php';

$sqlFile = 'DATABASE.sql';

$dataUpdateApi = new dataUpdateApi;
$connection = mainConfig::connectToDatabase();
$sql = file_get_contents($sqlFile);

if ($connection->query($sql)) {
    $dataUpdateApi->updateGithubGeneralStats();
    echo "Success!";
} else {
    die("Failed executing SQL query.");
}
