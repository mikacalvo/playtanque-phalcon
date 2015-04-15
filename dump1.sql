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
/*!40000 ALTER TABLE `club` DISABLE KEYS */;
/*!40000 ALTER TABLE `club` ENABLE KEYS */;


-- Export de la structure de table playtanque. concours
CREATE TABLE IF NOT EXISTS `concours` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `label` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `options` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Export de données de la table playtanque.concours: ~2 rows (environ)
/*!40000 ALTER TABLE `concours` DISABLE KEYS */;
INSERT INTO `concours` (`id`, `label`, `date`, `options`) VALUES
	(1, 'Mon premier concours', '2015-02-20', '{"type":"consolante","equipe":"3"}'),
	(2, 'Inter-sociétaire Pâques', '2015-04-16', '{"type":"melee","equipe":"3"}');
/*!40000 ALTER TABLE `concours` ENABLE KEYS */;


-- Export de la structure de table playtanque. equipe
CREATE TABLE IF NOT EXISTS `equipe` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `concours_id` int(11) unsigned NOT NULL,
  `data` text,
  PRIMARY KEY (`id`),
  KEY `consolante_concours_fk` (`concours_id`),
  CONSTRAINT `consolante_concours_fk` FOREIGN KEY (`concours_id`) REFERENCES `concours` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- Export de données de la table playtanque.equipe: ~1 rows (environ)
/*!40000 ALTER TABLE `equipe` DISABLE KEYS */;
INSERT INTO `equipe` (`id`, `concours_id`, `data`) VALUES
	(4, 1, NULL);
/*!40000 ALTER TABLE `equipe` ENABLE KEYS */;


-- Export de la structure de table playtanque. equipes_joueurs
CREATE TABLE IF NOT EXISTS `equipes_joueurs` (
  `equipe_id` int(10) unsigned NOT NULL,
  `joueur_id` int(10) unsigned NOT NULL,
  KEY `joueur_fk` (`joueur_id`),
  KEY `equipe_fk` (`equipe_id`),
  CONSTRAINT `equipe_fk` FOREIGN KEY (`equipe_id`) REFERENCES `equipe` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `joueur_fk` FOREIGN KEY (`joueur_id`) REFERENCES `joueur` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Export de données de la table playtanque.equipes_joueurs: ~3 rows (environ)
/*!40000 ALTER TABLE `equipes_joueurs` DISABLE KEYS */;
INSERT INTO `equipes_joueurs` (`equipe_id`, `joueur_id`) VALUES
	(4, 1),
	(4, 2),
	(4, 3);
/*!40000 ALTER TABLE `equipes_joueurs` ENABLE KEYS */;


-- Export de la structure de table playtanque. joueur
CREATE TABLE IF NOT EXISTS `joueur` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(75) NOT NULL,
  `prenom` varchar(75) NOT NULL,
  `options` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- Export de données de la table playtanque.joueur: ~12 rows (environ)
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


-- Export de la structure de table playtanque. users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(32) NOT NULL,
  `password` char(64) NOT NULL,
  `email` varchar(70) NOT NULL,
  `date_creation` date NOT NULL,
  `is_actif` char(1) NOT NULL,
  `options` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Export de données de la table playtanque.users: ~1 rows (environ)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `username`, `password`, `email`, `date_creation`, `is_actif`, `options`) VALUES
	(4, 'Mikikou', '$2y$10$P2EPxLS7Fu8lkGZrdsFV.ORObbf5.LKILwKfON85wCu8I3FXlf5nC', 'mikacalvo@gmail.com', '2015-02-17', '1', 'null');
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

-- Export de données de la table playtanque.users_concours: ~2 rows (environ)
/*!40000 ALTER TABLE `users_concours` DISABLE KEYS */;
INSERT INTO `users_concours` (`user_id`, `concours_id`) VALUES
	(4, 1),
	(4, 2);
/*!40000 ALTER TABLE `users_concours` ENABLE KEYS */;


-- Export de la structure de table playtanque. users_joueurs
CREATE TABLE IF NOT EXISTS `users_joueurs` (
  `user_id` int(10) unsigned NOT NULL,
  `joueur_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`user_id`,`joueur_id`),
  KEY `concours_fk2` (`joueur_id`),
  CONSTRAINT `users_joueurs_fk` FOREIGN KEY (`joueur_id`) REFERENCES `joueur` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `users_joueurs_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='lie les concours aux utilisateurs';

-- Export de données de la table playtanque.users_joueurs: ~12 rows (environ)
/*!40000 ALTER TABLE `users_joueurs` DISABLE KEYS */;
INSERT INTO `users_joueurs` (`user_id`, `joueur_id`) VALUES
	(4, 1),
	(4, 2),
	(4, 3),
	(4, 4),
	(4, 5),
	(4, 6),
	(4, 7),
	(4, 8),
	(4, 9),
	(4, 10),
	(4, 11),
	(4, 12);
/*!40000 ALTER TABLE `users_joueurs` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
