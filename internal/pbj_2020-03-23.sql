# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: localhost (MySQL 5.7.26)
# Database: pbj
# Generation Time: 2020-03-23 17:18:32 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table departments
# ------------------------------------------------------------

DROP TABLE IF EXISTS `departments`;

CREATE TABLE `departments` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `deptname` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `departments` WRITE;
/*!40000 ALTER TABLE `departments` DISABLE KEYS */;

INSERT INTO `departments` (`id`, `deptname`)
VALUES
	(1,'Administration'),
	(2,'Call Centre'),
	(3,'IT'),
	(4,'Pharmacy');

/*!40000 ALTER TABLE `departments` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table employees
# ------------------------------------------------------------

DROP TABLE IF EXISTS `employees`;

CREATE TABLE `employees` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `emp_id` varchar(6) NOT NULL DEFAULT '',
  `emp_name` text NOT NULL,
  `emp_password` char(60) NOT NULL DEFAULT '',
  `emp_dept_id` int(11) unsigned DEFAULT NULL,
  `emp_role_id` int(11) unsigned NOT NULL,
  `emp_active` smallint(1) NOT NULL DEFAULT '1',
  `emp_username` varchar(20) NOT NULL DEFAULT '',
  `emp_avatar` text,
  `emp_bio` varchar(255) DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `emp_dept_id_fk` (`emp_dept_id`),
  KEY `emp_role_id_fk` (`emp_role_id`),
  KEY `emp_id` (`emp_id`),
  CONSTRAINT `emp_dept_id_fk` FOREIGN KEY (`emp_dept_id`) REFERENCES `departments` (`id`),
  CONSTRAINT `emp_role_id_fk` FOREIGN KEY (`emp_role_id`) REFERENCES `roles` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `employees` WRITE;
/*!40000 ALTER TABLE `employees` DISABLE KEYS */;

INSERT INTO `employees` (`id`, `emp_id`, `emp_name`, `emp_password`, `emp_dept_id`, `emp_role_id`, `emp_active`, `emp_username`, `emp_avatar`, `emp_bio`)
VALUES
	(10,'I12345','John Smith','$2y$10$grMWajp9n2yDcUnXljOY.OKft.ublTMxijENyId9uhlceS8ZTRUHu',3,2,1,'jsmith','internal/profile_img/I12345.jpg','Food maven. Beeraholic. Tv buff. Alcohol advocate. Freelance web expert. Music geek.'),
	(11,'P12345','Marvin Janssen','$2y$10$IojqU3YWRY2AD9GhSfl/6OV.CnIPdTm/TN12libPctV8tYqlYghn6',4,1,1,'mjanssen','internal/profile_img/default.jpg','Entrepreneur, The Planetary Society Benelux Outreach Coordinator, Dutch Red Cross volunteer. Co-founder of @DealSoHard & @Simpleco_in\n'),
	(12,'C12345','Payam Karimi','$2y$10$2xaYo81Lg3QEqh6DXFvOde7ne5YSnAUv0abWVAFIO7Ep2wQpIf5NO',2,1,1,'pkarimi','internal/profile_img/C12345.jpg','Alcohol nerd. Music practitioner. Twitter scholar. Travel aficionado. Extreme explorer. Food maven.\r\n\r\n'),
	(14,'A23456','Aaron Paul','$2y$10$sQxjSYZ7Uq5vZZanCRHEZu4XtFfQtgqLzOehDtO6/lSUM.3U2R7cy',1,2,1,'methcook','internal/profile_img/A23456.jpg','Unapologetic meth evangelist. Travel specialist. Food geek. Professional coffee scholar.'),
	(15,'A12345','Brent Perry','$2y$10$85LG.AnloiZICLXgrpld3uRVOe2dSVjAq2rT4z6xmhRgZePCMg1Ku',1,1,1,'perrywinkle','internal/profile_img/A12345.jpg','We can update this\r\n'),
	(16,'C23456','Alex Neuman','$2y$10$udzHunH2s.VGkpfcaI5LbOQwM7Kga6dNCSVPT4e7yaDPdDhyG06aW',2,2,1,'aneuman','internal/profile_img/C23456.jpg','Travel aficionado. Wannabe explorer. Music specialist. Organizer. Internet buff.'),
	(17,'I23456','Trevor Moore','$2y$10$VDdwgehBTYfs6WaWISDv/OiddpGxA6fHqNwucmyYS49CLNyBXesPW',3,2,1,'tmoore','internal/profile_img/default.jpg','Coffeeaholic. Troublemaker. Internet fanatic. Devoted pop culture nerd. Energy drink geek. Hardcore food buff. Typical twitter scholar. Writer.'),
	(18,'P23456','Julian Foreman','$2y$10$Ia4O9UlmW99nh6R.pEaB5.CT9IUSZ2pWsK3NntZ/34xExTOsV1GXe',4,1,1,'jforeman','internal/profile_img/default.jpg','Troublemaker. Food guru. Incurable musicaholic. Devoted internet enthusiast. Beer practitioner. Zombie ninja. Analyst. Infuriatingly humble tv aficionado.'),
	(23,'A34567','john smith','$2y$10$LjUNqJCPacxVH.mSMAGa5.X/U5UDo.TQ/3TcPN.tEdQ3v1TN5Upki',1,2,1,'johnsmith','internal/profile_img/default.jpg',NULL),
	(24,'p34567','David Karimi','$2y$10$/QwXyDN8mvvAx7jBcLNPMeABG7AZDm6D2LDB/0rCdQXNSzTBF0w32',4,2,1,'dpkarimi','internal/profile_img/default.jpg','');

