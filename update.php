<?php
require_once __DIR__.'/api/mainConfig.php';
require_once __DIR__.'/api/dataUpdateApi.php';
date_default_timezone_set('Europe/Tallinn');

$dataUpdateApi = new dataUpdateApi;
$connection = mainConfig::connectToDatabase();

$lastUpdatesSql = "SELECT name, updated FROM last_updates";
$result = $connection->query($lastUpdatesSql)->fetchAll(PDO::FETCH_OBJ);


foreach ($result as $key => $data) {
    $now = strtotime('now');
    $minimumAllowedTime = strtotime($data->updated.' + 2 hours');
    $setUpdateTimeSql = "UPDATE last_updates SET total_updates = total_updates + 1 WHERE name = '".$data->name."'";

    echo strtoupper($data->name)." process:<br>";
    if ($now > $minimumAllowedTime) {
        echo " - trying to update stats.<br>";

        if ($data->name == 'endomondo') {
            if ($dataUpdateApi->updateEndomondoWorkouts()) {
                $connection->query($setUpdateTimeSql);
                echo " - stats updated successfully.<br>";
            } else {
                echo " - failed to update stats.<br>";
            }
        } else {
            if ($dataUpdateApi->updateGithubStats()) {
                $connection->query($setUpdateTimeSql);
                echo " - stats updated successfully.<br>";
            } else {
                echo " - failed to update stats.<br>";
            }
        }
    } else {
        echo " - stats not updated, not enough time has passed.<br>";
    }
}
