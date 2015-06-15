<?php
require_once('api/dataUpdateApi.php');

$databaseFile = 'api/tramvai.db';
$sqlFile = 'DATABASE.sql';

$dataUpdateApi = new dataUpdateApi;
$db = new SQLite3($databaseFile);
$sql = file_get_contents($sqlFile);

if ($db->exec($sql)) {
    $dataUpdateApi->updateGithubGeneralStats();
    echo "Success!";
} else {
    die("Failed executing SQL query.");
}
