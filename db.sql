DROP DATABASE IF EXISTS assignment_two;
CREATE DATABASE IF NOT EXISTS assignment_two;

USE assignment_two;
SELECT DATABASE();

-- Path: db.sql
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- Path: db.sql
DROP TABLE IF EXISTS `posts`;
CREATE TABLE `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- Path: db.sql
DROP TABLE IF EXISTS `comments`;
CREATE TABLE `comments` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
    `postId` int(11) NOT NULL ,
    `userId` int(11) NOT NULL ,
    `body` TEXT NOT NULL ,
    `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ,
    `updated_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ,
    PRIMARY KEY (`id`),
    INDEX `postId` (`postId` ASC),
    INDEX `userId` (`userId` ASC),
    CONSTRAINT `comments_ibfk_1`
        FOREIGN KEY (`postId`)
        REFERENCES `posts` (`id`)
        ON DELETE CASCADE
        ON UPDATE CASCADE,
    CONSTRAINT `comments_ibfk_2`
        FOREIGN KEY (`userId`)
        REFERENCES `users` (`id`)
        ON DELETE CASCADE
        ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

--insert statements
INSERT INTO `users` (`username`, `password`, `email`, `created_at`, `updated_at`) VALUES 
('admin', 'admin', 'admin@example.com', NOW(), NOW()),
('user1', 'password1', 'user1@example.com', NOW(), NOW()),
('user2', 'password2', 'user2@example.com', NOW(), NOW()),
('user3', 'password3', 'user3@example.com', NOW(), NOW());

INSERT INTO `posts` (`user_id`, `title`, `body`, `created_at`, `updated_at`) VALUES 
(2, 'First Post', 'This is the first post by user1', NOW(), NOW()),
(3, 'Second Post', 'This is the second post by user2', NOW(), NOW()),
(2, 'Third Post', 'This is the third post by user1', NOW(), NOW()),
(4, 'Fourth Post', 'This is the fourth post by user3', NOW(), NOW());

INSERT INTO `comments` (`postId`, `userId`, `body`, `created_at`, `updated_at`) VALUES 
(1, 3, 'This is a comment on the first post', NOW(), NOW()),
(2, 2, 'This is a comment on the second post', NOW(), NOW()),
(3, 4, 'This is a comment on the third post', NOW(), NOW()),
(4, 1, 'This is a comment on the fourth post', NOW(), NOW());
