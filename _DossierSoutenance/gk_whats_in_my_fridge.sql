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


DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
                            `id` int(11) NOT NULL AUTO_INCREMENT,
                            `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                            PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


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


DROP TABLE IF EXISTS `doctrine_migration_versions`;
CREATE TABLE `doctrine_migration_versions` (
                                               `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
                                               `executed_at` datetime DEFAULT NULL,
                                               `execution_time` int(11) DEFAULT NULL,
                                               PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `ingredient`;
CREATE TABLE `ingredient` (
                              `id` int(11) NOT NULL AUTO_INCREMENT,
                              `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                              `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                              `saison` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                              PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


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


-- 2022-04-06 19:03:30