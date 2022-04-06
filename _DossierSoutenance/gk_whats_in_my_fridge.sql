-- Adminer 4.8.1 MySQL 8.0.15 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP DATABASE IF EXISTS `gk_whats_in_my_fridge`;
CREATE DATABASE `gk_whats_in_my_fridge` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `gk_whats_in_my_fridge`;

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `avis`;
CREATE TABLE `avis` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `recette_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_8F91ABF0A76ED395` (`user_id`),
  KEY `IDX_8F91ABF089312FE9` (`recette_id`),
  CONSTRAINT `FK_8F91ABF089312FE9` FOREIGN KEY (`recette_id`) REFERENCES `recette` (`id`),
  CONSTRAINT `FK_8F91ABF0A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `avis` (`id`, `content`, `user_id`, `recette_id`) VALUES
(1,	'<div>un bon crumble</div>',	1,	1)
ON DUPLICATE KEY UPDATE `id` = VALUES(`id`), `content` = VALUES(`content`), `user_id` = VALUES(`user_id`), `recette_id` = VALUES(`recette_id`);

DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `category` (`id`, `name`) VALUES
(1,	'Entrée'),
(2,	'Plat'),
(3,	'Dessert')
ON DUPLICATE KEY UPDATE `id` = VALUES(`id`), `name` = VALUES(`name`);

DROP TABLE IF EXISTS `composition`;
CREATE TABLE `composition` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ingredient_id` int(11) NOT NULL,
  `recette_id` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `poids` double NOT NULL,
  `quantite` double NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_C7F4347933FE08C` (`ingredient_id`),
  KEY `IDX_C7F434789312FE9` (`recette_id`),
  CONSTRAINT `FK_C7F434789312FE9` FOREIGN KEY (`recette_id`) REFERENCES `recette` (`id`),
  CONSTRAINT `FK_C7F4347933FE08C` FOREIGN KEY (`ingredient_id`) REFERENCES `ingredient` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `composition` (`id`, `ingredient_id`, `recette_id`, `price`, `poids`, `quantite`) VALUES
(1,	1,	1,	10.25,	150,	2)
ON DUPLICATE KEY UPDATE `id` = VALUES(`id`), `ingredient_id` = VALUES(`ingredient_id`), `recette_id` = VALUES(`recette_id`), `price` = VALUES(`price`), `poids` = VALUES(`poids`), `quantite` = VALUES(`quantite`);

DROP TABLE IF EXISTS `doctrine_migration_versions`;
CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20220406100420',	'2022-04-06 10:04:34',	442),
('DoctrineMigrations\\Version20220406101303',	'2022-04-06 10:13:18',	187),
('DoctrineMigrations\\Version20220406101632',	'2022-04-06 10:17:09',	351),
('DoctrineMigrations\\Version20220406102511',	'2022-04-06 10:25:30',	659),
('DoctrineMigrations\\Version20220406124549',	'2022-04-06 12:46:01',	681),
('DoctrineMigrations\\Version20220406125201',	'2022-04-06 12:52:07',	405),
('DoctrineMigrations\\Version20220406125707',	'2022-04-06 12:57:25',	347),
('DoctrineMigrations\\Version20220406130505',	'2022-04-06 13:05:18',	579),
('DoctrineMigrations\\Version20220406145409',	'2022-04-06 14:54:21',	530)
ON DUPLICATE KEY UPDATE `version` = VALUES(`version`), `executed_at` = VALUES(`executed_at`), `execution_time` = VALUES(`execution_time`);

DROP TABLE IF EXISTS `ingredient`;
CREATE TABLE `ingredient` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `saison` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `ingredient` (`id`, `name`, `photo`, `saison`) VALUES
(1,	'Pomme',	'Pomme-Golden_Icone-1-150x110.jpg',	NULL)
ON DUPLICATE KEY UPDATE `id` = VALUES(`id`), `name` = VALUES(`name`), `photo` = VALUES(`photo`), `saison` = VALUES(`saison`);

DROP TABLE IF EXISTS `messenger_messages`;
CREATE TABLE `messenger_messages` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `headers` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue_name` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `available_at` datetime NOT NULL,
  `delivered_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  KEY `IDX_75EA56E016BA31DB` (`delivered_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `recette`;
CREATE TABLE `recette` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `level` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prepare` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `time_prepare` int(11) NOT NULL,
  `cook_time` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_49BB6390A76ED395` (`user_id`),
  KEY `IDX_49BB639012469DE2` (`category_id`),
  CONSTRAINT `FK_49BB639012469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`),
  CONSTRAINT `FK_49BB6390A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `recette` (`id`, `level`, `title`, `prepare`, `photo`, `slug`, `time_prepare`, `cook_time`, `user_id`, `category_id`) VALUES
(1,	'facile',	'Crumble aux Pommes',	'<div>dfggegreqgeqg</div>',	'crumble-aux-pommes.jpg',	'crumble-aux-pommes',	12,	45,	1,	3)
ON DUPLICATE KEY UPDATE `id` = VALUES(`id`), `level` = VALUES(`level`), `title` = VALUES(`title`), `prepare` = VALUES(`prepare`), `photo` = VALUES(`photo`), `slug` = VALUES(`slug`), `time_prepare` = VALUES(`time_prepare`), `cook_time` = VALUES(`cook_time`), `user_id` = VALUES(`user_id`), `category_id` = VALUES(`category_id`);

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pseudo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `postal_code` int(11) NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `user_recette`;
CREATE TABLE `user_recette` (
  `user_id` int(11) NOT NULL,
  `recette_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`,`recette_id`),
  KEY `IDX_11B67D9AA76ED395` (`user_id`),
  KEY `IDX_11B67D9A89312FE9` (`recette_id`),
  CONSTRAINT `FK_11B67D9A89312FE9` FOREIGN KEY (`recette_id`) REFERENCES `recette` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_11B67D9AA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- 2022-04-06 16:09:11
