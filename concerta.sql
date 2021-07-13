-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 14, 2021 at 03:44 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `concerta`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `Admin_ID` int(2) NOT NULL,
  `Admin_Email` varchar(30) NOT NULL,
  `Admin_Password` varchar(200) NOT NULL,
  `Admin_Fname` varchar(100) NOT NULL,
  `Admin_Lname` varchar(100) NOT NULL,
  `Admin_Contact` varchar(13) NOT NULL,
  `Admin_Gender` varchar(1) NOT NULL,
  `Admin_imgDir` varchar(200) DEFAULT NULL,
  `Admin_PRI` int(1) NOT NULL DEFAULT 2,
  `Admin_Vkey` varchar(200) DEFAULT NULL,
  `Admin_Verify` int(1) NOT NULL DEFAULT 1,
  `Admin_unable` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`Admin_ID`, `Admin_Email`, `Admin_Password`, `Admin_Fname`, `Admin_Lname`, `Admin_Contact`, `Admin_Gender`, `Admin_imgDir`, `Admin_PRI`, `Admin_Vkey`, `Admin_Verify`, `Admin_unable`) VALUES
(2, 'kwang@gmail.com', '5a689c7d7bcbf9a2459b19b7b2bc11fb', 'Chee Seng', 'Kwang', '010 460 8744', 'M', NULL, 1, NULL, 1, 0),
(3, '1191200726@student.mmu.edu.my', 'ba8b68eeb41e2de030767863c837485c', 'Tian Hoe', 'Ng', '011 1522 1518', 'M', '../images/profile/team1_812_132_951.jpg', 1, '3e519560e28eecb25b46cf9eb49d77fe', 1, 0),
(5, 'lee.ym@gmail.com', 'ba8b68eeb41e2de030767863c837485c', 'Yan Muo', 'Lee', '012 377 6425', 'F', NULL, 2, NULL, 1, 0),
(8, 'kbys0901@gmail.com', 'ba8b68eeb41e2de030767863c837485c', 'Ng', 'Tian Hoe', '011 1522 1518', 'M', NULL, 1, NULL, 1, 0),
(9, 'tianhoe0901@gmail.com', 'ba8b68eeb41e2de030767863c837485c', 'Ng', 'Tian Hoe', '011 1522 1518', 'M', NULL, 2, NULL, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `Category_ID` int(2) NOT NULL,
  `Category_Name` varchar(30) NOT NULL,
  `Category_unable` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`Category_ID`, `Category_Name`, `Category_unable`) VALUES
(1, 'Mandopop', 0),
(2, 'K-Pop', 0),
(3, 'Anime', 0),
(4, 'R&B', 0),
(5, 'Pop Music', 0),
(6, 'Cantopop', 0),
(7, 'Instrumental', 0),
(9, 'JPop', 1);

-- --------------------------------------------------------

--
-- Table structure for table `concert`
--

