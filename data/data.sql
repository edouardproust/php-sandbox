-- MySQL dump 10.16  Distrib 10.1.26-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: db
-- ------------------------------------------------------
-- Server version	10.1.26-MariaDB-0+deb9u1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `authors`
--

DROP TABLE IF EXISTS `authors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `authors` (
  `id` tinyint(4) DEFAULT NULL,
  `name` varchar(14) DEFAULT NULL,
  `bio` varchar(222) DEFAULT NULL,
  `picture` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `authors`
--

LOCK TABLES `authors` WRITE;
/*!40000 ALTER TABLE `authors` DISABLE KEYS */;
INSERT INTO `authors` VALUES (1,'Edouard Proust','Creator of this blog. Found of coding!','edouard.jpg'),(4,'Alexis Lemat','I am a web content writer with strong experience in international customer service and B2B copywriting. I am an active member of the WordPress community: i love translating WordPress into Italian and speaking at WordCamps.','alexis.jpg');
/*!40000 ALTER TABLE `authors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `id` tinyint(4) DEFAULT NULL,
  `name` varchar(13) DEFAULT NULL,
  `description` varchar(56) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'uncategorized',''),(2,'sport','Posts related to sports'),(3,'coding','Posts related to coding!'),(4,'trading',''),(6,'mindset',''),(7,'News','Be aware of the last and main news all around the world!');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `posts` (
  `id` tinyint(4) DEFAULT NULL,
  `title` varchar(61) DEFAULT NULL,
  `date` bigint(20) DEFAULT NULL,
  `introduction` text,
  `content` text,
  `featured_image` varchar(37) DEFAULT NULL,
  `author` varchar(14) DEFAULT NULL,
  `category` varchar(13) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts`
--

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT INTO `posts` VALUES (3,'Aute Lorem consectetur',1607713236,'Sunt magna mollit anim dolor occaecat. Deserunt cupidatat magna et proident. Incididunt exercitation cupidatat voluptate esse. Nisi cupidatat laborum consequat laboris incididunt.','Qui tempor consequat velit veniam occaecat sit et dolor duis. Ipsum non minim deserunt ex consequat non proident. Sunt do labore veniam proident. Elit culpa dolor ullamco exercitation.\r\nTempor sunt deserunt est amet dolor deserunt voluptate ullamco. Occaecat laboris ut irure dolore consectetur non pariatur ad aliqua. Ex cillum minim non excepteur ex.\r\nTempor reprehenderit enim cillum laboris occaecat. Magna dolore aute id in esse amet ut qui. Aute occaecat do anim voluptate.\r\nLorem aliquip laborum fugiat eu do dolore aute. Amet Lorem laboris proident et voluptate non ea dolore laborum. Laboris ut aliqua in ad nisi do ex adipisicing est. Ut duis Lorem non eu fugiat ullamco proident dolor sint.','amsterdam-2206814_1280.jpg','Edouard Proust','sport'),(18,'\'ZenPods\' Ultralight Wireless Earbuds Have ANC, ENC and More',1607712045,'The \'ZenPods\' ultralight wireless earbuds are a new audio offering that is focused on providing impressive auditory feedback and more for users to enjoy.','The headphones are focused on providing an ultra-lightweight user experience that\'s paired with an ergonomic fit to make them as comfortable as possible for everyday use. The earbuds also feature active noise cancellation (ANC) as well as environment noise cancellation (ENC) to make them well-suited for users to wear in busy city streets and beyond.\r\n\r\nThe \'ZenPods\' ultralight wireless earbuds are equipped with 13mm drivers for enhanced feedback that is reported to offer deep bass that is unparalleled to what\'s possible with other options on the market. An IPX5 rating makes the headphones perfect for keeping up with busy consumer lifestyles.','poland-City-Building-Architecture.jpg','Edouard Proust','uncategorized'),(46,'Moving PHP and Laravel tests from Travis CI to GitHub Actions',1607713164,'Earlier this year, Travis CI announced a new pricing model that effectively ends the generous open-source offering they had for many years. It seems that, even though there were some plans to provide free resources for OSS projects in the future, all activity for OSS projects has stopped.','At our company, we create a lot of open-source projects and packages. Beginning 2020, we already moved most of our stuff to GitHub actions.\r\n\r\nSure, you can read the GitHub actions docs to start learning the possibilities, but in my experience, it might be better to see some examples of practical uses cases. Here are some interesting links that might help you get started with GitHub actions.\r\n\r\nVideos #\r\nRunning PHP package tests on GitHub Actions\r\nSupporting multiple versions of PHP and Laravel on GitHub actions\r\nGitHub Actions for Laravel Developers, a talk given by Ryan Chandler at The Laravel Worldwide Meetup\r\nBlogposts #\r\nUsing GitHub actions to run the tests of Laravel projects and packages\r\nHow to use a MySQL database on GitHub actions\r\nRynan Chandler: Running GitHub actions for Certain Commit Messages\r\nDries Vints: Building and Deploying Laravel with Github Actions\r\nStefan Zweifel: Run prettier or php-cs-fixer with GitHub Actions\r\nDan Mason: automating the Laravel 8 schema dump using GitHub actions\r\nCode #\r\nAwesome Actions list\r\nThe action we use to test our framework agnostic packages\r\nThe action we use to test our Laravel packages\r\nRunning Psalm\r\nRunning PHP CS Fixer\r\nPaid stuff #\r\nI\'m not getting paid to mention these; I trust these folks to deliver quality stuff.\r\n\r\nMicheal Heap: Building GitHub actions\r\nRyan Chandler: GitHub actions for PHP developers\r\nIn closing #\r\nAt Spatie, we\'re pretty happy with GitHub Actions. If you have a practical question on getting started, feel free to hit me up on Twitter.\r\n\r\nLike Nuno, I\'m grateful for all the years that Travis CI offered a free tier for opensource. Also keep in mind what Stefan said: GitHub actions aren\'t the only alternative, do take a look at CircleCI and Gitlab CI as well.','','Edouard Proust','coding'),(59,'We just tried the Magic Silver Gloves!',1607713135,'Avec ces gants du futurs vous allez pouvoir couper tout ce que vous voulez sans risquer de vous couper les doigts!','I\'m excited to be taking you through this long awaited tutorial, finally. I\'ll show you how to build a complete blog application from scratch using PHP and MySQL database. A blog as you know it is an application where some users (Admin users) can create, edit, update and publish articles to make them available in the public to read and maybe comment on. Users and the public can browse through a catalog of these articles and click to anyone to read more about the article and comment on them.\r\n\r\nFeatures:\r\nA user registration system that manages two types of users: Admin and Normal Users\r\nThe blog will have an admin area and a public area separate from each other\r\nThe admin area will be accessible only to logged in admin users and the public area to the normal users and the general public\r\nIn the admin section, two types of admins exist: \r\nAdmin:\r\nCan create, view, update, publish/unpublish and delete ANY post.\r\nCan also create, view, update and delete topics.\r\nAn Admin user (and only an Admin user) can create another admin user or Author\r\nCan view, update and delete other admin users\r\nAuthor:\r\nCan create, view, update and delete only posts created by themselves\r\nThey cannot publish a post. All publishing of posts is done by the Admin user.\r\nOnly published posts are displayed in the public area for viewing\r\nEach post is created under a particular topic\r\nA many-to-many relationship exists between posts and topics.\r\nThe public page lists posts; each post displayed with a featured image, author, and date of creation.\r\nThe user can browse through all posts listings under a particular topic by clicking on the topic\r\nWhen a user clicks on a post, they can view the full post and comment at the bottom of the posts.\r\nA Disqus commenting system is implemented which allows users to comment using social media accounts with platforms like Facebook, GooglePlus, Twitter.\r\nRecommended course: PHP Beginner To Master - CMS Project\r\nImplementation\r\nOkay straight away let\'s start coding.\r\n\r\nWe\'ll call the project complete-blog-php. On your server directory (htdocs or www), create a folder named complete-blog-php. Open this folder in a text editor of your choice, for example, Sublime Text. Create the following subfolders inside it: admin, includes, and static.\r\n\r\nThe 3 folders will hold the following contents:\r\n\r\nadmin: Will hold files for the admin backend area. Files concerned with creating, viewing, updating and deleting posts, topics, users.\r\nincludes: Will hold files containing pieces of code that will be included into one or more other pages. E.g. Files for error display\r\nstatic: Hold static files such as images, CSS stylesheets, Javascript.\r\nIn the root folder of the application, create a file named index.php:','feature-ramasse-verre.jpg','Alexis Lemat','uncategorized'),(60,'Cloud-gaming platforms were 2020’s most overhyped trend',1607712832,'The future of the technology is bright, but much less sexy.','It was an unprecedented year for [insert anything under the sun], and while plenty of tech verticals saw shifts that warped business models and shifted user habits, the gaming industry experienced plenty of new ideas in 2020. However, the loudest trends don’t always take hold as predicted.\r\n\r\nThis year, Google, Microsoft, Facebook and Amazon each leaned hard into new cloud-streaming tech that shifts game processing and computing to cloud-based servers, allowing users to play graphics-intensive content on low-powered systems or play titles without dealing with lengthy downloads.\r\n\r\nIt was heralded by executives as a tectonic shift for gaming, one that would democratize access to the next generation of titles. But in taking a closer look at the products built around this tech, it’s hard to see a future where any of these subscription services succeed.\r\n\r\nMassive year-over-year changes in gaming are rare because even if a historically unique platform launches or is unveiled, it takes time for a critical mass of developers to congregate and adopt something new — and longer for users to coalesce. As a result, even in a year where major console makers launch historically powerful hardware, massive tech giants pump cash into new cloud-streaming tech and gamers log more hours collectively than ever before, it can feel like not much has shifted.\r\n\r\nThat said, the gaming industry did push boundaries in 2020, though it’s unclear where meaningful ground was gained. The most ambitious drives were toward redesigning marketplaces in the image of video streaming networks, aiming to make a more coordinated move toward driving subscription growth and moving farther away from an industry defined for decades by one-time purchases structured around single-player storylines, one dramatically shaped by internet networking and instantaneous payments infrastructure software.\r\n\r\nToday’s products are far from dead ends for what the broader industry does with the technology.\r\n\r\nBut shifting gamers farther away from one-off purchases wasn’t even the gaming industry’s most fundamental reconsideration of the year, a space reserved for a coordinated move by the world’s richest companies to upend the console wars with an invisible competitor. It’s perhaps unsurprising that the most full-featured plays in this arena are coming from the cloud services triumvirate, with Google, Microsoft and Amazon each making significant strides in recent months.\r\n\r\nThe driving force for this change is both the maturation of virtual desktop streaming and continued developer movement toward online cross-play between gaming platforms, a trend long resisted by legacy platform owners intent on maintaining siloed network effects that pushed gamers toward buying the same consoles that their friends owned.\r\n\r\nThe cross-play trend reached a fever pitch in recent years as entities like Epic Games’  Fortnite developed massive user bases that gave developers exceptional influence over the deals they struck with platform owners.','players.jpg','Alexis Lemat','News');
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sqlite_sequence`
--

DROP TABLE IF EXISTS `sqlite_sequence`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sqlite_sequence` (
  `name` varchar(10) DEFAULT NULL,
  `seq` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sqlite_sequence`
--

LOCK TABLES `sqlite_sequence` WRITE;
/*!40000 ALTER TABLE `sqlite_sequence` DISABLE KEYS */;
INSERT INTO `sqlite_sequence` VALUES ('posts',60),('categories',21),('authors',14);
/*!40000 ALTER TABLE `sqlite_sequence` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-08-22 15:20:25