/*!40000 ALTER TABLE `employees` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table events
# ------------------------------------------------------------

DROP TABLE IF EXISTS `events`;

CREATE TABLE `events` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `even_name` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `events` WRITE;
/*!40000 ALTER TABLE `events` DISABLE KEYS */;

INSERT INTO `events` (`id`, `even_name`)
VALUES
	(1,'Logged In'),
	(2,'Logged Out'),
	(3,'Post Created'),
	(4,'Post Deleted'),
	(5,'User Created'),
	(6,'User Deleted');

/*!40000 ALTER TABLE `events` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table eventslog
# ------------------------------------------------------------

DROP TABLE IF EXISTS `eventslog`;

CREATE TABLE `eventslog` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `event_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `event_id` int(11) unsigned NOT NULL,
  `emp_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `event_id_fk` (`event_id`),
  KEY `emp_id_fk` (`emp_id`),
  CONSTRAINT `emp_id_fk` FOREIGN KEY (`emp_id`) REFERENCES `employees` (`emp_dept_id`),
  CONSTRAINT `event_id_fk` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



# Dump of table existingid
# ------------------------------------------------------------

DROP TABLE IF EXISTS `existingid`;

CREATE TABLE `existingid` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `emp_id` varchar(6) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `existingid` WRITE;
/*!40000 ALTER TABLE `existingid` DISABLE KEYS */;

INSERT INTO `existingid` (`id`, `emp_id`)
VALUES
	(1,'A12345'),
	(3,'C12345'),
	(4,'I12345'),
	(5,'P12345'),
	(6,'P23456'),
	(7,'A23456'),
	(8,'I23456'),
	(9,'C23456'),
	(10,'A34567'),
	(11,'A45678'),
	(12,'A56789'),
	(13,'C34567'),
	(14,'C45678'),
	(15,'C56789'),
	(16,'I34567'),
	(17,'I45678'),
	(18,'I56789'),
	(19,'P34567'),
	(20,'P45678'),
	(21,'P56789');

/*!40000 ALTER TABLE `existingid` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table likes
# ------------------------------------------------------------

DROP TABLE IF EXISTS `likes`;

CREATE TABLE `likes` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `likes_emp_id` varchar(6) NOT NULL DEFAULT '',
  `likes_post_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `likes` WRITE;
/*!40000 ALTER TABLE `likes` DISABLE KEYS */;