CREATE TABLE `concert` (
  `Concert_ID` int(5) NOT NULL,
  `Concert_Name` varchar(100) NOT NULL,
  `Concert_StartDate` datetime NOT NULL,
  `Concert_Description` longtext DEFAULT NULL,
  `Session_StartDate` datetime NOT NULL,
  `Session_EndDate` datetime NOT NULL,
  `Concert_Ver_Image` varchar(200) NOT NULL,
  `Concert_Status` int(1) NOT NULL DEFAULT 0,
  `Concert_Unable` int(1) NOT NULL DEFAULT 0,
  `Singer_ID` int(5) DEFAULT NULL,
  `Merchandise_ID` int(3) DEFAULT NULL,
  `Venue_ID` int(2) DEFAULT NULL,
  `Organizer_ID` int(3) DEFAULT NULL,
  `Concert_Hor_Image` varchar(200) NOT NULL,
  `Seat_Image` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `concert`
--

INSERT INTO `concert` (`Concert_ID`, `Concert_Name`, `Concert_StartDate`, `Concert_Description`, `Session_StartDate`, `Session_EndDate`, `Concert_Ver_Image`, `Concert_Status`, `Concert_Unable`, `Singer_ID`, `Merchandise_ID`, `Venue_ID`, `Organizer_ID`, `Concert_Hor_Image`, `Seat_Image`) VALUES
(1, 'Weibird \"AT THIRTY\" World Tour 2021 Kuala Lumpur', '2021-03-20 19:30:00', '<p>&nbsp; &nbsp; Taiwanese singer-songwriter WeiBird, also known as Wei Li-an, will be making his highly-anticipated return to Kuala Lumpur, Malaysia, with a one-night only concert. Marking the 5th year since his last visit to the country, WeiBird will be stopping by Mega Star Arena Viva Mall on 20 March 2021 as part of his WEIBIRD &ldquo;AT THIRTY&rdquo; WORLD TOUR. This concert is set to revisit some of the significant milestones in WeiBird&rsquo;s decade-long career. Get ready for an exciting night full of classics and fan-favourites as the Mandopop singer shares his musical journey over a memorable selection of songs.</p>\n\n<p>&nbsp; &nbsp; 韦礼安最新巡演-韦礼安而立世界巡回演唱会将于2021年3月20日登陆马来西亚吉隆坡。此次巡回将在Mega Star Arena Viva Mall，成为韦礼安「而立」世界巡回演唱会系列东南亚地区的其中一站。 适逢出道十周年，而立之年的韦礼安在面对三十岁的时候也曾恐慌、迷茫想要逃避，是音乐给了他面对现实的勇气。此次演唱会的主题「而立」源自于他的全新单曲《而立》，除了记录自己寻找勇气，面对真实的自己的过程外，也希望通过音乐把这份力量传递给歌迷。</p>\n', '2021-03-08 00:01:00', '2021-03-20 23:59:00', '../images/concert/weibird_kl2_vertical.jpg', 1, 0, 1, NULL, 1, 1, '../images/concert/weibird_kl2.jpg', '../images/concert/weibird_seat.jpg'),
(2, 'Kenny G World Tour 2021 In Malaysia', '2021-03-22 20:30:00', '<p>&nbsp; &nbsp; Grammy Award-winning saxophone legend Kenny G will return to Malaysia for a one-night live performance at the Arena of Stars, Resorts World Genting! He has delivered stellar performances in Malaysia in 2012, 2015 and 2018 and all of his three shows have gathered boisterous applause and bravos by the audiences. And he often stays at the scene to give away autographs to fans after each of his performance, leaving lasting impression on audience. His return to Malaysia will promise to be a romantic and splendid music feast to Malaysian fans.</p>\n\n<p>&nbsp; &nbsp; The acclaimed saxophonist who has sold nearly 100 million albums worldwide has continued to fortify his position in the jazz music industry for more than three decades and has become a household name among saxophone players. He recently released a new piece &quot;Use This Gospel&quot; in collaboration with a popular American rapper, Kanye West, making him the fifth in history, among all musicians whose works have successfully entered the &quot;Billboard Hot 100 Top 40&quot; for four consecutive decades (1980 to 2010). Additionally, Kenny G was shortlisted for the Grammy Awards 16 times. In 1994, he won a Grammy Award for &ldquo;Best Instrumental Composition&rdquo; for the track &ldquo;Forever in Love,&rdquo; and collaborated with eminent musicians and singers oftentimes in music releases including the pop queens, Whitney Houston and Celine Dion.</p>\n\n<p>&nbsp; &nbsp; 国际&ldquo;萨克斯演奏家&rdquo;肯尼&bull;基（Kenny G） 宣布率领专属团队重返云顶云星剧场开办个人演奏会。 肯尼&middot;基在2012、2015和2018年皆在云顶爆棚演出，以超国际水准的现场实力征服乐迷，演出结束后，还留在现场逐一为乐迷献上亲笔签名，特别亲民毫无巨星架子. 近期大部分时间都在美国进行巡演的肯尼&middot;基，相隔15个月，将重返大马舞台演出，势必再次以他的独门音乐，为乐迷带来一场高水准又浪漫的音乐飨宴。</p>\n\n<p>&nbsp; &nbsp; 全球销售近亿张专辑的国际演奏家肯尼&middot;基，在过去三十多年内持续巩固在爵士音乐界的地位，更已是萨克斯风演奏家的代名词。他近期更跨刀与美国著名饶舌歌手坎耶&middot;韦斯特（Kenye West）合作推出新作品《Use This Gospel》，让肯尼成为史上第五位连续在四个年代内（1980&rsquo; 至2010&rsquo; ）皆有作品成功进入&ldquo;美国告示牌百大單曲榜 TOP 40&rdquo;（Billboard Hot 100 Top 40）的音乐人。 此外，肯尼&middot;基曾16度入围格莱美奖，在1994年凭着《Forever In Love》一曲成功荣获&ldquo;最佳演奏音乐作曲奖&rdquo;，更多次与知名音乐人以及歌手联手合作推出音乐，其中包括了国际乐坛天后惠特妮&middot;休斯顿（Whitney Houston）以及流行音乐天后席琳迪翁（Celine Dion）等。</p>\n', '2021-02-18 00:01:00', '2021-03-12 23:59:00', '../images/concert/kennyg_vertical.jpg', 2, 0, 7, NULL, 2, 2, '../images/concert/kennyg.jpg', '../images/concert/kennyg_seat.jpg'),
(9, 'Jam Hsiao Mr Entertainment World Tour KL Station', '2021-03-25 20:30:00', '<p>Dubbed as the &ldquo;King of Golden Melody,&rdquo; Mandapop singer Jam Hsiao is making his way to Malaysia for his &ldquo;Mr. Entertainment&rdquo; World Tour on 6 July 2019 at the Axiata Arena Bukit Jalil at 8pm.</p>\n\n<p>This new tour kicked off in May last year at the Taipei Arena and received overwhelming responses. It has since toured major cities including China, Singapore, Canada and the United States, among others.</p>\n\n<p>Jam has played a creative role in the tour production involving stage design and props, music arrangement and show choreography. Themed as &ldquo;Mr. Entertainment,&rdquo; the concert will deliver all-round experiences from visual to audio, featuring a state-of-the-art stage which resemblance a 3D musical theatre, symbolizing that everyone present is a guest of Mr. Entertainment.</p>\n\n<p>Interestingly, he has collaborated with famous fashion labels to produce extravagant outfits to enhance the overall stage presence. Apart from showcasing his musical prowess, Jam will present a stunning solo drum performance, endeavoring to deliver the best live music experience to his fans.</p>\n\n<p>Jam Hsiao, who shot to stardom in 2007 has released 4 new production albums and 2 cover albums. His masterpieces include &ldquo;Collection,&rdquo; &ldquo;New Endless Love,&rdquo; &ldquo;The Prince&rsquo;s New Clothes,&rdquo; &ldquo;Forgive Me,&rdquo; &ldquo;A Fei&rsquo;s Little Butterfly&rdquo; and so on.<br />\n&nbsp;</p>\n\n<p>&ldquo;金曲歌王&rdquo;萧敬腾确定7月6日，晚上8点，携带《娱乐先生》世界巡回演唱会, 登入吉隆坡Axiata Arena室内体育馆强势开唱！这是老萧霍别2009年的《洛克先生》巡演十年之久，再度登入万人体育馆开唱！</p>\n\n<p>《娱乐先生》世界巡演去年5月在台湾小巨蛋正式启动，一连两场演唱会门票一开售就被&ldquo;秒杀&rdquo;，场场爆满一票难求，而巡演目前已经走过中国、新加坡、美加等各大城市。</p>\n\n<p>演唱会以《娱乐先生》为主题，打造3D歌剧院场景，象征每位到场的人都是娱乐先生的嘉宾。老萧为了确保巡演皆可完美演出，还亲自操刀参与了演唱会制作，如舞台设计、音响、灯光、曲目与视觉效果等等。这次的演出服装也非常抢镜夺睛，集聚了许多国际级一线品牌的支持，萧敬腾在演唱会上还会展现高难度个人打鼓秀，只为了让&ldquo;萧帮&rdquo;粉丝们拥有物超所值的演唱会视听体验。</p>\n\n<p>2007年参加《超级星光大道》的萧敬腾成为了踢馆黑马，专辑《以爱之名》获得第24屈金曲奖最佳国语男歌手奖。他的代表作包括了《王妃》、《新不了情》、《王子的新衣》与《会痛的石头》等歌曲。近期的他除了开启了这轮演唱会之外，也刚结束拍摄电视剧《魂囚西门》，还推出了首部文字书《不一样》让粉丝们更了解萧敬腾的内心世界。</p>\n', '2021-03-10 00:01:00', '2021-03-20 23:59:00', '../images/concert/jamhsiao_vertical.jpg', 1, 0, 3, NULL, 1, 2, '../images/concert/jamhsiao.png', '../images/concert/jamhsiao_seat.jpg'),
(11, 'Jay Chou Carnival World Tour Kuala Lumpur', '2021-03-01 21:30:00', '<p>Starting his career as a songwriter and composer, Jay Chou debuted in 2000 and quickly became a favourite of both fans and critics. Celebrating 20 glorious years as the King of Mandopop, what kind of music world will Jay Chou take his fans into at this much awaited concert?<br />\n<br />\nFrom his recently released concert poster, fans had a glimpse of a &ldquo;Carnival&rdquo; concert, full of happy and memorable elements such as an amusement park in the background, ferris wheel, carousel, cowboy hat, sailor life buoy as well as Jay Chou&rsquo;s debut album &ldquo;Jay&rdquo; cover that won him the &ldquo;Best Album&rdquo; award at Taiwan&rsquo;s highly coveted Golden Melody Awards&hellip;<br />\n<br />\nAlways setting the trend, what surprises will Jay have in store for his fans celebrating this very special 20th year in music with him? Get yourself ready for this fashionable and splendid &ldquo;Carnival&rdquo; concert!</p>\n\n<p>周杰伦出道的20年，绝对是华语流行乐坛重要的20年！热闹缤纷的《嘉年华》演唱会主视觉曝光，热爱魔术的周杰伦手捧水晶球，加上摩天轮、旋转木马等游乐场景，还有他平地一声雷拿下台湾金曲最佳专辑的《Jay》封面，目不暇给的构图已在预告《嘉年华》演唱会将会送上超多惊喜！庆祝辉煌20年的时刻，周杰伦将带领粉丝进入他怎样的音乐世界呢？<br />\n<br />\n周杰伦《嘉年华》世界巡迴演唱会吉隆坡站！杰迷们请做好准备一起欢庆周杰伦迈向乐坛20年的盛大嘉年华。</p>\n', '2021-02-20 00:01:00', '2021-02-28 23:59:00', '../images/concert/jaychou_vertical_954.jpg', 3, 0, 9, NULL, 3, 3, '../images/concert/jaychou_335.png', '../images/concert/jaychou_seat_720.jpg'),
(12, 'Joey Yung The Tour Asia Genting Highlands', '2021-03-30 21:00:00', '<p>Malaysian fans are in for a treat as Hong Kong starlet, Joey Yung, returns to the Arena of Stars! Bringing with her a medley of greatest hits, fans can expect an evening serenaded by nostalgic love songs and ballads. The Canto-pop artist has recently completed a successful 19-show tour in Hong Kong, and currently holds the record for the longest chart-topping song at 23 weeks on the IFPI Hong Kong chart.</p>\n', '2021-03-02 00:01:00', '2021-03-14 23:59:00', '../images/concert/joeyyung_vertical_633.jpg', 2, 0, 8, NULL, 2, 4, '../images/concert/joeyyung_511.jpg', '../images/concert/joeyyung_seat_310.jpg'),
(15, 'Journey to the future', '2021-03-01 11:06:00', '', '2021-02-28 11:06:00', '2021-02-28 11:07:00', '../images/concert/shila_ver_490.jpg', 1, 0, 15, NULL, 3, 4, '../images/concert/shila_hor_967.jpg', '../images/concert/shila_seat_116.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `Cust_ID` int(4) NOT NULL,
  `Cust_Fname` varchar(50) NOT NULL,
  `Cust_Lname` varchar(50) NOT NULL,
  `Cust_Email` varchar(30) NOT NULL,
  `Cust_Password` varchar(200) NOT NULL,
  `Cust_Image` varchar(200) DEFAULT NULL,
  `Cust_Address` varchar(200) DEFAULT NULL,
  `Cust_Postcode` varchar(5) DEFAULT NULL,
  `Cust_State` varchar(30) DEFAULT NULL,
  `Cust_City` varchar(30) DEFAULT NULL,
  `Cust_Gender` varchar(1) NOT NULL,
  `Cust_Cont_Num` varchar(13) DEFAULT NULL,
  `vkey` varchar(45) NOT NULL,
  `verified` int(1) NOT NULL DEFAULT 0,
  `Cust_Ban_Status` int(1) NOT NULL DEFAULT 0,
  `Reset_Vkey` varchar(45) DEFAULT NULL,
  `Cust_RegisterDate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`Cust_ID`, `Cust_Fname`, `Cust_Lname`, `Cust_Email`, `Cust_Password`, `Cust_Image`, `Cust_Address`, `Cust_Postcode`, `Cust_State`, `Cust_City`, `Cust_Gender`, `Cust_Cont_Num`, `vkey`, `verified`, `Cust_Ban_Status`, `Reset_Vkey`, `Cust_RegisterDate`) VALUES
(6, 'Felicia', 'Lim', 'tianhoe0901@gmail.com', 'ba8b68eeb41e2de030767863c837485c', '../images/customer/th_402.jpg', 'No. 6, Jalan Pulai, Taman Desa Jaya, Parit Bakar', '84555', 'Johor', 'Muar', 'F', '012 453 6081', '36137c4d7a23ad2ba175fdf0d1ec951e', 1, 0, '774f9e1fe88d2873', '2021-02-25'),
(9, 'Chee Seng', 'Kwang', 'kwang1607ng@gmail.com', 'ba8b68eeb41e2de030767863c837485c', NULL, 'No. 92, Jalan Semala, Taman Rindu', '96000', 'Sarawak', 'Sibu', 'M', '013 445 8662', '47ec445281a45fc24611275ea875af27', 1, 0, '48518772d7e3553e', '2021-02-22'),
(26, 'Ng', 'Tian Hoe', 'hisham.fyp@yahoo.com', 'fbb034ae415dbdbf08406f286faa1470', '../images/customer/user_179.jpg', '18-3, Jalan Pulai, Taman Desa Jaya', '84000', 'Johor', 'Muar', 'M', '011 1522 1518', '6ed3cd4634becb9427d254cedc0e6e5e', 1, 0, NULL, '2021-03-03');

-- --------------------------------------------------------

--
-- Table structure for table `merchandise`
--

CREATE TABLE `merchandise` (
  `Merchandise_ID` int(3) NOT NULL,
  `Merchandise_Name` varchar(100) NOT NULL,
  `Merchandise_Price` float(5,2) NOT NULL,
  `Merchandise_ListPrice` float(5,2) NOT NULL,
  `Merchandise_Description` longtext DEFAULT NULL,
  `Merchandise_Stock` int(3) NOT NULL,
  `Merchandise_Weight` float(4,2) NOT NULL,
  `Merchandise_Image` varchar(200) DEFAULT NULL,
  `Merchandise_Status` int(1) NOT NULL,
  `Merchandise_unable` int(1) NOT NULL DEFAULT 0,
  `Concert_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `merchandise`
--

INSERT INTO `merchandise` (`Merchandise_ID`, `Merchandise_Name`, `Merchandise_Price`, `Merchandise_ListPrice`, `Merchandise_Description`, `Merchandise_Stock`, `Merchandise_Weight`, `Merchandise_Image`, `Merchandise_Status`, `Merchandise_unable`, `Concert_ID`) VALUES
(1, 'Weibird \"AT THIRTY\" T-Shirt', 115.00, 135.00, '<p>&nbsp;</p>\n\n<p>Wei Li-an specially designed exclusive merchandise for this Taipei station. The emotional of Wei bird can be freely matched to create a unique personal breath, which is definitely worth collecting.</p>\n\n<p>韋禮安特別為了此次台北站設計了專屬周邊商品，親繪韋鳥塗鴉<br />\n承載情感的韋鳥可自由搭配出個人獨特的氣息，絕對值得珍藏</p>\n', 997, 1.30, '../images/merchandise/weibird_2_881.jpg', 1, 0, 1),
(2, 'Weibird \"AT THIRTY\" messenger bag', 60.00, 70.00, '<p>Wei Li-an specially designed exclusive merchandise for this Taipei station. The emotional of Wei bird can be freely matched to create a unique personal breath, which is definitely worth collecting.</p>\n\n<p>韋禮安特別為了此次台北站設計了專屬周邊商品，親繪韋鳥塗鴉<br />\n承載情感的韋鳥可自由搭配出個人獨特的氣息，絕對值得珍藏</p>\n', 198, 3.00, '../images/merchandise/weibird_3_820.jpg', 1, 0, 1),
(3, 'Weibird \"AT THIRTY\" Music Box', 70.00, 80.00, '<p>Wei Li-an specially designed exclusive merchandise for this Taipei station. The emotional of Wei bird can be freely matched to create a unique personal breath, which is definitely worth collecting.</p>\n\n<p>韋禮安特別為了此次台北站設計了專屬周邊商品，親繪韋鳥塗鴉<br />\n承載情感的韋鳥可自由搭配出個人獨特的氣息，絕對值得珍藏</p>\n', 198, 2.00, '../images/merchandise/weibird_4_388.jpg', 1, 0, 1),
(4, 'Weibird \"AT THIRTY\" Notebook', 45.00, 50.00, '<p>Wei Li-an specially designed exclusive merchandise for this Taipei station. The emotional of Wei bird can be freely matched to create a unique personal breath, which is definitely worth collecting.</p>\n\n<p>韋禮安特別為了此次台北站設計了專屬周邊商品，親繪韋鳥塗鴉<br />\n承載情感的韋鳥可自由搭配出個人獨特的氣息，絕對值得珍藏</p>\n', 198, 2.00, '../images/merchandise/weibird_5_665.jpg', 1, 0, 1),
(6, 'Jam Hsiao Mr Entertainment - Face Mask', 20.00, 25.00, '<p>先生娛樂再生自己</p>\n', 187, 0.20, '../images/merchandise/jam_1_898.jpg', 1, 0, 9),
(7, 'Jam Hsiao Mr Entertainment hand band', 20.00, 25.00, '<p>先生娛樂再生自己</p>\n', 983, 0.10, '../images/merchandise/jam1_401.png', 1, 0, 9),
(8, 'Jam Hsiao Mr Entertainment Thermal Bottle', 45.00, 50.00, '<p>先生娛樂再生自己</p>\n', 193, 2.30, '../images/merchandise/jam2_284.png', 1, 0, 9),
(9, 'Jam Hsiao Mr Entertainment Hat', 125.00, 135.00, '<p>先生娛樂再生自己</p>\n', 90, 0.60, '../images/merchandise/jam3_701.png', 1, 0, 9),
(10, 'Jay Chou Carnival Face Mask', 5.90, 6.00, '', 783, 0.10, '../images/merchandise/jaychou_1_980.jpg', 1, 0, 11),
(11, 'Jay Chou Carnival (Pink) Crystal Ball', 105.00, 125.00, '', 93, 1.20, '../images/merchandise/jaychou_2_778.jpg', 1, 0, 11),
(12, 'Jay Chou Carnival (Gold) Crystal Ball', 105.00, 125.00, '', 92, 1.20, '../images/merchandise/jaychou_3_977.jpg', 1, 0, 11),
(13, 'Jay Chou Carnival Rotating Music Box', 289.00, 300.00, '', 5, 1.20, '../images/merchandise/jaychou_4_166.jpg', 1, 0, 11),
(15, 'Weibird guitar pick', 0.00, 65.00, '', 2, 0.20, '../images/merchandise/weibird_guitarpick_125.jpg', 1, 0, 15);

-- --------------------------------------------------------

--
-- Table structure for table `organizer`
--

CREATE TABLE `organizer` (
  `Organizer_ID` int(3) NOT NULL,
  `Organizer_Name` varchar(50) NOT NULL,
  `Organizer_Link` varchar(200) NOT NULL,
  `Organizer_unable` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `organizer`
--

INSERT INTO `organizer` (`Organizer_ID`, `Organizer_Name`, `Organizer_Link`, `Organizer_unable`) VALUES
(1, 'IMC Live Group (M) Sdn Bhd', 'http://imclive-group.com/', 1),
(2, 'STAR PLANET SDN BHD ', 'https://www.starplanet.com.my/', 0),
(3, 'G.H.Y Culture & Media Holding Co Ltd', 'https://ghyculturemedia.com', 0),
(4, 'Emperor Entertainment Group', 'https://eeg.zone/#/', 0);

-- --------------------------------------------------------

--
-- Table structure for table `purchase`
--

CREATE TABLE `purchase` (
  `Purchase_ID` int(5) NOT NULL,
  `Total_Price` float(7,2) NOT NULL,
  `Purchase_Date` datetime NOT NULL,
  `Card_Number` varchar(19) NOT NULL,
  `Card_Owner_Name` varchar(120) NOT NULL,
  `Card_Exp_Month` int(2) NOT NULL,
  `Card_Exp_Year` int(2) NOT NULL,
  `Card_CVV` int(3) NOT NULL,
  `Card_OTP` int(6) NOT NULL,
  `Card_verify` int(1) NOT NULL DEFAULT 0,
  `Purchase_Status` int(1) DEFAULT NULL,
  `Cust_ID` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `purchase`
--

INSERT INTO `purchase` (`Purchase_ID`, `Total_Price`, `Purchase_Date`, `Card_Number`, `Card_Owner_Name`, `Card_Exp_Month`, `Card_Exp_Year`, `Card_CVV`, `Card_OTP`, `Card_verify`, `Purchase_Status`, `Cust_ID`) VALUES
(142, 1684.00, '2021-02-21 11:52:52', '5344 6854 2115 3905', 'Sethumathavan A/L Balakrishnan', 2, 2024, 455, 898675, 1, NULL, 9),
(143, 129.00, '2021-02-22 20:32:54', '4356 8995 6122 7586', 'Sethumathavan A/L Balakrishnan', 2, 2022, 855, 108295, 1, 1, 9),
(144, 156.36, '2021-02-22 21:13:37', '5312 4689 7588 4261', 'Sethumathavan A/L Balakrishnan', 3, 2022, 476, 152273, 1, 1, 9),
(145, 537.31, '2021-02-23 12:00:45', '5421 3362 8845 7956', 'Sethumathavan A/L Balakrishnan', 4, 2023, 866, 986774, 1, 1, 9),
(146, 1081.46, '2021-02-23 15:21:30', '5334 6851 5975 9642', 'Sethumathavan A/L Balakrishnan', 3, 2023, 615, 142199, 1, 1, 9),
(154, 129.66, '2021-02-23 19:12:27', '4814 6735 3126 2345', 'Kwang Chee Seng', 3, 2023, 453, 230086, 1, 3, 9),
(155, 4390.00, '2021-02-23 19:14:17', '5346 8952 1568 2345', 'Kwang Chee Seng', 6, 2026, 425, 593935, 1, NULL, 6),
(157, 254.66, '2021-02-23 22:01:02', '5431 6524 3152 2345', 'Kwang Chee Seng', 2, 2022, 342, 485425, 0, NULL, 9),
(158, 143.06, '2021-02-23 22:16:28', '5461 5310 5412 2345', 'Kwang Chee Seng', 9, 2022, 422, 454488, 0, NULL, 9),
(161, 129.66, '2021-02-24 01:04:10', '4816 7534 1526 2345', 'Kwang Chee Seng', 1, 2023, 342, 337278, 0, NULL, 9),
(162, 69.66, '2021-02-24 01:19:16', '5473 5791 4826 2345', 'Kwang Chee Seng', 2, 2022, 231, 231270, 1, 3, 9),
(166, 79.66, '2021-02-24 23:39:17', '5413 2564 1428 2307', 'Kwang Chee Seng', 2, 2022, 213, 473315, 1, 2, 9),
(175, 1566.46, '2021-03-02 16:43:56', '4325 6152 7358 7924', 'Lim Felicia', 3, 2023, 432, 348287, 1, 3, 6),
(176, 1034.00, '2021-03-03 09:07:46', '4015 6159 4231 5648', 'Lim Felicia', 4, 2021, 432, 266574, 0, NULL, 6),
(179, 9999.99, '2021-03-03 10:48:24', '5142 2365 4852 0152', 'Ng Tian Hoe', 3, 2022, 243, 424763, 1, NULL, 26),
(180, 29.66, '2021-03-03 10:55:37', '5142 2653 4212 3205', 'Ng Tian Hoe', 4, 2022, 123, 891446, 1, 1, 26);

-- --------------------------------------------------------

--
-- Table structure for table `purchase_address`
--

CREATE TABLE `purchase_address` (
  `Purch_Address_ID` int(5) NOT NULL,
  `Purch_Address` longtext NOT NULL,
  `Purch_State` varchar(30) NOT NULL,
  `Purch_City` varchar(30) NOT NULL,
  `Purch_Postcode` varchar(5) NOT NULL,
  `Purchase_ID` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `purchase_address`
--

INSERT INTO `purchase_address` (`Purch_Address_ID`, `Purch_Address`, `Purch_State`, `Purch_City`, `Purch_Postcode`, `Purchase_ID`) VALUES
(39, 'No. 92, Jalan Semala, Taman Rindu', 'Sarawak', 'Sibu', '96000', 143),
(40, 'No. 92, Jalan Semala, Taman Rindu', 'Sarawak', 'Sibu', '96000', 144),
(41, 'No. 92, Jalan Semala, Taman Rindu', 'Sarawak', 'Sibu', '96000', 145),
(42, 'No. 92, Jalan Semala, Taman Rindu', 'Sarawak', 'Sibu', '96000', 146),
(43, 'Multimedia University, Cyberjaya Campus, Periaran Multimedia, 63100 Cyberjaya', 'Selangor', 'Cyberjaya', '63100', 154),
(44, 'No. 92, Jalan Semala, Taman Rindu', 'Sarawak', 'Sibu', '96000', 157),
(45, 'No. 92, Jalan Semala, Taman Rindu', 'Sarawak', 'Sibu', '96000', 158),
(48, 'No. 92, Jalan Semala, Taman Rindu', 'Sarawak', 'Sibu', '96000', 161),
(49, 'No. 92, Jalan Semala, Taman Rindu', 'Sarawak', 'Sibu', '96000', 162),
(50, 'Multimedia University, Melaka Campus, Jalan Ayer Keroh Lama, 75450 Melaka.', 'Melaka', 'Ayer Keroh', '75450', 166),
(54, 'No. 6, Jalan Pulai, Taman Desa Jaya, Parit Bakar', 'Johor', 'Muar', '84555', 175),
(56, '18-3, Jalan Pulai, Taman Desa Jaya', 'Johor', 'Muar', '84000', 180);

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE `rating` (
  `Rating_ID` int(4) NOT NULL,
  `Rating_Star` int(1) NOT NULL,
  `Rating_Comment` longtext DEFAULT NULL,
  `Rating_Image` longtext DEFAULT NULL,
  `Cust_ID` int(4) NOT NULL,
  `S_Merchandise_ID` int(4) DEFAULT NULL,
  `Ticket_Purchase_ID` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rating`
--

INSERT INTO `rating` (`Rating_ID`, `Rating_Star`, `Rating_Comment`, `Rating_Image`, `Cust_ID`, `S_Merchandise_ID`, `Ticket_Purchase_ID`) VALUES
(8, 5, 'I love Jay Chou!! The night was so fun <3', '../images/rating/ticket_rating/comment_200.jpg', 9, NULL, 155),
(9, 5, 'I love it!', '../images/rating/merch_rating/comment_121.jpg', 6, 140, NULL),
(10, 4, '', NULL, 6, 141, NULL),
(11, 4, '', NULL, 6, 142, NULL),
(12, 5, '', NULL, 6, 143, NULL),
(13, 1, 'Bad product', NULL, 9, 121, NULL),
(14, 1, '', NULL, 9, 122, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `singer`
--

CREATE TABLE `singer` (
  `Singer_ID` int(5) NOT NULL,
  `Singer_Name` varchar(30) NOT NULL,
  `Singer_Desc` longtext DEFAULT NULL,
  `Singer_Image` varchar(200) DEFAULT NULL,
  `Singer_unable` int(1) NOT NULL DEFAULT 0,
  `Category_ID` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `singer`
--

INSERT INTO `singer` (`Singer_ID`, `Singer_Name`, `Singer_Desc`, `Singer_Image`, `Singer_unable`, `Category_ID`) VALUES
(1, 'Wei Li-an', '<p>Wei Li-an (Chinese: 韋禮安; pinyin: W&eacute;i lǐ-ān; born 5 March 1987) is a Taiwanese Mandopop and folk-rock singer-songwriter. He gained media attention as the winner of the first season of the reality television singing competition Happy Sunday in 2007. After signing a contract with Linfair Records, Wei released his debut EP Slowly Wait in 2009. The following year, Wei released his eponymous debut album William Wei. He received 4 nominations at the 22nd Golden Melody Awards and subsequently won Best New Artist. Wei released his second studio album Someone Is Waiting in 2012 and his third studio album Journey into The Night in 2014. On 12 September 2015, Wei held his concert, &quot;Free That Girl&quot;, at the Taipei Arena for the very first time. Wei released his fourth studio album It All Started From An Intro in 2016 and his fifth studio album Sounds of My Life in 2020.</p>\n', '../images/singer/weibird1_349_829.jpg', 0, 1),
(2, 'Aimer', '<p>Aimer (エメ, Eme, [eme]) is a Japanese pop singer and lyricist signed to SME Records and managed by FOURseam. Her name comes from the verb &quot;Aimer&quot; in French, which means &quot;to love&quot;. Her father was the bassist of a band, so Aimer grew up surrounded by music from a very young age. She began studying the piano in elementary school and highly looked up to Ringo Sheena and Utada Hikaru. In junior high school, listening to Avril Lavigne inspired her to take up guitar and began writing English lyrics. At the age of 15, Aimer lost her voice due to over-usage of her vocal cords and was forced to undergo silence therapy for treatment. However, that did not stop her, and after she recovered, she acquired her distinctive husky voice.</p>\n', '../images/singer/aimer.png', 0, 3),
(3, 'Jam Hsiao', 'Jam Hsiao (traditional Chinese: 蕭敬騰; simplified Chinese: 萧敬腾; pinyin: Xiāo Jìngténg; Wade–Giles: Hsiao1 Ching4-t\'êng2, born 30 March 1987) is a Taiwanese singer and actor. At the age of 17, while still in high school, he began working as a restaurant singer. In May 2007, Hsiao took part in the first season of China Television (CTV)\'s star search show, One Million Star. He signed a contract with Warner Music Taiwan in 2008 and released his debut album, Jam Hsiao, in the same year.\r\n\r\nIn 2011, Hsiao played the lead role in the action film The Killer Who Never Kills and won the Hong Kong Film Award for Best New Performer for his performance. In 2013, his fourth album It\'s All About Love won him Best Male Vocalist at 24th Golden Melody Awards.\r\n\r\nIn 2015, he formed a four-man band called Lion as singer-songwriter and keyboarder of the band, and they participated in Singer 2017 and got third. Hsiao later returned three years later on Singer 2020 as a solo singer, where he finished third.\r\n\r\nHsiao was born to a father of Han Chinese descent and native Amis aboriginal mother. He was a delinquent since primary school, having already tried smoking in 3rd grade, and was involved in a brawl at 14. His interest in music started when he found Bon Jovi\'s Crush album, but it was until he was 15 when he briefly had drum lessons until he had to self-teach in which he became a drum teacher in less than a year, then taught himself to play many instruments, including guitar and keyboards without the ability to read sheet music.', '../images/singer/hsiao.jpg', 0, 1),
(4, 'Ailee', '<p><strong>Amy Lee</strong> (born May 30, 1989), known professionally as Ailee, is a Korean-American singer and songwriter based in South Korea. Amassing digital sales success in South Korea, she has released two studio albums, five extended plays, twenty one singles, six of which charted within the top five of the Gaon Digital Chart. Following a short stint at Muzo Entertainment in New York City, she moved to South Korea in 2010, signing to <strong>YMC Entertainment</strong>.</p>\n\n<p>Ailee debuted in 2012 with her first single &quot;Heaven&quot;, peaking at number three on Gaon and earned her Best New Artist Awards at <em>Melon Music Awards, Golden Disc Awards, Gaon Chart K-Pop Awards</em> and the Seoul Music Awards. Through the years, she has won four Mnet Asian Music Award for Best Female Vocal Performance titles from &quot;U&amp;I&quot; in 2013, &quot;Singing Got Better&quot; in 2014, &quot;Mind Your Own Business&quot; in 2015, to &quot;If You&quot; in 2016. Her OST, &quot;I Will Go to You Like the First Snow&quot; released in 2017 won various awards and was the most digitally successful song of that year, becoming the best selling record in movies and dramas in the Korean sound record market.</p>\n', '../images/singer/ailee.jpg', 0, 2),
(5, 'Beyoncé', 'Beyoncé Giselle Knowles-Carter (/biːˈjɒnseɪ/ bee-YON-say; née Knowles; born September 4, 1981) is an American singer, actress and record producer. Born and raised in Houston, Texas, Beyoncé performed in various singing and dancing competitions as a child. She rose to fame in the late 1990s as the lead singer of Destiny\'s Child, one of the best-selling girl groups of all time. Beyoncé is often cited as an influence by other artists.\r\n\r\nDuring Destiny\'s Child\'s hiatus, Beyoncé made her theatrical film debut with a role in the US box-office number-one Austin Powers in Goldmember (2002) and began her solo music career. She became the first music act to debut at number one with their first six solo studio albums on the Billboard 200. Her debut album Dangerously in Love (2003) featured four Billboard Hot 100 top five songs, including the number-one singles \"Crazy in Love\" featuring rapper Jay-Z and \"Baby Boy\" featuring singer-rapper Sean Paul. Following the disbandment of Destiny\'s Child in 2006, she released her second solo album, B\'Day, which contained her first US number-one solo single \"Irreplaceable\", and \"Beautiful Liar\", which topped the charts in most countries. Beyoncé continued her acting career with starring roles in The Pink Panther (2006), Dreamgirls (2006), and Obsessed (2009). Her marriage to Jay-Z and her portrayal of Etta James in Cadillac Records (2008) influenced her third album, I Am... Sasha Fierce (2008), which earned a record-setting six Grammy Awards in 2010. It spawned the UK number-one single \"If I Were a Boy\", the US number-one single \"Single Ladies (Put a Ring on It)\" and the top five single \"Halo\".\r\n\r\nAfter splitting from her manager and father Mathew Knowles in 2010, Beyoncé released the album 4 (2011); it was influenced by 1970s funk, 1980s pop, and 1990s soul. She achieved back-to-back widespread critical acclaim for her sonically experimental visual albums, Beyoncé (2013) and Lemonade (2016); the latter was the world\'s best-selling album of 2016 and the most acclaimed album of her career, exploring themes of infidelity and womanism. In 2018, she released Everything Is Love, a collaborative album with her husband, Jay-Z, as the Carters. As a featured artist, Beyoncé topped the Billboard Hot 100 with the remixes of \"Perfect\" by Ed Sheeran in 2017 and \"Savage\" by Megan Thee Stallion in 2020. The same year, she released the musical film and visual album Black Is King to widespread critical acclaim.\r\n\r\nBeyoncé is one of the world\'s best-selling recording artists, having sold 118 million records worldwide. Her success during the 2000s was recognized with the Recording Industry Association of America\'s Top Certified Artist of the Decade, as well as Billboard magazine\'s Top Radio Songs Artist and the Top Female Artist of the Decade. Beyoncé is the most nominated woman at the Grammy Awards and has the second-most wins for a woman with a total of 24. She is also the most awarded artist at the MTV Video Music Awards, with 24 wins, including the Michael Jackson Video Vanguard Award. In 2014, she became the highest-earning Black musician in history and was listed among Time\'s 100 most influential people in the world for a second year in a row. Forbes ranked her as the most powerful female in entertainment on their 2015 and 2017 lists. She occupied the sixth place for Time\'s Person of the Year in 2016, and in 2020, was named one of the 100 women who defined the last century by the same publication. Beyoncé was also included on Encyclopædia Britannica\'s 100 Women list in 2019, for her contributions to the entertainment industry.', '../images/singer/beyonce1.jpg', 0, 4),
(6, 'LiSA', 'Risa Oribe (織部 里沙, Oribe Risa, born June 24, 1987), better known by her stage name LiSA, is a Japanese singer, songwriter and lyricist from Seki, Gifu, signed to Sacra Music under Sony Music Artists.\r\n\r\nAfter aspiring to become a musician early in life, she started her musical career as the vocalist of the indie band Chucky. Following Chucky\'s disbandment in 2005, LiSA moved to Tokyo to pursue a solo career, making her major debut in 2010 singing songs for the anime television series Angel Beats! as one of two vocalists for the fictional band Girls Dead Monster. In April 2011, she made her solo debut with the release of her mini-album Letters to U. She performed at Animelo Summer Live in August 2010, Anime Expo in 2012, and is a regular guest at Anime Festival Asia.\r\n\r\nLiSA\'s songs have been featured as theme music for various anime such as Fate/Zero, Sword Art Online and Demon Slayer: Kimetsu no Yaiba. Her singles have regularly been in the top ten of the Oricon weekly charts, with \"Crossing Field\" being certified platinum by the Recording Industry Association of Japan and \"Oath Sign\" being certified gold. She performed at the Nippon Budokan in 2014 and 2015. In 2015, she made her acting debut as Madge Nelson in the Japanese dub of the animated film Minions.', '../images/singer/lisa1.jpg', 0, 3),
(7, 'Kenny G', 'Kenneth Bruce Gorelick (born June 5, 1956), known professionally as Kenny G is an American jazz saxophonist. His 1986 album, Duotones brought him commercial success. Kenny G is one of the best-selling artists of all time, with global sales totaling more than 75 million records.\r\n\r\nKenny G was born in Seattle. His mother was from Saskatchewan, Canada. He came into contact with the saxophone when he heard a performance on The Ed Sullivan Show. He started playing saxophone, a Buffet Crampon alto in 1966 when he was 10 years old.\r\n\r\nKenny G attended Whitworth Elementary School, Sharples Junior High School, Franklin High School, and the University of Washington, all in his home city of Seattle. When he entered high school he failed at his first attempt to get into the jazz band but auditioned again the following year and earned first chair. His Franklin High School classmate Robert Damper (piano, keyboards) plays in his band. In addition to his studies while in high school, he took private lessons on the saxophone and clarinet from Johnny Jessen, once a week for a year.\r\n\r\nHe was also on his high school golf team. He has been a fan of the sport since his elder brother, Brian Gorelick, introduced him to it when he was ten.', '../images/singer/kenny_g.jpg', 0, 7),
(8, 'Joey Yung', 'Joey Yung (Chinese: 容祖兒; Jyutping: Jung4 Zou2 Ji4; born 16 June 1980) is a Hong Kong singer and actress signed to Emperor Entertainment Group.\r\n\r\nSince her debut in 1996, Yung has won numerous awards, including the prestigious JSG \'Most Popular Female Singer\' and \'Ultimate Best Female Singer – Gold\' awards a record-breaking nine times. She was ranked 63rd on the 2014 Forbes China Celebrity 100, making her the most influential Hong Kong-based female singer that year. In 2014, she reportedly earned HK$80 million (US$10.3 million).\r\n\r\nJoey Yung was born on 16 June 1980 in Hong Kong. She attended Ma On Shan Lutheran Primary School, where she was sixth-grade classmates with Wong Cho-lam. Hong Kong actress Priscilla Wong also attended the same school.\r\n\r\nAt the age of fifteen, Yung competed in the Big Echo Karaoke Singing Contest, and was subsequently signed by Go East Entertainment Co., Ltd. As an artist under Go East, she recorded the song \"The First Time I Want to be Drunk\" as a theme song for a film, but did not gain much recognition and was dropped by the label not long after.\r\n\r\nShe continued to attend school while working as a clerk and helping her mother to manage a fashion boutique. Later, an ex-colleague from Go East introduced her to Pony Canyon. However, not long after she joined the company, Pony Canyon shut down its Hong Kong branch and her musical career was again cut short.', '../images/singer/joey_yung1.jpg', 0, 6),
(9, 'Jay Chou', 'Jay Chou (simplified Chinese: 周杰伦; traditional Chinese: 周杰倫; pinyin: Zhōu Jiélún; born 18 January 1979) is a Taiwanese singer, songwriter, rapper, record producer, actor, film director, businessman and magician. Dubbed the \"King of Mandopop\", and having sold more than 30 million albums, Chou is one of the best-selling artists in Mainland China and is known for his work with lyricist Vincent Fang, who he has frequently collaborated with on his music.\r\n\r\nIn 2000, Chou released his debut studio album, Jay (2000), under the record company Alfa Music to moderate success. Chou rose to fame with the release of his second studio album, Fantasy (2001), which combined Western and Eastern music styles. The album won five Golden Melody Awards, including Album of the Year. He has since further released twelve more studio albums, spawning a string of hit singles and gaining significant prominence in Asian communities around the world. Chou has embarked on six world tours, performing in cities around the world to more than 10 million spectators as of 2019.\r\n\r\nIn 2007, Chou established his own record and management company JVR Music. Outside of music, Chou has served as the President of his own fashion brand PHANTACi since 2006. As an actor, Chou made his acting debut in the film Initial D (2005), followed shortly by a starring role in the epic Curse of the Golden Flower (2006). He has since starred in a number of movies, becoming known to Western audiences when he made his Hollywood debut in 2011 with The Green Hornet, starring alongside Seth Rogen and Christoph Waltz, followed by Now You See Me 2 (2016).', '../images/singer/jay_chou1.jpg', 0, 1),
(10, 'Taylor Swift', 'Taylor Alison Swift (born December 13, 1989) is an American singer-songwriter. Her narrative songwriting, which often centers around her personal life, has received widespread critical plaudits and media coverage.\r\n\r\nBorn in West Reading, Pennsylvania, Swift relocated to Nashville, Tennessee in 2004 to pursue a career in country music. Her 2006 eponymous debut studio album was the longest-charting album of the 2000s on the US Billboard 200. Its third single, \"Our Song\", made her the youngest person to single-handedly write and sing a number-one song on the US Billboard Hot Country Songs chart. Swift\'s second studio album, Fearless (2008), expands on country pop styles and won the Grammy Award for Album of the Year. Buoyed by the success of crossover singles \"Love Story\" and \"You Belong with Me\", Fearless was certified Diamond by the Recording Industry Association of America (RIAA). Speak Now (2010), her third studio album, blends country pop with rock sensibility and spawned the top-10 singles \"Mine\" and \"Back to December\". Her fourth studio album, Red (2012), experiments with various pop, rock, and electronic genres. It included the top-five singles \"We Are Never Ever Getting Back Together\", her first US Billboard Hot 100 number-one song, and \"I Knew You Were Trouble\".\r\n\r\nWith her fifth studio album, 1989 (2014), Swift announced her full transition to pop. The synth-pop record made Swift the first female solo artist to win the Grammy Award for Album of the Year twice and amassed three Billboard Hot 100 number-one hits—\"Shake It Off\", \"Blank Space\", and \"Bad Blood\". She extended the electronic-pop sound on her next two studio albums: Reputation (2017), which incorporates elements of hip hop and featured the Billboard Hot 100 number-one single \"Look What You Made Me Do\", and Lover (2019), the world\'s best-selling studio album of 2019. Swift\'s next two studio albums, Folklore and Evermore (both released in 2020), explore alternative rock and folk genres. Their respective lead singles \"Cardigan\" and \"Willow\" made her the first act to simultaneously debut atop the Billboard 200 and Hot 100 twice.\r\n\r\nWith sales of over 200 million records worldwide, Swift is one of the best-selling music artists of all time. Her accolades include 10 Grammy Awards, an Emmy Award, seven Guinness World Records, 32 American Music Awards (the most wins by an artist), and 23 Billboard Music Awards (the most wins by a woman). She ranked eighth on Billboard\'s Greatest of All Time Artists Chart and, as a songwriter, was recognized in Rolling Stone\'s 100 Greatest Songwriters of All Time (2015). Swift has been included in various power rankings, such as Time\'s annual list of the 100 most influential people in the world (2010, 2015 and 2019) and Forbes Celebrity 100 (placing first in 2016 and 2019). She was named Woman of the Decade (2010s) by Billboard and Artist of the Decade (2010s) by the American Music Awards, and two of her albums featured in Rolling Stone\'s 500 Greatest Albums of All Time (2020).', '../images/singer/taylor_swift1.jpg', 0, 5),
(15, 'Shila Amzah', '', '../images/singer/shila_907.jpg', 0, 5);

-- --------------------------------------------------------

--
-- Table structure for table `s_merchandise`
--

CREATE TABLE `s_merchandise` (
  `S_Merchandise_ID` int(4) NOT NULL,
  `S_Merchandise_Qty` int(2) NOT NULL,
  `Purchase_ID` int(5) DEFAULT NULL,
  `Merchandise_ID` int(3) NOT NULL,
  `Cust_ID` int(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `s_merchandise`
--

INSERT INTO `s_merchandise` (`S_Merchandise_ID`, `S_Merchandise_Qty`, `Purchase_ID`, `Merchandise_ID`, `Cust_ID`) VALUES
(93, 2, 143, 9, 9),
(94, 2, 144, 8, 9),
(95, 3, 144, 7, 9),
(97, 1, 145, 4, 9),
(98, 1, 145, 3, 9),
(99, 2, 145, 1, 9),
(100, 1, 145, 2, 9),
(101, 1, 146, 11, 9),
(102, 1, 146, 7, 9),
(103, 2, 146, 9, 9),
(104, 1, 146, 8, 9),
(105, 1, 146, 6, 9),
(106, 1, 146, 12, 9),
(107, 1, 146, 13, 9),
(108, 1, 146, 10, 9),
(109, 1, 146, 2, 9),
(111, 1, 146, 3, 9),
(112, 1, 146, 4, 9),
(113, 1, 146, 1, 9),
(114, 2, 154, 9, 9),
(115, 2, 157, 9, 9),
(117, 3, 158, 8, 9),
(120, 1, 161, 9, 9),
(121, 1, 162, 7, 9),
(122, 1, 162, 8, 9),
(124, 1, 166, 7, 9),
(125, 2, 166, 6, 9),
(126, 1, NULL, 9, 9),
(137, 10, 174, 6, 18),
(138, 2, 174, 9, 18),
(140, 2, 175, 11, 6),
(141, 5, 175, 10, 6),
(142, 3, 175, 13, 6),
(143, 3, 175, 12, 6),
(146, 1, 180, 7, 26);

-- --------------------------------------------------------

--
-- Table structure for table `s_ticket`
--

CREATE TABLE `s_ticket` (
  `S_Ticket_ID` int(4) NOT NULL,
  `S_Ticket_Qty` int(2) NOT NULL,
  `Purchase_ID` int(5) DEFAULT NULL,
  `PriceID` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `s_ticket`
--

INSERT INTO `s_ticket` (`S_Ticket_ID`, `S_Ticket_Qty`, `Purchase_ID`, `PriceID`) VALUES
(92, 2, NULL, 6),
(93, 2, NULL, 7),
(94, 2, 142, 6),
(95, 1, 142, 7),
(96, 2, NULL, 35),
(97, 3, 155, 28),
(98, 1, 155, 29),
(99, 1, 155, 30),
(100, 4, NULL, 35),
(109, 2, NULL, 7),
(110, 1, NULL, 8),
(111, 2, 176, 8),
(112, 1, 176, 9),
(115, 6, 179, 6),
(116, 6, 179, 7),
(117, 6, 179, 8),
(118, 6, 179, 9);

-- --------------------------------------------------------

--
-- Table structure for table `ticket_price`
--

CREATE TABLE `ticket_price` (
  `Price_ID` int(2) NOT NULL,
  `Price_Area` varchar(20) NOT NULL,
  `Price` float(6,2) NOT NULL,
  `Seat_No` int(4) NOT NULL,
  `ticket_price_unable` int(1) NOT NULL DEFAULT 0,
  `Venue_ID` int(2) NOT NULL,
  `Concert_ID` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ticket_price`
--

INSERT INTO `ticket_price` (`Price_ID`, `Price_Area`, `Price`, `Seat_No`, `ticket_price_unable`, `Venue_ID`, `Concert_ID`) VALUES
(1, 'VIP', 488.00, 100, 0, 1, 1),
(2, 'CAT1', 388.00, 800, 0, 1, 1),
(3, 'CAT2', 288.00, 400, 0, 1, 1),
(4, 'CAT3', 188.00, 400, 0, 1, 1),
(5, 'CAT4', 98.00, 200, 0, 1, 1),
(6, 'VIP', 598.00, 150, 0, 2, 2),
(7, 'PS1', 488.00, 250, 0, 2, 2),
(8, 'PS2', 378.00, 400, 0, 2, 2),
(9, 'PS3', 278.00, 250, 0, 2, 2),
(10, 'PS4', 178.00, 150, 0, 2, 2),
(28, 'CAT1', 938.00, 200, 0, 3, 11),
(29, 'CAT2', 838.00, 200, 0, 3, 11),
(30, 'CAT3', 738.00, 400, 0, 3, 11),
(31, 'CAT4', 588.00, 400, 0, 3, 11),
(32, 'CAT5', 488.00, 400, 0, 3, 11),
(33, 'CAT6', 388.00, 500, 0, 3, 11),
(34, 'CAT7', 288.00, 500, 0, 3, 11),
(35, 'VIP', 986.00, 200, 0, 2, 12),
(36, 'PS1', 726.00, 150, 0, 2, 12),
(37, 'PS2', 476.00, 350, 0, 2, 12),
(38, 'PS3', 286.00, 400, 0, 2, 12),
(39, 'VVIP', 828.00, 100, 0, 1, 9),
(40, 'VIP', 698.00, 200, 0, 1, 9),
(41, 'CAT1', 588.00, 150, 0, 1, 9),
(42, 'CAT2', 488.00, 150, 0, 1, 9),
(43, 'CAT3', 388.00, 300, 0, 1, 9),
(44, 'CAT4', 258.00, 100, 0, 1, 9),
(47, 'MEET & GREET', 798.00, 0, 0, 3, 15);

-- --------------------------------------------------------

--
-- Table structure for table `venue`
--

CREATE TABLE `venue` (
  `Venue_ID` int(2) NOT NULL,
  `Venue_Name` varchar(50) NOT NULL,
  `Venue_State` varchar(20) NOT NULL,
  `Venue_Image` varchar(200) NOT NULL,
  `Venue_iframe` longtext NOT NULL,
  `Venue_Location` longtext NOT NULL,
  `Venue_Unable` int(1) NOT NULL DEFAULT 0,
  `Venue_Description` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `venue`
--

INSERT INTO `venue` (`Venue_ID`, `Venue_Name`, `Venue_State`, `Venue_Image`, `Venue_iframe`, `Venue_Location`, `Venue_Unable`, `Venue_Description`) VALUES
(1, 'Mega Star Arena, VIVA Mall, Kuala Lumpur', 'Kuala Lumpur', '../images/venue/mega_star_arena_326.jpg', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3983.89271367711!2d101.71727341475732!3d3.1230665977259005!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31cc4a154eff332f%3A0x82657f2bc1c3386d!2sMega%20Star%20Arena!5e0!3m2!1sen!2smy!4v1610264601855!5m2!1sen!2smy', 'https://goo.gl/maps/fnoh9VsCRneJw3SMA', 0, '<p>Mega Star Arena is located in <strong>Viva Shopping Mall</strong>, one of the largest malls in Malaysia dedicated to home products and services; complemented by a range of F&amp;B, lifestyle and entertainment outlets.</p>\n\n<p>Viva Shopping Mall fronts onto Jalan Loke Yew, one of Kuala Lumpur&rsquo;s major arteries and busiest roadways.</p>\n'),
(2, 'Arena of Stars, Resorts World Genting', 'Pahang', '../images/venue/arena_of_stars.jpg', 'https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15930.807402367218!2d101.7940234!3d3.4226142!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x4b3af085b8b19ca9!2sArena%20Of%20Stars!5e0!3m2!1sen!2smy!4v1610265797110!5m2!1sen!2smy', 'https://goo.gl/maps/2g2v6KQ2WaXFFw8r7', 0, '<p>Arena of Stars is a 45,000 square feet musical amphitheater in Genting Highlands, Pahang, Malaysia, built in 1998. The hall has a capacity of about 6,000 seats. Singers and groups that have performed at Arena of Stars include Deep Purple, Boyz II Men, Michael Learns to Rock, Cliff Richard, Lionel Richie, Guang Liang, Jolin Tsai, Olivia Newton-John, S.H.E, Joey Yung, Stefanie Sun, Vanness Wu, Wang Leehom, G.E.M, and Twins.</p>\n'),
(3, 'National Stadium Bukit Jalil', 'Kuala Lumpur', '../images/venue/bukit_jalil_269.jpg', 'https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15936.597952203656!2d101.69134!3d3.0546349!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x39a4c2964a9076a6!2sNational%20Stadium%20Bukit%20Jalil!5e0!3m2!1sen!2smy!4v1613961495647!5m2!1sen!2smy', 'https://www.google.com/maps/place/National+Stadium+Bukit+Jalil/@3.0546349,101.69134,15z/data=!4m5!3m4!1s0x0:0x39a4c2964a9076a6!8m2!3d3.0546349!4d101.69134?hl=en-GB', 0, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`Admin_ID`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`Category_ID`);

--
-- Indexes for table `concert`
--
ALTER TABLE `concert`
  ADD PRIMARY KEY (`Concert_ID`),
  ADD KEY `Singer_ID` (`Singer_ID`),
  ADD KEY `Merchandise_ID` (`Merchandise_ID`),
  ADD KEY `Venue_ID` (`Venue_ID`),
  ADD KEY `Organizer_ID` (`Organizer_ID`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`Cust_ID`);

--
-- Indexes for table `merchandise`
--
ALTER TABLE `merchandise`
  ADD PRIMARY KEY (`Merchandise_ID`),
  ADD KEY `Concert_ID` (`Concert_ID`);

--
-- Indexes for table `organizer`
--
ALTER TABLE `organizer`
  ADD PRIMARY KEY (`Organizer_ID`);

--
-- Indexes for table `purchase`
--
ALTER TABLE `purchase`
  ADD PRIMARY KEY (`Purchase_ID`),
  ADD KEY `Cust_ID` (`Cust_ID`);

--
-- Indexes for table `purchase_address`
--
ALTER TABLE `purchase_address`
  ADD PRIMARY KEY (`Purch_Address_ID`),
  ADD KEY `Purchase_ID` (`Purchase_ID`);

--
-- Indexes for table `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`Rating_ID`),
  ADD KEY `Cust_ID` (`Cust_ID`),
  ADD KEY `S_Merchandise_ID` (`S_Merchandise_ID`),
  ADD KEY `Ticket_Purchase_ID` (`Ticket_Purchase_ID`);

--
-- Indexes for table `singer`
--
ALTER TABLE `singer`
  ADD PRIMARY KEY (`Singer_ID`),
  ADD KEY `Category_ID` (`Category_ID`);

--
-- Indexes for table `s_merchandise`
--
ALTER TABLE `s_merchandise`
  ADD PRIMARY KEY (`S_Merchandise_ID`),
  ADD KEY `Purchase_ID` (`Purchase_ID`),
  ADD KEY `Merchandise_ID` (`Merchandise_ID`),
  ADD KEY `Cust_ID` (`Cust_ID`);

--
-- Indexes for table `s_ticket`
--
ALTER TABLE `s_ticket`
  ADD PRIMARY KEY (`S_Ticket_ID`),
  ADD KEY `Purchase_ID` (`Purchase_ID`),
  ADD KEY `PriceID` (`PriceID`);

--
-- Indexes for table `ticket_price`
--
ALTER TABLE `ticket_price`
  ADD PRIMARY KEY (`Price_ID`),
  ADD KEY `Venue_ID` (`Venue_ID`),
  ADD KEY `Concert_ID` (`Concert_ID`);

--
-- Indexes for table `venue`
--
ALTER TABLE `venue`
  ADD PRIMARY KEY (`Venue_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `Admin_ID` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `Category_ID` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `concert`
--
ALTER TABLE `concert`
  MODIFY `Concert_ID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `Cust_ID` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `merchandise`
--
ALTER TABLE `merchandise`
  MODIFY `Merchandise_ID` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `organizer`
--
ALTER TABLE `organizer`
  MODIFY `Organizer_ID` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `purchase`
--
ALTER TABLE `purchase`
  MODIFY `Purchase_ID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=181;

--
-- AUTO_INCREMENT for table `purchase_address`
--
ALTER TABLE `purchase_address`
  MODIFY `Purch_Address_ID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `rating`
--
ALTER TABLE `rating`
  MODIFY `Rating_ID` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `singer`
--
ALTER TABLE `singer`
  MODIFY `Singer_ID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `s_merchandise`
--
ALTER TABLE `s_merchandise`
  MODIFY `S_Merchandise_ID` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=148;

--
-- AUTO_INCREMENT for table `s_ticket`
--
ALTER TABLE `s_ticket`
  MODIFY `S_Ticket_ID` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=119;

--
-- AUTO_INCREMENT for table `ticket_price`
--
ALTER TABLE `ticket_price`
  MODIFY `Price_ID` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `venue`
--
ALTER TABLE `venue`
  MODIFY `Venue_ID` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `concert`
--
ALTER TABLE `concert`
  ADD CONSTRAINT `concert_ibfk_1` FOREIGN KEY (`Singer_ID`) REFERENCES `singer` (`Singer_ID`),
  ADD CONSTRAINT `concert_ibfk_2` FOREIGN KEY (`Merchandise_ID`) REFERENCES `merchandise` (`Merchandise_ID`),
  ADD CONSTRAINT `concert_ibfk_3` FOREIGN KEY (`Venue_ID`) REFERENCES `venue` (`Venue_ID`),
  ADD CONSTRAINT `concert_ibfk_4` FOREIGN KEY (`Organizer_ID`) REFERENCES `organizer` (`Organizer_ID`);

--
-- Constraints for table `merchandise`
--
ALTER TABLE `merchandise`
  ADD CONSTRAINT `merchandise_ibfk_1` FOREIGN KEY (`Concert_ID`) REFERENCES `concert` (`Concert_ID`);

--
-- Constraints for table `purchase`
--
ALTER TABLE `purchase`
  ADD CONSTRAINT `purchase_ibfk_1` FOREIGN KEY (`Cust_ID`) REFERENCES `customer` (`Cust_ID`);

--
-- Constraints for table `purchase_address`
--
ALTER TABLE `purchase_address`
  ADD CONSTRAINT `purchase_address_ibfk_1` FOREIGN KEY (`Purchase_ID`) REFERENCES `purchase` (`Purchase_ID`);

--
-- Constraints for table `rating`
--
ALTER TABLE `rating`
  ADD CONSTRAINT `rating_ibfk_1` FOREIGN KEY (`Cust_ID`) REFERENCES `customer` (`Cust_ID`),
  ADD CONSTRAINT `rating_ibfk_2` FOREIGN KEY (`S_Merchandise_ID`) REFERENCES `s_merchandise` (`S_Merchandise_ID`),
  ADD CONSTRAINT `rating_ibfk_3` FOREIGN KEY (`Ticket_Purchase_ID`) REFERENCES `purchase` (`Purchase_ID`);

--
-- Constraints for table `singer`
--
ALTER TABLE `singer`
  ADD CONSTRAINT `singer_ibfk_1` FOREIGN KEY (`Category_ID`) REFERENCES `category` (`Category_ID`);

--
-- Constraints for table `s_ticket`
--
ALTER TABLE `s_ticket`
  ADD CONSTRAINT `s_ticket_ibfk_1` FOREIGN KEY (`Purchase_ID`) REFERENCES `purchase` (`Purchase_ID`),
  ADD CONSTRAINT `s_ticket_ibfk_3` FOREIGN KEY (`PriceID`) REFERENCES `ticket_price` (`Price_ID`);

--
-- Constraints for table `ticket_price`
--
ALTER TABLE `ticket_price`
  ADD CONSTRAINT `ticket_price_ibfk_1` FOREIGN KEY (`Venue_ID`) REFERENCES `venue` (`Venue_ID`),
  ADD CONSTRAINT `ticket_price_ibfk_2` FOREIGN KEY (`Concert_ID`) REFERENCES `concert` (`Concert_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
