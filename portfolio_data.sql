-- MySQL dump 10.13  Distrib 8.4.3, for Win64 (x86_64)
--
-- Host: localhost    Database: portfolio_dev
-- ------------------------------------------------------
-- Server version	8.4.3

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Dumping data for table `contact_message`
--

LOCK TABLES `contact_message` WRITE;
/*!40000 ALTER TABLE `contact_message` DISABLE KEYS */;
INSERT INTO `contact_message` VALUES (10,'Ledeunf','Jean Francois','jeanfrancois.ledeunf@laposte.net','test audi final','test avant deploiement','2026-07-16 15:14:44'),(11,'Ledeunf','Michelle','michellegalves@orange.fr','test final','test final pour audit avant deploiement','2026-07-21 16:48:13');
/*!40000 ALTER TABLE `contact_message` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `project`
--

LOCK TABLES `project` WRITE;
/*!40000 ALTER TABLE `project` DISABLE KEYS */;
INSERT INTO `project` VALUES (1,'Mon portfolio','mon-portfolio','Portfolio de développeur Symfony','Site portfolio développé avec Symfony, Twig, EasyAdmin et MySQL.','https://github.com/jefflearning40',NULL,'logo_myPortFolio.svg','Terminé',1,1,'2026-07-20 13:51:29','2026-07-21 13:47:57',0),(2,'Shop Manager','shop-manager','Application de gestion commerciale développée pour lexamen concour DWWM 2025','Application de gestion commerciale développée avec symfony et bootstrape. Elle permettra de gérer les produits, les catégories, les stocks et les commandes et les vendeurs et clients au sein d’une interface moderne. Aussi possibilité de gérer un compte vendeur, de voir les statistiques de ventes, d\'envoyer des mails avec facture en PDF','https://github.com/jefflearning40/ShopManager',NULL,'logo-sm-6a5f8365a6d89124024501.png','Terminé',2,1,'2026-07-21 09:01:21','2026-07-23 13:01:10',0),(4,'BPM','bpm','Application de relevé d\'automesure tensionnelle','Application qui permet d\'enregistrer les relevés d\'automesure tensionnelle sur plusieurs jours, de calculer la moyenne systolique et diastolique, de créer une courbe puis d\'éditer un graphique, sur un PDF que l\'on peut imprimer ou envoyer par mail a son médecin','https://github.com/jefflearning40/BPM',NULL,'logo_BPC.PNG','En cours',4,1,'2026-07-21 09:11:39','2026-07-23 12:19:54',0),(5,'MagScan','magscan','Site vitrine pour une chaîne fictive de magasins.','Projet de site vitrine réalisé pour une chaîne fictive de magasins implantés en centre-ville.','https://github.com/jefflearning40',NULL,'logo_MS.PNG','En cours',5,1,'2026-07-21 09:13:35','2026-07-21 13:50:29',1),(6,'Plumbing Item','plumbing-item','Plumbing product management application.','An application for managing small plumbing items on the shelf, covering inventory, orders, sales, and statistics. The ultimate goal is to automate the dispensing of ordered products via an interactive kiosk located in the aisle, using a robot that moves along three axes to prepare the order (if the products are available) or to place an order on behalf of the customer using the application or kiosk.','https://github.com/jefflearning40/plumbing_item',NULL,'logo_plimbing.PNG','En cours',6,1,'2026-07-21 09:15:43','2026-07-23 12:16:06',1),(7,'VerbQuest','verbquest','application web d\'apprentissage des verbes irréguliers anglais','Développement d\'une application web d\'apprentissage des verbes irréguliers anglais reposant sur une architecture API REST avec un front-end React et un back-end Symfony. Les résultats des exercices sont enregistrés afin de suivre la progression des utilisateurs.','https://github.com/jefflearning40/irregular-cards',NULL,'logo-verbe-6a620ca4ab1c0706419784.png','En cours',6,1,'2026-07-23 12:42:59','2026-07-23 12:44:20',0);
/*!40000 ALTER TABLE `project` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `project_skill`
--

LOCK TABLES `project_skill` WRITE;
/*!40000 ALTER TABLE `project_skill` DISABLE KEYS */;
INSERT INTO `project_skill` VALUES (1,1),(1,2),(2,1),(2,2),(2,5),(2,6),(2,11),(2,12),(2,13),(2,14),(2,15),(2,16),(4,4),(4,5),(4,6),(4,8),(5,3),(5,4),(6,1),(6,2),(6,4),(6,5),(6,6),(6,8),(7,1),(7,3),(7,4),(7,10),(7,11);
/*!40000 ALTER TABLE `project_skill` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `project_translation`
--

LOCK TABLES `project_translation` WRITE;
/*!40000 ALTER TABLE `project_translation` DISABLE KEYS */;
INSERT INTO `project_translation` VALUES (1,'fr','Portfolio développeur','Portfolio professionnel développé avec Symfony pour présenter mes compétences, mes projets et mon parcours.','Portfolio professionnel conçu pour présenter mes compétences, mes projets, mon CV et mon profil de développeur web.',1),(2,'en','Developer Portfolio','Professional portfolio built with Symfony to showcase my skills, projects and background.','Professional portfolio designed to showcase my skills, my projects, my resume and my web developer profile.',1),(3,'fr','Shop Manager','Application Symfony de gestion de produits, catégories, clients et commandes.','Application web développée avec Symfony permettant de gérer un catalogue de produits, les catégories, les clients et les commandes. Ce projet m\'a permis de consolider mes compétences en architecture MVC, Doctrine, formulaires et administration de données.',2),(4,'en','Shop Manager','Symfony application for managing products, categories, customers and orders.','Symfony web application designed to manage a product catalog, categories, customers and orders. This project allowed me to strengthen my skills in MVC architecture, Doctrine ORM, forms and data management.',2),(7,'fr','mesure de la tension artérielle','Application JavaScript permettant d\'afficher et envoyer le relevé de tension','Application développée en JavaScript permettant de relever la tension arterielle et envoyer le resultat. Ce projet m\'a permis d\'approfondir les interactions avec l\'utilisateur, les calculs en temps réel et la manipulation du DOM afin d\'offrir une interface simple, fluide et intuitive.',4),(8,'en','Blood Pressure Monitor','Blood pressure monitoring with email reporting','An application that allows you to record self-measured blood pressure readings over several days, calculate systolic and diastolic averages, generate a trend line, and create a graph in a PDF format that can be printed or emailed to your doctor.',4),(9,'fr','MagScan','Application de gestion et de suivi des magasins','Application moderne développée avec React et Tailwind CSS permettant de gérer efficacement les informations des magasins. Ce projet m\'a permis de renforcer mes compétences en développement Front-End, en création d\'interfaces responsives, en gestion des composants React et en utilisation de Tailwind CSS pour concevoir une expérience utilisateur fluide et moderne.',5),(10,'en','MagScan','Store management web application built with React and Tailwind CSS.','Modern web application developed with React and Tailwind CSS to efficiently manage store information. This project allowed me to strengthen my Front-End development skills by building responsive user interfaces, developing reusable React components, and leveraging Tailwind CSS to create a modern, intuitive, and seamless user experience.',5),(11,'fr','Plumbing Item','Application Symfony de gestion de matériel de plomberie en rayon .','Application web développée avec Symfony permettant de gérer un catalogue de matériel de plomberie. Ce projet m\'a permis de renforcer mes compétences en développement Back-End, en modélisation de base de données avec Doctrine, en gestion des formulaires, en création d\'une interface d\'administration avec EasyAdmin et en conception d\'une application métier structurée et évolutive.',6),(12,'en','Plumbing Item','Symfony application for managing plumbing equipment.','Web application developed with Symfony to manage a catalog of plumbing equipment. This project allowed me to strengthen my Back-End development skills, database design with Doctrine, form handling, EasyAdmin administration, and the development of a structured and scalable business application.',6),(13,'fr','VerbQuest','application web d\'apprentissage des verbes irréguliers anglais','Développement d\'une application web d\'apprentissage des verbes irréguliers anglais reposant sur une architecture API REST avec un front-end React et un back-end Symfony. Les résultats des exercices sont enregistrés afin de suivre la progression des utilisateurs.',7),(14,'en','VerbQuest','web application for learning English irregular verbs','Development of a web application for learning English irregular verbs, based on a REST API architecture with a React front-end and a Symfony back-end. Exercise results are saved to track user progress',7);
/*!40000 ALTER TABLE `project_translation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `skill`
--

LOCK TABLES `skill` WRITE;
/*!40000 ALTER TABLE `skill` DISABLE KEYS */;
INSERT INTO `skill` VALUES (10,'API REST'),(13,'Bootstrap'),(6,'CSS3'),(14,'Docker'),(11,'Doctrine ORM'),(15,'gotenberg'),(5,'HTML5'),(8,'JavaScript'),(16,'mailpit'),(12,'MySQL'),(2,'PHP'),(3,'React'),(1,'Symfony'),(4,'Tailwind CSS');
/*!40000 ALTER TABLE `skill` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'jeanfrancois.ledeunf@laposte.net','[\"ROLE_ADMIN\"]','$2y$13$ABeclTYyXnsmTgxD6XHcUuO/cMcl73ruNXOQqZ8v1hKckdHWA5Sde');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-07-24 15:48:21
