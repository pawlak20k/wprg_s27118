SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE `projects` (
`id` int(11) NOT NULL,
`name` varchar(255) NOT NULL,
`description` text DEFAULT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `todolist` (
`id` int(11) NOT NULL,
`user_id` int(11) NOT NULL,
`tasks` varchar(255) DEFAULT NULL,
`priority` enum('niski','średni','wysoki') NOT NULL DEFAULT 'średni',
`completed` tinyint(1) NOT NULL DEFAULT 0,
`created_at` timestamp NOT NULL DEFAULT current_timestamp(),
`updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
`due_date` date DEFAULT NULL,
`notes` text DEFAULT NULL,
`project_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `user` (
`id` int(11) NOT NULL,
`name` varchar(128) NOT NULL,
`email` varchar(255) NOT NULL,
`password_hash` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



INSERT INTO `user` (`id`, `name`, `email`, `password_hash`) VALUES
(1, 'test1', 'test1@test.pl', '$2y$10$IODMMwU6XWamqS3jXA6N4.tZp3ZP1njYOuv3jDf0rAz/qP1uBgkYe'),
(2, 'test2', 'test2@test.pl', '$2y$10$IODMMwU6XWamqS3jXA6N4.tZp3ZP1njYOuv3jDf0rAz/qP1uBgkYe'),
(3, 'test3', 'test3@test.pl', '$2y$10$IODMMwU6XWamqS3jXA6N4.tZp3ZP1njYOuv3jDf0rAz/qP1uBgkYe'),
(4, 'test4', 'test4@test.pl', '$2y$10$IODMMwU6XWamqS3jXA6N4.tZp3ZP1njYOuv3jDf0rAz/qP1uBgkYe'),
(5, 'test5', 'test5@test.pl', '$2y$10$IODMMwU6XWamqS3jXA6N4.tZp3ZP1njYOuv3jDf0rAz/qP1uBgkYe'),
(6, 'test6', 'test6@test.pl', '$2y$10$IODMMwU6XWamqS3jXA6N4.tZp3ZP1njYOuv3jDf0rAz/qP1uBgkYe');


ALTER TABLE `projects`
ADD PRIMARY KEY (`id`);

ALTER TABLE `todolist` ADD COLUMN `attachment` VARCHAR(255);

ALTER TABLE `todolist`
ADD PRIMARY KEY (`id`),
ADD KEY `user_id` (`user_id`),
ADD KEY `project_id` (`project_id`);

ALTER TABLE `user`
ADD PRIMARY KEY (`id`),
ADD UNIQUE KEY `email` (`email`);

ALTER TABLE `projects`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

ALTER TABLE `todolist`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;

ALTER TABLE `user`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

ALTER TABLE `todolist`
ADD CONSTRAINT `todolist_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
ADD CONSTRAINT `todolist_ibfk_2` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE;
COMMIT;
