-- MySQL dump 10.13  Distrib 5.1.69, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: blog
-- ------------------------------------------------------
-- Server version	5.1.69-0ubuntu0.11.10.1

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
-- Table structure for table `author`
--

DROP TABLE IF EXISTS `author`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `author` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` char(255) NOT NULL,
  `lastname` char(255) NOT NULL,
  `fullname` char(255) NOT NULL,
  `email` char(255) NOT NULL,
  `url` char(255) NOT NULL,
  `password` char(255) NOT NULL,
  UNIQUE(`email`),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `author`
--

LOCK TABLES `author` WRITE;
/*!40000 ALTER TABLE `author` DISABLE KEYS */;
INSERT INTO `author` VALUES (1,'author','one','author one','author@one.com','www.one.com','$2y$10$IJkfMjqDirzgOVO7ELVyAuk8bW60G1drhibpV23dOiwJ1QevfEGEO'),(2,'author','two','author two','author@two.com','www.two.com','$2y$10$ShIJOHWi/9Yz7jyRkJ.1ruURf3Hd74BC48ujgRm.4BVVUA/3Ufycy'),(3,'author','three','author three','author@three.com','www.three.com','$2y$10$YuduswAbE215dcqgDhgS7.vf7Zo5xAglkCb1Da.8NmmgcCSUlvPuO'),(4,'author','four','author four','author@four.com','www.four.com','$2y$10$BOWk6j/I0IKquUVFKMmnie4lCM21vjL.SPd/rpPzHJr.eakmQYmd6');
/*!40000 ALTER TABLE `author` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comment`
--