INSERT INTO `likes` (`id`, `likes_emp_id`, `likes_post_id`)
VALUES
	(153,'C23456',13),
	(154,'C23456',14),
	(155,'C12345',13),
	(156,'C12345',79),
	(158,'C12345',77),
	(159,'C12345',75),
	(160,'C12345',28),
	(162,'C12345',26),
	(174,'C12345',25),
	(176,'C12345',117),
	(177,'C12345',118),
	(179,'C12345',15),
	(180,'C12345',78),
	(181,'I12345',262),
	(182,'I12345',261),
	(183,'I12345',81),
	(184,'I12345',265);

/*!40000 ALTER TABLE `likes` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table posts
# ------------------------------------------------------------

DROP TABLE IF EXISTS `posts`;

CREATE TABLE `posts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `post_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `post_text` varchar(255) NOT NULL DEFAULT '',
  `post_emp_id` varchar(6) NOT NULL DEFAULT '',
  `post_visible` binary(1) NOT NULL DEFAULT '1',
  `post_sticky` binary(1) NOT NULL DEFAULT '0',
  `post_likes` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `post_emp_id` (`post_emp_id`),
  CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`post_emp_id`) REFERENCES `employees` (`emp_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;

INSERT INTO `posts` (`id`, `post_timestamp`, `post_text`, `post_emp_id`, `post_visible`, `post_sticky`, `post_likes`)
VALUES
	(13,'2020-03-18 19:00:34','I will be making a public statement tomorrow at 12:00pm from the WhiteHouse to discuss our Country’s VICTORY on the Impeachment Hoax!','A23456',X'31',X'30',2),
	(14,'2020-03-18 19:00:45','He said he was not there yesterday; however, many people saw him there.','C23456',X'31',X'30',1),
	(15,'2020-03-18 02:45:42','He turned in the research paper on Friday; otherwise, he would have not passed the class.','C12345',X'31',X'30',1),
	(16,'2020-03-18 02:45:43','What Good Is Being An Outlaw When You Have Responsibilities? ','A23456',X'31',X'30',0),
	(17,'2020-03-18 02:45:44','Are We In The Meth Business, Or The Money Business?','A23456',X'31',X'30',0),
	(18,'2020-03-18 02:45:45','We Make Poison For People Who Don’t Care. We Probably Have The Most Un-Picky Customers In The World.','A23456',X'31',X'30',0),
	(19,'2020-03-18 02:45:46','Two more days and all his problems would be solved.','I12345',X'31',X'30',0),
	(20,'2020-03-18 02:45:47','Random words in front of other random words create a random sentence.','I23456',X'31',X'30',0),
	(21,'2020-03-18 02:45:48','Sometimes, all you need to do is completely make an ass of yourself and laugh it off to realise that life isn’t so bad after all.','C12345',X'31',X'30',0),
	(22,'2020-03-18 02:45:48','His seven-layer cake only had six layers.','C23456',X'31',X'30',0),
	(23,'2020-03-18 02:45:49','A song can make or ruin a person’s day if they let it get to them.','P12345',X'31',X'30',0),
	(24,'2020-03-18 02:45:50','Now I need to ponder my existence and ask myself if I\'m truly real.','P23456',X'31',X'30',0),
	(25,'2020-03-18 02:45:50','The unexamined life is not worth living.','A12345',X'31',X'30',1),
	(26,'2020-03-18 02:45:54','Whereof one cannot speak, thereof one must be silent.','A23456',X'31',X'30',1),
	(27,'2020-03-18 02:45:54','Entities should not be multiplied unnecessarily.','C12345',X'31',X'30',0),
	(28,'2020-03-18 02:45:55','He who thinks great thoughts, often makes great errors.','C23456',X'31',X'30',1),
	(75,'2020-03-18 02:45:56','Who knew that dog saliva can mend a broken heart?','P23456',X'31',X'30',1),
	(77,'2020-03-18 02:45:57','You better live your best and act your best and think your best today, for today is the sure preparation for tomorrow and all the other tomorrows that follow.','C23456',X'31',X'30',1),
	(78,'2020-03-18 14:57:41','If it turns out that there is a God, I don\'t think that he\'s evil. But the worst that you can say about him is that basically he\'s an underachiever.','C12345',X'31',X'30',1),
	(79,'2020-03-18 14:57:42','Any woman who thinks the way to a man\'s heart is through his stomach is aiming about 10 inches too high.','A23456',X'31',X'30',1),
	(80,'2020-02-26 23:22:49','Egotism is the anesthetic that dulls the pain of stupidity.','I12345',X'31',X'30',0),
	(81,'2020-02-26 23:23:48','Sometimes a good exit is all you can ask for.','C23456',X'31',X'30',1),
	(82,'2020-02-26 23:24:04','It doesn\'t make a difference what temperature a room is, it\'s always room temperature.','I12345',X'31',X'30',0),
	(86,'2020-02-26 23:27:05','Do you know what’s cool?\nWinter.','A23456',X'31',X'30',0),
	(87,'2020-02-26 23:27:33','Two hot dogs are walking down the street.\n-\nOne suddenly turns to the other and says, “Mike! Your wiener is showing!“','P23456',X'31',X'30',0),
	(88,'2020-02-26 23:28:13','What type of candy is always late?\n\nA chocoLATE.','A23456',X'31',X'30',0),
	(89,'2020-02-26 23:28:35','Which table fits in the fridge?\nVegeTABLE.','P12345',X'31',X'30',0),
	(92,'2020-02-26 23:29:31','Today, my son asked \"Can I have a book mark?\" and I burst into tears. 11 years old and he still doesn\'t know my name is Brian.','C23456',X'31',X'30',0),
	(93,'2020-02-26 23:30:23','If a child refuses to sleep during nap time, are they guilty of resisting a rest?','A12345',X'31',X'30',0),
	(94,'2020-02-26 23:30:51','I\'m reading a book about anti-gravity. It\'s impossible to put down!','A23456',X'31',X'30',0),
	(95,'2020-02-26 23:31:33','A slice of apple pie is $2.50 in Jamaica and $3.00 in the Bahamas. These are the pie rates of the Caribbean.','C12345',X'31',X'30',0),
	(98,'2020-02-26 23:33:03','What did the fish say when he hit a concrete wall?\n\"Dam\".','A12345',X'31',X'30',0),
	(100,'2020-02-26 23:34:36','What\'s the difference between roast beef and pea soup?\nAnyone can roast beef.','A23456',X'31',X'30',0),
	(101,'2020-02-26 23:39:01','Why don\'t blind people like to sky dive?\nBecause it scares the dog.','C23456',X'31',X'30',0),
	(103,'2020-02-26 23:39:22','What is the difference between a harley and a hoover?\nThe location of the dirt bag.','I23456',X'31',X'30',0),
	(104,'2020-02-26 23:39:43','Where do you get virgin wool from?\nUgly sheep.','A23456',X'31',X'30',0),
	(106,'2020-02-26 23:45:19','Why do bagpipers walk when they play?\nThey\'re trying to get away from the noise.','C23456',X'31',X'30',0),
	(107,'2020-02-26 23:48:44','A backward poet writes inverse.','A23456',X'31',X'30',0),
	(108,'2020-02-26 23:49:00','College is like a woman... You work so hard to get in, and nine months later you wish you\'d never come.','A23456',X'31',X'30',0),
	(109,'2020-02-26 23:49:24','Biology is the only science where multiplication means the same thing as division.','I23456',X'31',X'30',0),
	(110,'2020-02-26 23:50:07','She was only a whisky maker, but he loved her still.','C23456',X'31',X'30',0),
	(111,'2020-02-26 23:50:30','No matter how much you push the envelope, it’ll still be stationery.','A12345',X'31',X'30',0),
	(112,'2020-02-26 23:50:45','Two silk worms had a race. They ended up in a tie.','C23456',X'31',X'30',0),
	(113,'2020-02-26 23:52:15','Wear short sleeves! Support your right to bare arms!','A23456',X'31',X'30',0),
	(114,'2020-02-26 23:52:58','My wife really likes to make pottery, but to me it\'s just kiln time.','A23456',X'31',X'30',0),
	(115,'2020-02-26 23:53:31','Practice safe eating - always use condiments.','I12345',X'31',X'30',0),
	(116,'2020-02-26 23:54:09','Without geometry, life is pointless.\n','A23456',X'31',X'30',0),
	(117,'2020-02-26 23:54:50','Dreaming in color is no big deal. It\'s just a pigment of your imagination.','C23456',X'31',X'30',1),
	(118,'2020-02-26 23:55:04','Condoms should be used on every conceivable occasion.','I12345',X'31',X'30',1),
	(121,'2020-02-26 23:56:15','BREAKING: A two passenger Cessna 250 crashed into a large cemetery just outside of Warsaw. \nSo far, 367 bodies have been found and authorities indicate the count could rise as digging continues.','C23456',X'31',X'30',0),
	(122,'2020-02-26 23:57:54','Asked my iPhone, “surely I don’t need an umbrella today?”. Siri replied “yes, and don’t call me Shirley”. Turned out I had left Airplane mode on.','A23456',X'31',X'30',0),
	(124,'2020-02-26 23:59:52','Q: Whats the difference between a jet engine and a flight attendant? \nA: At the end of the flight the jet engine stops whining.','C23456',X'31',X'30',0),
	(128,'2020-02-27 00:01:02','Q: What\'s the difference between a fighter pilot and God? A: God doesn\'t think He\'s a fighter pilot.','I23456',X'31',X'30',0),
	(130,'2020-02-27 00:02:28','Q: What do you call a pregnant flight attendant? \nA: Pilot error.','A23456',X'31',X'30',0),
	(131,'2020-02-27 00:03:11','Q: What kind of chocolate do they sell at the airport? \nA: Plane Chocolate!','A23456',X'31',X'30',0),
	(132,'2020-02-27 00:04:30','Q: Can bees fly in the rain? \nA: Not without their little yellow jackets.','A23456',X'31',X'30',0),
	(205,'2020-03-04 08:58:44','What’s more amazing than a talking dog? A spelling bee.','A34567',X'31',X'30',0),
	(206,'2020-03-04 08:59:53','I was wondering why the baseball was getting bigger. Then it hit me.\r\n','A34567',X'31',X'30',0),
	(207,'2020-03-04 09:00:34','I\'m thinking of reasons to go to Switzerland. The flag is a big plus.\r\n','I12345',X'31',X'30',0),
	(208,'2020-03-04 09:01:20','Why can\'t you play poker on the African Savanna? There\'s too many cheetahs.\r\n','I12345',X'31',X'30',0),
	(209,'2020-03-04 09:01:30','I was up all night wondering where the sun went, but then it dawned on me.\r\n','I12345',X'31',X'30',0),
	(210,'2020-03-04 09:02:43','A plateau is the highest form of flattery.\r\n','A12345',X'31',X'30',0),
	(211,'2020-03-04 09:03:04','When my daughter told me to stop impersonating a flamingo, I had to put my foot down.\r\n','A12345',X'31',X'30',0),
	(212,'2020-03-04 09:03:20','Once you\'ve seen one shopping center, you\'ve seen the mall.\r\n','A12345',X'31',X'30',0),
	(213,'2020-03-09 01:34:03','Why are pirates called pirates?\r\nThey just arrrr!','A12345',X'31',X'30',0),
	(215,'2020-03-10 01:40:13','What do famous Youtubers use when they go fishing?\r\nClick Bait','A12345',X'31',X'30',0),
	(246,'2020-03-16 16:00:43','WOO I just did some PHP. I deserve a Potato.','A23456',X'31',X'30',0),
	(247,'2020-03-23 08:23:42','I want to die peacefully in my sleep, like my grandfather.. Not screaming and yelling like the passengers in his car.','C12345',X'31',X'30',0),
	(248,'2020-03-23 08:24:42','We never really grow up, we only learn how to act in public.\r\n\r\n','P23456',X'31',X'30',0),
	(249,'2020-03-23 08:25:04','Knowledge is knowing a tomato is a fruit; Wisdom is not putting it in a fruit salad.\r\n\r\n','P23456',X'31',X'30',0),
	(250,'2020-03-23 08:25:30','Going to church doesn’t make you a Christian any more than standing in a garage makes you a car.\r\n\r\n','I12345',X'31',X'30',0),
	(251,'2020-03-23 08:25:49','The early bird might get the worm, but the second mouse gets the cheese.','I12345',X'31',X'30',0),
	(252,'2020-03-23 08:26:04','Evening news is where they begin with ‘Good evening’, and then proceed to tell you why it isn’t.\r\n\r\n','I12345',X'31',X'30',0),
	(253,'2020-03-23 08:26:30','A bus station is where a bus stops. A train station is where a train stops. On my desk, I have a work station..','A12345',X'31',X'30',0),
	(254,'2020-03-23 08:26:55','How is it one careless match can start a forest fire, but it takes a whole box to start a campfire?','A12345',X'31',X'30',0),
	(255,'2020-03-23 08:27:26','I didn’t fight my way to the top of the food chain to be a vegetarian.','C23456',X'31',X'30',0),
	(256,'2020-03-23 08:27:57','Why does someone believe you when you say there are four billion stars, but check when you say the paint is wet?\r\n\r\n','C23456',X'31',X'30',0),
	(257,'2020-03-23 08:28:28','A clear conscience is usually the sign of a bad memory.','A12345',X'31',X'30',0),
	(258,'2020-03-23 08:28:44','I didn’t say it was your fault, I said I was blaming you.','A12345',X'31',X'30',0),
	(259,'2020-03-23 08:29:21','When I was a boy, I laid in my twin sized bed and wondered where my brother was.','A12345',X'31',X'30',0),
	(260,'2020-03-23 08:29:37','I think it’s wrong that only one company makes the game Monopoly.','A12345',X'31',X'30',0),
	(261,'2020-03-23 08:30:20','Artificial intelligence is no match for natural stupidity.\r\n\r\n','A23456',X'31',X'30',1),
	(262,'2020-03-23 08:30:27','Crowded elevators smell different to midgets.','A23456',X'31',X'30',1),
	(263,'2020-03-23 08:30:48','The sole purpose of a child’s middle name, is so he can tell when he’s really in trouble.\r\n\r\n','A23456',X'31',X'30',0),
	(264,'2020-03-23 08:30:57','You do not need a parachute to skydive. You only need a parachute to skydive twice.\r\n\r\n','A23456',X'31',X'30',0),
	(265,'2020-03-23 08:34:28','The unexamined life is not worth living.','P12345',X'31',X'30',1),
	(266,'2020-03-23 08:34:51','Whereof one cannot speak, thereof one must be silent.','P12345',X'31',X'30',0),
	(267,'2020-03-23 08:35:21','He who thinks great thoughts, often makes great errors.\r\n','P12345',X'31',X'30',0),
	(268,'2020-03-23 08:35:56','No man\'s knowledge here can go beyond his experience.','P12345',X'31',X'30',0),
	(269,'2020-03-23 08:36:27','Even while they teach, men learn.\r\n','P12345',X'31',X'30',0),
	(271,'2020-03-23 08:39:34','The shinbone is a device for finding furniture in a dark room.','I12345',X'31',X'30',0),
	(273,'2020-03-23 08:41:19','Science is what you know. Philosophy is what you don\'t know.','I12345',X'31',X'30',0),
	(274,'2020-03-23 08:42:32','Always borrow money from a pessimist. He won’t expect it back.','I12345',X'31',X'30',0),
	(275,'2020-03-23 08:42:44','My opinions may have changed, but not the fact that I am right.\r\n\r\n','I12345',X'31',X'30',0),
	(276,'2020-03-23 08:43:57','Some cause happiness wherever they go. Others whenever they go.\r\n\r\n','I12345',X'31',X'30',0);

/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table roles
# ------------------------------------------------------------

DROP TABLE IF EXISTS `roles`;

CREATE TABLE `roles` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `emp_role` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;

INSERT INTO `roles` (`id`, `emp_role`)
VALUES
	(1,'Admin'),
	(2,'User');

/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
