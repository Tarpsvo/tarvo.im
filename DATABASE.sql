CREATE TABLE IF NOT EXISTS `github_general` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `repository_count` int(11) NOT NULL,
    `total_commits` int(11) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `endomondo_workouts` (
    `workout_id` int(11) NOT NULL,
    `sport` int(11) NOT NULL,
    `distance` decimal(15,12) NOT NULL,
    `duration` int(11) NOT NULL,
    `speed_avg` decimal(15,12) DEFAULT NULL,
    `calories` int(11) DEFAULT NULL,
    `start_time` datetime NOT NULL,
    `altitude_min` decimal(8,4) DEFAULT NULL,
    `altitude_max` decimal(8,4) DEFAULT NULL,
    `descent` decimal(8,4) DEFAULT NULL,
    `ascent` decimal(8,4) DEFAULT NULL,
    `privacy_workout` int(11) DEFAULT NULL,
    `hydration` decimal(8,6) DEFAULT NULL,
    `peptalks` int(11) DEFAULT NULL,
    `likes` int(11) DEFAULT NULL,
    `comments` int(11) DEFAULT NULL,
    `burgers_burned` decimal(10,8) DEFAULT NULL,
    `device_workout_id` int(11) DEFAULT NULL,
    `owner_id` int(11) DEFAULT NULL,
    `privacy_map` int(11) DEFAULT NULL,
    `speed_max` decimal(6,4) DEFAULT NULL,
    PRIMARY KEY (`workout_id`),
    UNIQUE KEY `workout_id` (`workout_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