DROP TABLE IF EXISTS `comment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` char(255) NOT NULL,
  `email` char(255) NOT NULL,
  `url` char(255) NOT NULL,
  `title` char(255) NOT NULL,
  `content` text NOT NULL,
  `entry` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comment`
--

LOCK TABLES `comment` WRITE;
/*!40000 ALTER TABLE `comment` DISABLE KEYS */;
INSERT INTO `comment` VALUES (1,'mickey mouse','','','comment 1','Vestibulum ligula est, fermentum in pharetra in, hendrerit eu mi. Integer sodales ipsum eget placerat rutrum. Proin condimentum quis tortor mollis tristique. Vestibulum fermentum leo iaculis felis semper, ac vestibulum arcu placerat. Morbi dapibus nibh non justo sodales, eget varius elit tristique. Suspendisse potenti. ',1),(2,'donald duck','','','comment 2',' Proin placerat tellus metus, sit amet placerat nunc ornare id. Nunc et leo at diam eleifend accumsan ut a felis. Maecenas condimentum purus risus, nec viverra eros pretium nec. Donec sed rutrum eros.',1),(3,'goofy','','','comment 3','Suspendisse et sodales sapien. Mauris elit magna, congue a tristique ac, rhoncus ut orci. Maecenas ligula quam, laoreet fermentum dignissim eu, iaculis at sem. Sed metus felis, elementum eu sem vel, adipiscing molestie tortor. Curabitur viverra, purus ac facilisis vulputate, velit diam mollis ipsum, vel ultrices leo nunc nec nisi. Nam vitae diam eu lacus luctus elementum nec eu libero. Etiam tempus blandit metus nec gravida. Vestibulum fermentum convallis lobortis. ',1),(4,'pluto','','','comment 4','Ut ullamcorper sit amet ante id lacinia. Ut consectetur erat non justo feugiat, ut aliquam libero pulvinar. Ut sapien elit, dictum id ante sed, tincidunt lobortis felis. Vivamus et ultrices arcu, vel faucibus nisi. Nunc scelerisque laoreet diam sed posuere. Proin elit erat, semper vitae molestie nec, luctus in ante.',2),(5,'minnie mouse','','','comment 5','Vestibulum porta lacus ut risus vestibulum, vitae ultricies mi adipiscing. Fusce pulvinar molestie blandit. Maecenas molestie condimentum dolor ac volutpat. Etiam sed est urna. Sed eget ornare metus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Sed ullamcorper interdum velit at hendrerit. Sed in congue eros. Cras turpis odio, rhoncus sit amet metus nec, interdum cursus velit. Phasellus pretium non diam id varius. Nam et malesuada arcu. ',3),(6,'daisy duck','','','comment 6','Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec arcu nibh, elementum eu arcu ac, imperdiet tincidunt diam. Quisque eget tellus est. Nam vitae velit eros. Mauris non mauris in ipsum dapibus commodo. Proin hendrerit dignissim purus, id feugiat ante placerat vitae. Ut nec aliquet nunc, sed sagittis tellus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Maecenas nunc nunc, pharetra nec eros eu, sodales rutrum urna. ',3),(7,'clarabel','','','comment 7','Morbi non lacinia nibh. Fusce mattis et nisi non imperdiet. Proin at dui malesuada ipsum porttitor porta nec aliquam risus. Quisque auctor nisl nec mi vulputate, eu placerat dolor bibendum. Etiam vitae varius libero. Nam adipiscing, metus non consectetur interdum, nulla lorem aliquam leo, sed mattis lectus sapien ac tellus.',4),(8,'max','','','comment 8','Proin malesuada placerat turpis a scelerisque. Ut tempus arcu justo, at scelerisque lorem ullamcorper sed. Maecenas lacinia mauris in neque molestie sodales. Morbi at interdum quam, nec faucibus turpis. Cras nec tristique eros, vitae gravida nunc. Suspendisse potenti. In non quam aliquam, vulputate enim id, malesuada lorem. Phasellus sapien urna, porta a nisi eu, consequat venenatis mauris. Aliquam eros metus, condimentum eget venenatis eu, pulvinar et felis. Vivamus eget erat nunc. Suspendisse nec volutpat eros.',1),(9,'scrooge mcduck','','','comment 9','Nunc ante lorem, porta sit amet tellus quis, pulvinar hendrerit justo. Aenean dictum dui lacus, eu bibendum dui placerat quis. Aenean dignissim odio metus, eget aliquet dui pulvinar a. Proin lacinia urna purus. Pellentesque interdum suscipit consectetur. Ut semper sem vitae magna eleifend, id tempus leo blandit. ',2),(10,'huey duck','','','comment 10','Aliquam diam augue, molestie at imperdiet tincidunt, lacinia vel lectus. Nulla mollis non ipsum eu molestie. Proin pulvinar ante sed tempor lacinia. Ut lobortis congue sapien sit amet elementum. Integer semper, diam nec ullamcorper tincidunt, nisl nunc pharetra nulla, sit amet tempus est risus aliquam orci.',3),(11,'','','','comment 10','Aliquam mi sem, vehicula ut vulputate sit amet, luctus sed enim. Cras urna risus, consequat nec placerat congue, elementum vitae neque.',5),(12,'','','','copmment 11','Quisque at sollicitudin est, in tincidunt quam. Donec felis nisi, euismod in metus ut, aliquam pulvinar lectus. Donec gravida tristique ornare. Mauris nec dui justo. Donec in est metus. Donec sit amet ligula vel libero accumsan dictum ornare nec ante. Vivamus sed felis ornare sem mattis scelerisque vel id sapien. ',6),(13,'','','','comment 11','Suspendisse turpis felis, sagittis a tortor vel, luctus dignissim mauris. Aliquam euismod est tempor, varius felis eget, mollis nunc. Etiam fringilla leo sed rhoncus porta. Sed sodales ut neque sed elementum.',4),(14,'','','','comment 12','Quisque hendrerit eget tellus sit amet luctus. Integer in mi dapibus metus auctor auctor. Proin interdum vulputate felis, sit amet condimentum ligula semper sit amet. Mauris ut metus quis libero ultricies porttitor. Vestibulum tempus mi eu fermentum viverra. Etiam consectetur dapibus congue. Sed laoreet risus odio, a tempor erat molestie vulputate.',2),(15,'','','','comment 14','Quisque ultrices quis neque ac mollis. Vestibulum et semper ligula. Aliquam vitae sollicitudin dui. Maecenas venenatis magna elit, ac scelerisque dolor vestibulum ut. Integer non quam tristique, iaculis neque rhoncus, rutrum enim. Vivamus consectetur erat sed venenatis tincidunt.',3);
/*!40000 ALTER TABLE `comment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `entry`
--

DROP TABLE IF EXISTS `entry`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `entry` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `published_date` int(11) NOT NULL,
  `title` char(255) NOT NULL,
  `text` text NOT NULL,
  `author` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `entry`
--

