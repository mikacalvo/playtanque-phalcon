-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           5.6.17 - MySQL Community Server (GPL)
-- Serveur OS:                   Win64
-- HeidiSQL Version:             9.1.0.4867
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Export de la structure de la base pour playtanque
CREATE DATABASE IF NOT EXISTS `playtanque` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `playtanque`;


-- Export de la structure de table playtanque. club
CREATE TABLE IF NOT EXISTS `club` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `options` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nom` (`nom`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Export de données de la table playtanque.club: ~0 rows (environ)
DELETE FROM `club`;
/*!40000 ALTER TABLE `club` DISABLE KEYS */;
/*!40000 ALTER TABLE `club` ENABLE KEYS */;


-- Export de la structure de table playtanque. concours
CREATE TABLE IF NOT EXISTS `concours` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `label` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `options` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Export de données de la table playtanque.concours: ~1 rows (environ)
DELETE FROM `concours`;
/*!40000 ALTER TABLE `concours` DISABLE KEYS */;
INSERT INTO `concours` (`id`, `label`, `date`, `options`) VALUES
	(1, 'Mon premier concours', '2015-02-20', NULL);
/*!40000 ALTER TABLE `concours` ENABLE KEYS */;


-- Export de la structure de table playtanque. concours_joueurs
CREATE TABLE IF NOT EXISTS `concours_joueurs` (
  `concours_id` int(11) unsigned DEFAULT NULL,
  `joueur_id` int(11) unsigned DEFAULT NULL,
  KEY `concours_fk` (`concours_id`),
  KEY `joueur_fk` (`joueur_id`),
  CONSTRAINT `concours_fk` FOREIGN KEY (`concours_id`) REFERENCES `concours` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `joueur_fk` FOREIGN KEY (`joueur_id`) REFERENCES `joueur` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Export de données de la table playtanque.concours_joueurs: ~0 rows (environ)
DELETE FROM `concours_joueurs`;
/*!40000 ALTER TABLE `concours_joueurs` DISABLE KEYS */;
/*!40000 ALTER TABLE `concours_joueurs` ENABLE KEYS */;


-- Export de la structure de table playtanque. joueur
CREATE TABLE IF NOT EXISTS `joueur` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(75) NOT NULL,
  `prenom` VARCHAR(75) NOT NULL,
  `options` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Export de données de la table playtanque.joueur: ~0 rows (environ)
DELETE FROM `joueur`;
/*!40000 ALTER TABLE `joueur` DISABLE KEYS */;
/*!40000 ALTER TABLE `joueur` ENABLE KEYS */;


-- Export de la structure de table playtanque. users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(32) NOT NULL,
  `password` char(64) NOT NULL,
  `email` varchar(70) NOT NULL,
  `date_creation` date NOT NULL,
  `is_actif` char(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Export de données de la table playtanque.users: ~1 rows (environ)
DELETE FROM `users`;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `username`, `password`, `email`, `date_creation`, `is_actif`) VALUES
	(4, 'Mikikou', '$2y$10$tz/qt0.IpCtCH1Hh9Zjjc.OOb3rdFw8E0Oy.ei0U2z3Fi/7aF/P4q', 'mikacalvo@gmail.com', '2015-02-17', '1');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;


-- Export de la structure de table playtanque. users_concours
CREATE TABLE IF NOT EXISTS `users_concours` (
  `user_id` int(10) unsigned NOT NULL,
  `concours_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`user_id`,`concours_id`),
  KEY `concours_fk2` (`concours_id`),
  CONSTRAINT `concours_fk2` FOREIGN KEY (`concours_id`) REFERENCES `concours` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `user_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='lie les concours aux utilisateurs';

-- Export de données de la table playtanque.users_concours: ~1 rows (environ)
DELETE FROM `users_concours`;
/*!40000 ALTER TABLE `users_concours` DISABLE KEYS */;
INSERT INTO `users_concours` (`user_id`, `concours_id`) VALUES
	(4, 1);
/*!40000 ALTER TABLE `users_concours` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;

CREATE TABLE `users_joueurs` (
  `user_id` int(10) unsigned NOT NULL,
  `joueur_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`user_id`,`joueur_id`),
  KEY `concours_fk2` (`joueur_id`),
  CONSTRAINT `users_joueurs_fk` FOREIGN KEY (`joueur_id`) REFERENCES `joueur` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `users_joueurs_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='lie les concours aux utilisateurs';



-- Export de données de la table playtanque.joueur: ~0 rows (environ)
/*!40000 ALTER TABLE `joueur` DISABLE KEYS */;
INSERT INTO `joueur` (`id`, `nom`, `prenom`, `options`) VALUES
	(1, 'Calvo', 'Michaël', '{"poste":"1"}'),
	(2, 'Calvo', 'Lola', '{"poste":"1"}'),
	(3, 'Ivaldi', 'Jean-Paul', '{"poste":"2"}'),
	(4, 'Ivaldi', 'Anthony', '{"poste":"1"}'),
	(5, 'Ivaldi', 'Patricia', '{"poste":"1"}'),
	(6, 'Capoccetti', 'Michel', '{"poste":"3"}'),
	(7, 'Caldari', 'Serge', '{"poste":"3"}'),
	(8, 'Guily', 'Patrick', '{"poste":"3"}'),
	(9, 'Sbicca', 'Serge', '{"poste":"2"}'),
	(10, 'Plisson', 'Rémi', '{"poste":"1"}'),
	(11, 'Grelier', 'Jean-Marc', '{"poste":"2"}'),
	(12, 'Leboine', 'Stéphane', '{"poste":"3"}');
/*!40000 ALTER TABLE `joueur` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
