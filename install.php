<?php
require_once __DIR__.'/api/mainConfig.php';
require_once __DIR__.'/api/dataUpdateApi.php';

$sqlFile = 'DATABASE.sql';

$dataUpdateApi = new dataUpdateApi;
$connection = mainConfig::connectToDatabase();
$sql = file_get_contents($sqlFile);

if ($connection->query($sql)) {
    echo "Successfully imported SQL file.<br>";
    $dataUpdateApi->updateGithubGeneralStats();
    $dataUpdateApi->updateEndomondoWorkouts();
    echo "Successfully updated stats.<br>";
} else {
    die("Failed executing SQL import query.");
}