LOCK TABLES `entry` WRITE;
/*!40000 ALTER TABLE `entry` DISABLE KEYS */;
INSERT INTO `entry` VALUES (1,1389792529,'entry 1','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris ornare massa nec neque hendrerit, id malesuada justo vehicula. Aliquam erat volutpat. Maecenas id nisl risus. Pellentesque risus massa, cursus dignissim tempor eget, suscipit in arcu. Aliquam erat volutpat. Pellentesque congue semper tempor. Phasellus arcu turpis, convallis sed tortor vulputate, interdum tincidunt nulla. Suspendisse sagittis tincidunt orci, in pharetra mauris ornare lacinia. Nunc auctor libero in lacus euismod, at auctor lectus iaculis. Quisque et bibendum urna. Cras quis elementum ante. Maecenas lectus erat, vulputate non mi id, sagittis lacinia erat.',1),(2,1389792529,'entry 2','Donec quis turpis nulla. Cras eu tempor diam. In hac habitasse platea dictumst. Praesent lectus magna, hendrerit ut orci sit amet, consectetur pharetra orci. Nunc porta eros eu placerat semper. Proin pharetra urna at metus rutrum, eget feugiat odio vulputate. Maecenas nunc dui, commodo ornare hendrerit vitae, ornare at lorem. Proin accumsan lacus metus, eu elementum lectus facilisis malesuada.',2),(3,1389792650,'entry3','Proin eu sem dignissim orci commodo volutpat at sit amet justo. Cras euismod at lorem vel pellentesque. Duis dapibus convallis enim, vel molestie mi sodales in. Sed tincidunt sodales nunc id vehicula. Donec at tellus urna. Nam in pharetra nulla, et consectetur nunc. Proin vel egestas lectus.',1),(4,1389792650,'entry4','Aenean id malesuada ipsum, eget tincidunt mi. Etiam in lacus commodo metus aliquet pellentesque. Ut ultrices libero sed felis volutpat, sed sollicitudin nunc dictum. Nulla porttitor varius dolor at placerat. Fusce lobortis tempus urna, sit amet consequat nibh dictum id. Nulla ac arcu luctus purus laoreet tempor. Aliquam congue ullamcorper mauris, ac ultricies purus laoreet sed.',3),(5,1389792650,'entry5','Fusce quis nisi auctor, feugiat eros iaculis, consectetur nisi. Pellentesque blandit purus massa, id tempus tellus malesuada a. Nullam non augue pulvinar, dapibus velit sit amet, semper odio. Praesent tincidunt, neque id fermentum viverra, enim purus porta purus, ut mollis nisl turpis nec neque. Integer cursus aliquet nulla et pharetra. Cras ultricies faucibus nisl ac venenatis. Morbi vel tempus ante, ut vulputate diam. Cras hendrerit condimentum magna, quis suscipit arcu aliquam a. Phasellus lacinia auctor quam, et bibendum diam ultrices a. Nunc sollicitudin feugiat sodales. Quisque placerat viverra est eu faucibus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Integer porta eros ligula, a auctor orci tincidunt sit amet. Proin condimentum ullamcorper sapien nec sagittis.',4),(6,1389792650,'entry6','tiam risus justo, porttitor non dapibus eget, facilisis tristique urna. Donec pharetra nisi a justo faucibus consectetur. Duis eleifend dolor elit. Morbi tristique enim vitae metus vehicula, quis luctus enim dapibus. Ut adipiscing, tellus et pretium semper, felis massa viverra orci, in rutrum arcu dui at felis. Fusce dapibus orci non tincidunt fringilla. Suspendisse porta urna velit. Donec pellentesque sapien a ipsum consectetur, vel sodales nunc fermentum. Etiam suscipit tellus tincidunt, sodales lectus vel, tempus dui. Nullam tempus suscipit nibh eget commodo. Integer aliquet fringilla ipsum, nec elementum nisl consectetur ac. Phasellus convallis, quam vitae commodo varius, quam lorem vulputate enim, id convallis enim odio sit amet ante. Phasellus commodo scelerisque mi vel porttitor. Vestibulum enim lectus, dapibus ut sodales a, egestas suscipit mi.',2),(7,1389792650,'entry7','Duis rhoncus elementum eleifend. Nam justo tortor, viverra a enim at, vulputate scelerisque urna. Nullam venenatis suscipit dictum. Integer id neque enim. Nulla est ipsum, imperdiet ut erat non, molestie lacinia quam. Quisque vel ante tempor, dictum turpis in, imperdiet enim. Donec at mauris porttitor, euismod est et, porttitor purus.',3);
/*!40000 ALTER TABLE `entry` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-01-16 17:24:56
