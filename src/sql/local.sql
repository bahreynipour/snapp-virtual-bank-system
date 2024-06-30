-- MySQL dump 10.13  Distrib 8.0.16, for macos10.14 (x86_64)
--
-- Host: localhost    Database: local
-- ------------------------------------------------------
-- Server version	8.0.16

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
 SET NAMES utf8mb4 ;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `accounts`
--

DROP TABLE IF EXISTS `accounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `accounts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `number` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `balance` decimal(26,0) unsigned NOT NULL DEFAULT '0',
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `accounts_number_unique` (`number`),
  UNIQUE KEY `accounts_uuid_unique` (`uuid`),
  KEY `accounts_user_id_foreign` (`user_id`),
  CONSTRAINT `accounts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accounts`
--

LOCK TABLES `accounts` WRITE;
/*!40000 ALTER TABLE `accounts` DISABLE KEYS */;
INSERT INTO `accounts` VALUES (1,1,'215205894539',65,'09e343dd-99e9-3a4e-8854-5df382eab552','2024-06-29 22:19:10','2024-06-29 23:53:51',NULL);
INSERT INTO `accounts` VALUES (2,1,'456451585661',30,'79177020-d503-3b9c-b798-7298a2eea1ad','2024-06-29 22:19:10','2024-06-29 22:21:16',NULL);
INSERT INTO `accounts` VALUES (3,2,'517850504329',28,'be9d18aa-bb4a-3f2f-ada5-d65e52d23d24','2024-06-29 22:19:10','2024-06-29 23:53:51',NULL);
INSERT INTO `accounts` VALUES (4,2,'699706891377',452240204,'614d322c-0bb6-386c-a270-61a1e088b19c','2024-06-29 22:19:10','2024-06-29 22:19:10',NULL);
INSERT INTO `accounts` VALUES (5,3,'130913682214',364115517,'9e99d88a-454d-3ed0-8491-c3fdf9f17c82','2024-06-29 22:19:10','2024-06-29 22:19:10',NULL);
INSERT INTO `accounts` VALUES (6,3,'896429810056',92409570,'bba696e6-df59-3317-a4c9-36d641121e1d','2024-06-29 22:19:10','2024-06-29 22:19:10',NULL);
INSERT INTO `accounts` VALUES (7,4,'917596200137',99877313,'8d903b84-a882-31b3-9eb2-9edd8732185f','2024-06-29 22:19:10','2024-06-29 22:19:10',NULL);
INSERT INTO `accounts` VALUES (8,4,'067234880661',371692737,'fd6b1d72-da72-3962-a33b-c707c108b06e','2024-06-29 22:19:10','2024-06-29 22:19:10',NULL);
INSERT INTO `accounts` VALUES (9,5,'319287320930',250649949,'ebfca204-4862-3912-8be6-4035097b6a7d','2024-06-29 22:19:10','2024-06-29 22:19:10',NULL);
INSERT INTO `accounts` VALUES (10,5,'239463821686',288008490,'9c363777-7d33-3271-a6c0-62f4dd1a7c3c','2024-06-29 22:19:10','2024-06-29 22:19:10',NULL);
/*!40000 ALTER TABLE `accounts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cards`
--

DROP TABLE IF EXISTS `cards`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `cards` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `account_id` bigint(20) unsigned NOT NULL,
  `number` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_locked` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `cards_number_unique` (`number`),
  KEY `cards_account_id_foreign` (`account_id`),
  CONSTRAINT `cards_account_id_foreign` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cards`
--

LOCK TABLES `cards` WRITE;
/*!40000 ALTER TABLE `cards` DISABLE KEYS */;
INSERT INTO `cards` VALUES (1,1,'4929140273620611',0,'2024-06-29 22:19:10','2024-06-29 22:19:10',NULL);
INSERT INTO `cards` VALUES (2,1,'4485850705733305',0,'2024-06-29 22:19:10','2024-06-29 22:19:10',NULL);
INSERT INTO `cards` VALUES (3,2,'4024007120571780',0,'2024-06-29 22:19:10','2024-06-29 22:19:10',NULL);
INSERT INTO `cards` VALUES (4,2,'4539443919595656',0,'2024-06-29 22:19:10','2024-06-29 22:19:10',NULL);
INSERT INTO `cards` VALUES (5,3,'4916777230161406',0,'2024-06-29 22:19:10','2024-06-29 22:19:10',NULL);
INSERT INTO `cards` VALUES (6,3,'4024007145031422',0,'2024-06-29 22:19:10','2024-06-29 22:19:10',NULL);
INSERT INTO `cards` VALUES (7,4,'4024007137082714',0,'2024-06-29 22:19:10','2024-06-29 22:19:10',NULL);
INSERT INTO `cards` VALUES (8,4,'4804937096026995',0,'2024-06-29 22:19:10','2024-06-29 22:19:10',NULL);
INSERT INTO `cards` VALUES (9,5,'4556884799145187',0,'2024-06-29 22:19:10','2024-06-29 22:19:10',NULL);
INSERT INTO `cards` VALUES (10,5,'4716810022352909',0,'2024-06-29 22:19:10','2024-06-29 22:19:10',NULL);
INSERT INTO `cards` VALUES (11,6,'4556075547959017',0,'2024-06-29 22:19:10','2024-06-29 22:19:10',NULL);
INSERT INTO `cards` VALUES (12,6,'4556945133474599',0,'2024-06-29 22:19:10','2024-06-29 22:19:10',NULL);
INSERT INTO `cards` VALUES (13,7,'4024007152692116',0,'2024-06-29 22:19:10','2024-06-29 22:19:10',NULL);
INSERT INTO `cards` VALUES (14,7,'4929462646350431',0,'2024-06-29 22:19:10','2024-06-29 22:19:10',NULL);
INSERT INTO `cards` VALUES (15,8,'4556933143070342',0,'2024-06-29 22:19:10','2024-06-29 22:19:10',NULL);
INSERT INTO `cards` VALUES (16,8,'4716115840154564',0,'2024-06-29 22:19:10','2024-06-29 22:19:10',NULL);
INSERT INTO `cards` VALUES (17,9,'4024007193520334',0,'2024-06-29 22:19:10','2024-06-29 22:19:10',NULL);
INSERT INTO `cards` VALUES (18,9,'4539957960636333',0,'2024-06-29 22:19:10','2024-06-29 22:19:10',NULL);
INSERT INTO `cards` VALUES (19,10,'4556172228555600',0,'2024-06-29 22:19:10','2024-06-29 22:19:10',NULL);
INSERT INTO `cards` VALUES (20,10,'4929657062667123',0,'2024-06-29 22:19:10','2024-06-29 22:19:10',NULL);
/*!40000 ALTER TABLE `cards` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1);
INSERT INTO `migrations` VALUES (2,'0001_01_01_000001_create_cache_table',1);
INSERT INTO `migrations` VALUES (3,'0001_01_01_000002_create_jobs_table',1);
INSERT INTO `migrations` VALUES (4,'2024_06_27_162717_create_accounts_table',1);
INSERT INTO `migrations` VALUES (5,'2024_06_27_162737_create_cards_table',1);
INSERT INTO `migrations` VALUES (6,'2024_06_27_170106_create_transactions_table',1);
INSERT INTO `migrations` VALUES (7,'2024_06_27_185636_create_personal_access_tokens_table',1);
INSERT INTO `migrations` VALUES (8,'2024_06_29_123949_create_transfers_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transactions`
--

DROP TABLE IF EXISTS `transactions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `transactions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `account_id` bigint(20) unsigned NOT NULL,
  `source_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `source_id` bigint(20) unsigned DEFAULT NULL,
  `amount` decimal(26,0) NOT NULL,
  `balance` decimal(26,0) unsigned NOT NULL DEFAULT '0',
  `type` enum('deposit','withdraw') COLLATE utf8mb4_unicode_ci NOT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('initialized','success','on_hold','canceled','awaiting_approval','failed') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'initialized',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `completed_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `transactions_uuid_unique` (`uuid`),
  KEY `transactions_account_id_foreign` (`account_id`),
  KEY `transactions_source_type_source_id_index` (`source_type`,`source_id`),
  KEY `transactions_type_index` (`type`),
  KEY `transactions_status_index` (`status`),
  CONSTRAINT `transactions_account_id_foreign` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transactions`
--

LOCK TABLES `transactions` WRITE;
/*!40000 ALTER TABLE `transactions` DISABLE KEYS */;
INSERT INTO `transactions` VALUES (5,1,NULL,NULL,123,0,'deposit','cc922041-a5f7-4a22-8cd0-950808758726','initialized','2024-06-29 22:21:16','2024-06-29 22:21:16',NULL);
INSERT INTO `transactions` VALUES (6,1,'App\\Models\\Transfer',5,-30,0,'withdraw','f58fcf38-3a5e-4ef2-8de5-51228d6c3a45','initialized','2024-06-29 22:21:16','2024-06-29 22:21:16',NULL);
INSERT INTO `transactions` VALUES (7,2,'App\\Models\\Transaction',6,30,0,'deposit','984889c9-1dcf-40ea-8eb7-f943ba6d55e8','initialized','2024-06-29 22:21:16','2024-06-29 22:21:16',NULL);
INSERT INTO `transactions` VALUES (8,1,'App\\Models\\Transfer',6,-2,0,'withdraw','6ffb1b6f-ae99-4fe1-b8bc-52626f470fce','initialized','2024-06-29 23:03:30','2024-06-29 23:03:30',NULL);
INSERT INTO `transactions` VALUES (9,3,'App\\Models\\Transaction',8,2,0,'deposit','4a718911-d5ff-4ebc-84f1-afd401c24e65','initialized','2024-06-29 23:03:30','2024-06-29 23:03:30',NULL);
INSERT INTO `transactions` VALUES (10,1,'App\\Models\\Transfer',7,-2,0,'withdraw','8ee99cdf-7c59-4fcb-876f-e058d25bdd83','initialized','2024-06-29 23:03:31','2024-06-29 23:03:31',NULL);
INSERT INTO `transactions` VALUES (11,3,'App\\Models\\Transaction',10,2,0,'deposit','ab7e9b1f-0f27-4961-97b3-5c61fb7b2ca6','initialized','2024-06-29 23:03:31','2024-06-29 23:03:31',NULL);
INSERT INTO `transactions` VALUES (12,1,'App\\Models\\Transfer',8,-2,0,'withdraw','e4fdbe6e-0364-4265-8f9d-9a89bf972d5d','initialized','2024-06-29 23:03:56','2024-06-29 23:03:56',NULL);
INSERT INTO `transactions` VALUES (13,3,'App\\Models\\Transaction',12,2,0,'deposit','e0c4d8a5-c730-4158-aea1-b0a0f77e0b92','initialized','2024-06-29 23:03:56','2024-06-29 23:03:56',NULL);
INSERT INTO `transactions` VALUES (14,1,'App\\Models\\Transfer',11,-2,85,'withdraw','dd92a398-a1af-448e-b6d8-31267f3bdb51','initialized','2024-06-29 23:12:58','2024-06-29 23:12:58',NULL);
INSERT INTO `transactions` VALUES (15,3,'App\\Models\\Transaction',14,2,8,'deposit','e6d62665-77e2-45da-bfa4-ecd4e59a32a5','initialized','2024-06-29 23:12:58','2024-06-29 23:12:58',NULL);
INSERT INTO `transactions` VALUES (16,1,'App\\Models\\Transfer',12,-2,83,'withdraw','fc843905-680d-4180-82b7-2f9f19df8a5e','initialized','2024-06-29 23:50:58','2024-06-29 23:50:58',NULL);
INSERT INTO `transactions` VALUES (17,3,'App\\Models\\Transaction',16,2,10,'deposit','c4d72c59-3e4f-4ecc-8dd0-26ee46456f8b','initialized','2024-06-29 23:50:58','2024-06-29 23:50:58',NULL);
INSERT INTO `transactions` VALUES (18,1,'App\\Models\\Transfer',13,-2,81,'withdraw','17537741-d7e9-403c-be42-e6122b821696','initialized','2024-06-29 23:51:30','2024-06-29 23:51:30',NULL);
INSERT INTO `transactions` VALUES (19,3,'App\\Models\\Transaction',18,2,12,'deposit','e0821341-d477-4953-a03c-ea48875c4641','initialized','2024-06-29 23:51:30','2024-06-29 23:51:30',NULL);
INSERT INTO `transactions` VALUES (20,1,'App\\Models\\Transfer',14,-2,79,'withdraw','64c561b7-21ce-4751-b5a3-ddb778fab31a','initialized','2024-06-29 23:51:40','2024-06-29 23:51:40',NULL);
INSERT INTO `transactions` VALUES (21,3,'App\\Models\\Transaction',20,2,14,'deposit','a48ff6e0-f96a-416a-8cd7-4be30caec547','initialized','2024-06-29 23:51:40','2024-06-29 23:51:40',NULL);
INSERT INTO `transactions` VALUES (22,1,'App\\Models\\Transfer',15,-2,77,'withdraw','8afe7098-5f8d-4ae1-ae59-f02d9f20b3a5','initialized','2024-06-29 23:51:40','2024-06-29 23:51:40',NULL);
INSERT INTO `transactions` VALUES (23,3,'App\\Models\\Transaction',22,2,16,'deposit','1f301227-e78e-420c-acfb-7748ecbb4108','initialized','2024-06-29 23:51:40','2024-06-29 23:51:40',NULL);
INSERT INTO `transactions` VALUES (24,1,'App\\Models\\Transfer',16,-2,75,'withdraw','947b232a-1afe-4eda-8c17-f8ad2fd42cb0','initialized','2024-06-29 23:51:45','2024-06-29 23:51:45',NULL);
INSERT INTO `transactions` VALUES (25,3,'App\\Models\\Transaction',24,2,18,'deposit','790fce6a-8d5c-49c0-94f2-a4992b3c3d7b','initialized','2024-06-29 23:51:45','2024-06-29 23:51:45',NULL);
INSERT INTO `transactions` VALUES (26,1,'App\\Models\\Transfer',17,-2,73,'withdraw','57580006-0153-4716-ae17-c3bcd7729f8d','initialized','2024-06-29 23:51:59','2024-06-29 23:51:59',NULL);
INSERT INTO `transactions` VALUES (27,3,'App\\Models\\Transaction',26,2,20,'deposit','ec5af0e1-86db-4c6a-9f48-48b0aaec74fa','initialized','2024-06-29 23:51:59','2024-06-29 23:51:59',NULL);
INSERT INTO `transactions` VALUES (28,1,'App\\Models\\Transfer',18,-2,71,'withdraw','0a0ba0ae-4959-4b79-94dc-29f435efc4c8','initialized','2024-06-29 23:52:23','2024-06-29 23:52:23',NULL);
INSERT INTO `transactions` VALUES (29,3,'App\\Models\\Transaction',28,2,22,'deposit','0cbf9e84-c5aa-473e-81fd-f055c94399e3','initialized','2024-06-29 23:52:23','2024-06-29 23:52:23',NULL);
INSERT INTO `transactions` VALUES (32,1,'App\\Models\\Transfer',21,-2,69,'withdraw','c30100e9-9662-48c3-a064-4dd9ab78c898','initialized','2024-06-29 23:53:35','2024-06-29 23:53:35',NULL);
INSERT INTO `transactions` VALUES (33,3,'App\\Models\\Transaction',32,2,24,'deposit','5fff7295-e207-4eab-b5f5-549082dea5d9','initialized','2024-06-29 23:53:35','2024-06-29 23:53:35',NULL);
INSERT INTO `transactions` VALUES (34,1,'App\\Models\\Transfer',22,-2,67,'withdraw','4b5c0c03-d757-4705-a95f-f179d41434b4','initialized','2024-06-29 23:53:45','2024-06-29 23:53:45',NULL);
INSERT INTO `transactions` VALUES (35,3,'App\\Models\\Transaction',34,2,26,'deposit','1d823686-1abc-4d5d-8b5f-9c278c3dedd1','initialized','2024-06-29 23:53:45','2024-06-29 23:53:45',NULL);
INSERT INTO `transactions` VALUES (36,1,'App\\Models\\Transfer',23,-2,65,'withdraw','7ad610b5-5ba1-41c1-9fc8-6c6fa6a661dd','initialized','2024-06-29 23:53:51','2024-06-29 23:53:51',NULL);
INSERT INTO `transactions` VALUES (37,3,'App\\Models\\Transaction',36,2,28,'deposit','464d1ce8-7ca5-424b-92df-8a1dfe4cb873','initialized','2024-06-29 23:53:51','2024-06-29 23:53:51',NULL);
/*!40000 ALTER TABLE `transactions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transfers`
--

DROP TABLE IF EXISTS `transfers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `transfers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `driver` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `from_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `from_id` bigint(20) unsigned NOT NULL,
  `to_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `to_id` bigint(20) unsigned NOT NULL,
  `meta` json DEFAULT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `transfers_from_type_from_id_index` (`from_type`,`from_id`),
  KEY `transfers_to_type_to_id_index` (`to_type`,`to_id`),
  KEY `transfers_driver_index` (`driver`),
  KEY `transfers_uuid_index` (`uuid`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transfers`
--

LOCK TABLES `transfers` WRITE;
/*!40000 ALTER TABLE `transfers` DISABLE KEYS */;
INSERT INTO `transfers` VALUES (5,'c2c','App\\Models\\Card',1,'App\\Models\\Card',3,NULL,'cc2532b7-a8dd-4b06-9300-00ab1158a9bc','2024-06-29 22:21:16','2024-06-29 22:21:16',NULL);
INSERT INTO `transfers` VALUES (6,'card-to-card','App\\Models\\Card',1,'App\\Models\\Card',5,NULL,'b655eba2-dcd3-4387-bafe-13c74aa2fa4c','2024-06-29 23:03:30','2024-06-29 23:03:30',NULL);
INSERT INTO `transfers` VALUES (7,'card-to-card','App\\Models\\Card',1,'App\\Models\\Card',5,NULL,'72448b18-1fa0-47cd-accf-20d206642ac4','2024-06-29 23:03:31','2024-06-29 23:03:31',NULL);
INSERT INTO `transfers` VALUES (8,'card-to-card','App\\Models\\Card',1,'App\\Models\\Card',5,NULL,'2359dba1-d9e1-47c5-b06c-1d7c1f196fc9','2024-06-29 23:03:56','2024-06-29 23:03:56',NULL);
INSERT INTO `transfers` VALUES (11,'card-to-card','App\\Models\\Card',1,'App\\Models\\Card',5,NULL,'26b34800-98cf-41ea-b208-61f03d28c41c','2024-06-29 23:12:58','2024-06-29 23:12:58',NULL);
INSERT INTO `transfers` VALUES (12,'card-to-card','App\\Models\\Card',1,'App\\Models\\Card',5,NULL,'cc8a9358-24e0-4f35-9792-b3c7cb144022','2024-06-29 23:50:58','2024-06-29 23:50:58',NULL);
INSERT INTO `transfers` VALUES (13,'card-to-card','App\\Models\\Card',1,'App\\Models\\Card',5,NULL,'3477f93f-a117-4291-ab69-d78dc403e5a9','2024-06-29 23:51:30','2024-06-29 23:51:30',NULL);
INSERT INTO `transfers` VALUES (14,'card-to-card','App\\Models\\Card',1,'App\\Models\\Card',5,NULL,'db98f4d7-7cc6-42f2-bcaf-2dbf27ac797b','2024-06-29 23:51:40','2024-06-29 23:51:40',NULL);
INSERT INTO `transfers` VALUES (15,'card-to-card','App\\Models\\Card',1,'App\\Models\\Card',5,NULL,'dcddbf1b-07fe-410e-87d0-e632a190a5d7','2024-06-29 23:51:40','2024-06-29 23:51:40',NULL);
INSERT INTO `transfers` VALUES (16,'card-to-card','App\\Models\\Card',1,'App\\Models\\Card',5,NULL,'973c59ef-6e71-4cb2-a1a0-0e644a1cb530','2024-06-29 23:51:45','2024-06-29 23:51:45',NULL);
INSERT INTO `transfers` VALUES (17,'card-to-card','App\\Models\\Card',1,'App\\Models\\Card',5,NULL,'c2501e8c-77bb-4be8-a163-50d688ae9941','2024-06-29 23:51:59','2024-06-29 23:51:59',NULL);
INSERT INTO `transfers` VALUES (18,'card-to-card','App\\Models\\Card',1,'App\\Models\\Card',5,NULL,'a01edfb6-2932-47e2-9124-f2be1c043c16','2024-06-29 23:52:23','2024-06-29 23:52:23',NULL);
INSERT INTO `transfers` VALUES (21,'card-to-card','App\\Models\\Card',1,'App\\Models\\Card',5,NULL,'0b25104b-b9b0-4e16-99d3-76d6f9b18389','2024-06-29 23:53:35','2024-06-29 23:53:35',NULL);
INSERT INTO `transfers` VALUES (22,'card-to-card','App\\Models\\Card',1,'App\\Models\\Card',5,NULL,'624eaa87-c6a3-40d5-aef5-bd5e2fe199e2','2024-06-29 23:53:45','2024-06-29 23:53:45',NULL);
INSERT INTO `transfers` VALUES (23,'card-to-card','App\\Models\\Card',1,'App\\Models\\Card',5,NULL,'0affe8d9-88be-4d9a-ba35-c7e3d57ac1b8','2024-06-29 23:53:51','2024-06-29 23:53:51',NULL);
/*!40000 ALTER TABLE `transfers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_mobile_unique` (`mobile`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Buck','Zulauf','989303238566',NULL,'2024-06-29 22:19:10','2024-06-29 22:19:10',NULL);
INSERT INTO `users` VALUES (2,'Christine','Bruen','989017416670',NULL,'2024-06-29 22:19:10','2024-06-29 22:19:10',NULL);
INSERT INTO `users` VALUES (3,'Dylan','Schiller','989421684839',NULL,'2024-06-29 22:19:10','2024-06-29 22:19:10',NULL);
INSERT INTO `users` VALUES (4,'Hubert','Hodkiewicz','989609961425',NULL,'2024-06-29 22:19:10','2024-06-29 22:19:10',NULL);
INSERT INTO `users` VALUES (5,'Estrella','Trantow','989040226455',NULL,'2024-06-29 22:19:10','2024-06-29 22:19:10',NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-06-30  7:03:04
