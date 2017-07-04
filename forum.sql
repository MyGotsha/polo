-- MySQL dump 10.13  Distrib 5.7.18, for Linux (x86_64)
--
-- Host: 127.0.0.1    Database: forum
-- ------------------------------------------------------
-- Server version	5.5.49

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Current Database: `forum`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `forum` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `forum`;

--
-- Table structure for table `forums`
--

DROP TABLE IF EXISTS `forums`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forums` (
  `id_forum` int(11) NOT NULL AUTO_INCREMENT,
  `titre` mediumtext NOT NULL,
  `description` mediumtext NOT NULL,
  PRIMARY KEY (`id_forum`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forums`
--

LOCK TABLES `forums` WRITE;
/*!40000 ALTER TABLE `forums` DISABLE KEYS */;
INSERT INTO `forums` VALUES (1,'Premier forum','Ceci est un 1° forum de test servant uniquement à initialiser l\'affichage sur la page d\'accueil. En gros, il s\'agit de faire du blabla pour remplir de l\'espace...'),(2,'Deuxième Forum','Forum n°2 de test');
/*!40000 ALTER TABLE `forums` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `posts` (
  `id_post` int(11) NOT NULL AUTO_INCREMENT,
  `id_topic` int(11) NOT NULL DEFAULT '0',
  `login` varchar(15) NOT NULL DEFAULT '',
  `text` mediumtext NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_post`)
) ENGINE=InnoDB AUTO_INCREMENT=95 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts`
--

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT INTO `posts` VALUES (6,2,'anthony','Il faut posté du texte sinon la saisie ne sera pas enregistrée.<br />\r\nEt oui :)','2004-04-23 10:27:09'),(19,2,'anthony','Il faut poster...alors postons...','2008-01-28 15:50:28'),(27,0,'anthony','de la part de thierry!!!','2008-01-28 16:44:11'),(28,7,'anthony','de la part de thierry!!!','2008-01-28 16:44:44'),(31,0,'anthony','faut des l\' partout pour voir....','2008-01-28 16:47:02'),(32,7,'anthony','big bisous','2008-01-29 10:23:53'),(34,7,'anthony','test','2008-01-29 10:29:48'),(39,2,'anthony','test smiley : :icon_smile:','2008-01-29 11:18:59'),(43,11,'anthony','Voyons ça...\r\n:boulet:','2008-01-29 12:18:25'),(45,13,'anthony',':faim::faim::faim::faim::faim::faim::faim::faim::faim::faim::faim::faim::faim::faim::faim::faim::faim::faim:','2008-01-29 12:30:58'),(48,13,'don','miam,\r\nmiam,\r\n:brushteeth:','2008-01-29 13:58:10'),(49,14,'anthony','A quoi sert le titre ?\r\n<b>test bold</b>','2008-01-29 14:03:37'),(51,11,'anthony',':mains:','2008-01-29 14:25:09'),(54,16,'user1','test','2008-01-30 10:09:51'),(56,2,'user1','blabla 2','2008-01-30 11:07:41'),(57,7,'user1','coucou :pain:','2008-01-30 11:11:44'),(58,7,'anthony','c\'est super design!!!\r\n','2008-01-30 11:47:20'),(59,7,'anthony','c\'est super design!!!\r\n','2008-01-30 11:47:34'),(63,18,'anthony','autre test sur le 2ème topic','2008-01-30 14:36:14'),(66,11,'user1',':ufo:','2008-01-30 15:35:59'),(71,25,'anthony','Avec son contenu','2008-01-31 10:13:43'),(72,25,'anthony','test','2008-01-31 11:23:43'),(73,26,'user1','et oui!!!\r\n:yeux:','2008-01-31 15:02:51'),(76,11,'user1','réponse de moi\r\n\r\n\r\n\r\n\r\n\r\n\r\n:siffle:','2008-01-31 15:50:48'),(78,11,'anthony','blabla','2008-01-31 16:12:38'),(79,27,'anthony','test','2008-02-01 10:21:13'),(80,27,'anthony',':box:','2008-02-01 10:27:14'),(81,27,'toto2','toto2 est là!!!!!','2008-02-01 10:56:12'),(82,14,'user1','En général on en voit sur les sites\r\n:dj:','2008-02-01 11:11:38'),(83,14,'toto2','En général en effet...','2008-02-01 11:25:04'),(84,7,'mayeur','Il faut que je mette ma contribution\r\n\r\n:panneau:','2008-02-01 11:33:24'),(85,16,'mayeur','Ce topic n\'est pas très franquenté\r\n                   :boulet:','2008-02-01 11:34:31'),(86,26,'mayeur','NON il est 11h34\r\n','2008-02-01 11:34:56'),(87,2,'mayeur','              \r\n\r\n\r\n                 il est trop fort\r\n                      :ange:','2008-02-01 11:39:25'),(88,26,'toto2','Non, il est 12h05!!!\r\n:bleble:\r\nEdit : Non il est 12h14','2008-02-01 12:05:57'),(89,16,'toto2','franquenté?!!!\r\nC\'est du bérichon?\r\n:pain:','2008-02-01 12:08:40'),(91,13,'toto2','Il est bientôt l\'heure d\'aller manger...\r\n:pain:','2008-02-01 12:22:18'),(92,28,'anthony','C\'est l\'heure.On a faim!','2008-02-01 12:25:04'),(94,30,'anthony','Suspendisse enim turpis, dictum sed, iaculis a, condimentum nec, nisi. Pellentesque dapibus hendrerit tortor. Proin pretium, leo ac pellentesque mollis, felis nunc ultrices eros, sed gravida augue augue mollis justo. Phasellus leo dolor, tempus non, auctor et, hendrerit quis, nisi. Curabitur suscipit suscipit tellus.<br />\r\n<br />\r\nNunc egestas, augue at pellentesque laoreet, felis eros vehicula leo, at malesuada velit leo quis pede. Vestibulum rutrum, mi nec elementum vehicula, eros quam gravida nisl, id fringilla neque ante vel mi. Proin magna. Cras non dolor. Lorem ipsum dolor sit amet, consectetuer adipiscing elit.<br />\r\n<br />\r\nCurabitur ullamcorper ultricies nisi. Vivamus in erat ut urna cursus vestibulum. Morbi vestibulum volutpat enim. Vivamus in erat ut urna cursus vestibulum. Praesent turpis.<br />\r\n<br />\r\nAenean vulputate eleifend tellus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nulla facilisi. Sed lectus. Integer tincidunt.<br />\r\n<br />\r\nCras varius. Nulla neque dolor, sagittis eget, iaculis quis, molestie non, velit. Maecenas ullamcorper, dui et placerat feugiat, eros pede varius nisi, condimentum viverra felis nunc et lorem. Vestibulum volutpat pretium libero. Maecenas ullamcorper, dui et placerat feugiat, eros pede varius nisi, condimentum viverra felis nunc et lorem.','2017-05-28 09:15:28');
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `topics`
--

DROP TABLE IF EXISTS `topics`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `topics` (
  `id_topic` int(11) NOT NULL AUTO_INCREMENT,
  `id_forum` int(11) NOT NULL DEFAULT '0',
  `titre` mediumtext NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `login` varchar(15) NOT NULL DEFAULT '',
  `nbvu` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_topic`),
  KEY `FK_topics_1` (`id_forum`),
  CONSTRAINT `FK_topics_1` FOREIGN KEY (`id_forum`) REFERENCES `forums` (`id_forum`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `topics`
--

LOCK TABLES `topics` WRITE;
/*!40000 ALTER TABLE `topics` DISABLE KEYS */;
INSERT INTO `topics` VALUES (2,1,'2° topic créé par formulaire','2008-01-31 09:09:32','anthony',35),(7,1,'tirelipinpon sur le chiwawaaaaaaaaaaaa','2008-01-31 09:01:34','anthony',48),(11,1,'Topic avec smileys.......','2008-01-31 09:01:29','anthony',32),(13,1,'Il est l\'heure d\'aller manger :faim:','2008-01-31 10:42:35','anthony',31),(14,1,'A quoi sert le titre','2008-01-31 09:01:40','anthony',18),(16,2,'Topic de test','2008-01-31 09:02:48','user1',26),(18,2,'autre test','2008-01-31 09:57:40','anthony',15),(25,1,'Un nouveau topic','2008-01-31 10:14:03','anthony',31),(26,2,'Il est 15h00','2008-01-31 15:02:51','user1',27),(27,1,'Premier topic sur SRVFORMA','2008-02-01 10:21:13','anthony',17),(28,2,'Il est 12h30 :banana:','2008-02-01 12:25:03','anthony',2),(30,2,'Test avec accent : c\'est l\'été','2017-05-28 09:15:28','anthony',1);
/*!40000 ALTER TABLE `topics` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `login` varchar(15) NOT NULL DEFAULT '',
  `mdp` varchar(10) NOT NULL DEFAULT '',
  `nom` text NOT NULL,
  `prenom` text NOT NULL,
  `email` text NOT NULL,
  `admin` varchar(1) NOT NULL DEFAULT 'N',
  `code` varchar(10) DEFAULT NULL,
  `actif` varchar(1) NOT NULL DEFAULT 'N',
  `dateinscription` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `dateaction` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ip` varchar(15) DEFAULT NULL,
  UNIQUE KEY `login` (`login`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES ('anthony','mdp','MASSET','Anthony','anthonymasset@fr.st','O',NULL,'O','2017-05-28 09:16:17','2017-05-28 09:16:17','172.17.0.1'),('bill','windows','GATES','Bill','bill@microsoft.com','N',NULL,'O','2008-02-01 10:49:03','0000-00-00 00:00:00',NULL),('DELAHAYE','123456','DELAHAYE','Alain','al@dd.clm','N','0535847603','O','2008-02-01 10:49:03','0000-00-00 00:00:00',NULL),('don','moulins','QUICHOTTE','Don','dq@castilla.es','N',NULL,'O','2008-01-31 17:01:32','2008-01-31 17:01:32',NULL),('g','g','G','g','anthony@srvforma.afib.fr','N','','O','0000-00-00 00:00:00','0000-00-00 00:00:00',NULL),('garat','test','GARAT','sylvain','as@as.fr','N',NULL,'O','0000-00-00 00:00:00','0000-00-00 00:00:00',NULL),('lujero','dam','LUJERO','damien','damien@fgdf.fr','N','8978151108','O','2008-02-01 10:49:03','0000-00-00 00:00:00',NULL),('mayeur','123456','MAYEUR','nathalie','mm@mm.mm','N','3707764366','O','2008-02-01 12:15:13','2008-02-01 12:15:13','172.18.1.10'),('pat','pat40','GARANX','patrice','p.garanx@wanadoo.fr','N','5524253242','N','2008-02-01 11:45:45','0000-00-00 00:00:00',NULL),('pat40','pat40','GARANX','patrice','user1@srvforma.afib.fr','N','','O','2008-02-01 11:50:15','0000-00-00 00:00:00',NULL),('thierry','thierry','THIERRY','','moi@ici.fr','N','0674449044','O','2008-02-01 10:44:08','0000-00-00 00:00:00',NULL),('thierry1','thierry','THIERRY1','','moi@ici.fr','N','8923680259','O','2008-02-01 10:44:08','0000-00-00 00:00:00',NULL),('thierry2','thierry','THIERRY2','','user1@srvforma.afib.fr','N','1862842344','O','2008-02-01 10:44:08','0000-00-00 00:00:00',NULL),('toto','123456','TOTO','ll','ll@kk.kk','N','3619010202','O','2008-02-01 10:53:11','2008-02-01 10:53:11',NULL),('toto1','toto','TOTO1','','user1@srvforma.afib.fr','N','9768107842','O','2008-02-01 10:49:03','0000-00-00 00:00:00',NULL),('toto2','toto2','TOTO2','','user1@srvforma.afib.fr','N','','O','2008-02-01 12:22:39','2008-02-01 12:22:39','172.18.1.17'),('user1','user1','USER1','','user1@srvforma.afib.fr','N','','O','2008-02-01 11:36:16','2008-02-01 11:36:16','172.18.1.2');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `visites`
--

DROP TABLE IF EXISTS `visites`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `visites` (
  `login` varchar(15) NOT NULL,
  `id_topic` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`login`,`id_topic`),
  KEY `FK_visites_topics` (`id_topic`),
  CONSTRAINT `FK_visites_topics` FOREIGN KEY (`id_topic`) REFERENCES `topics` (`id_topic`) ON DELETE CASCADE,
  CONSTRAINT `FK_visites_users` FOREIGN KEY (`login`) REFERENCES `users` (`login`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `visites`
--

LOCK TABLES `visites` WRITE;
/*!40000 ALTER TABLE `visites` DISABLE KEYS */;
INSERT INTO `visites` VALUES ('anthony',2,'2017-05-28 09:13:19'),('anthony',7,'2008-01-31 16:45:21'),('anthony',11,'2008-02-01 10:20:49'),('anthony',13,'2017-05-28 09:05:37'),('anthony',14,'2008-02-01 11:21:55'),('anthony',16,'2008-01-31 15:49:55'),('anthony',18,'2008-01-31 15:48:54'),('anthony',25,'2008-01-31 15:48:36'),('anthony',26,'2017-05-28 09:15:54'),('anthony',27,'2008-02-01 11:21:49'),('anthony',28,'2008-02-01 12:25:44'),('anthony',30,'2017-05-28 09:15:31'),('don',2,'2008-01-31 16:49:32'),('don',25,'2008-01-31 17:01:23'),('don',26,'2008-01-31 17:01:17'),('garat',7,'2008-01-31 15:49:18'),('mayeur',2,'2008-02-01 12:15:13'),('mayeur',7,'2008-02-01 11:33:28'),('mayeur',14,'2008-02-01 11:32:09'),('mayeur',16,'2008-02-01 11:36:15'),('mayeur',18,'2008-02-01 11:40:53'),('mayeur',26,'2008-02-01 11:41:00'),('mayeur',27,'2008-02-01 11:32:24'),('toto2',2,'2008-02-01 12:14:38'),('toto2',7,'2008-02-01 12:01:56'),('toto2',11,'2008-02-01 11:00:19'),('toto2',13,'2008-02-01 12:22:19'),('toto2',14,'2008-02-01 12:19:23'),('toto2',16,'2008-02-01 12:14:01'),('toto2',26,'2008-02-01 12:14:22'),('toto2',27,'2008-02-01 11:07:01'),('user1',2,'2008-02-01 11:29:00'),('user1',7,'2008-02-01 11:36:16'),('user1',11,'2008-01-31 16:22:50'),('user1',13,'2008-01-31 15:50:25'),('user1',14,'2008-02-01 11:11:40'),('user1',18,'2008-01-31 16:10:58'),('user1',25,'2008-01-31 16:22:54'),('user1',27,'2008-02-01 11:10:20');
/*!40000 ALTER TABLE `visites` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-05-28 11:19:25
