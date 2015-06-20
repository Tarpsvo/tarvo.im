CREATE TABLE IF NOT EXISTS `github_general` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `repository_count` int(11) NOT NULL,
    `total_commits` int(11) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
