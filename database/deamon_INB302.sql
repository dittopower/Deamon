-- phpMyAdmin SQL Dump
-- version 4.3.8
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 27, 2015 at 07:12 AM
-- Server version: 5.5.42-37.1
-- PHP Version: 5.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `deamon_INB302`
--

-- --------------------------------------------------------

--
-- Table structure for table `Chat`
--

CREATE TABLE IF NOT EXISTS `Chat` (
  `ChatID` int(11) NOT NULL,
  `UserID` int(11) DEFAULT NULL,
  `UserReceive` int(11) DEFAULT NULL,
  `GroupID` int(11) DEFAULT NULL,
  `Message` text COLLATE utf8_unicode_ci,
  `TimeSent` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM AUTO_INCREMENT=58 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `Chat`
--

INSERT INTO `Chat` (`ChatID`, `UserID`, `UserReceive`, `GroupID`, `Message`, `TimeSent`) VALUES
(1, 92213407, -1, -2, 'What time are we meeting tomorrow?', '2015-10-14 12:57:50'),
(2, 92213407, 92213408, -1, 'private', '2015-09-16 13:33:11'),
(3, 92213407, -1, 1, 'group', '2015-09-16 13:33:16'),
(4, 92213408, -1, -2, 'Yeah i''m not sure??', '2015-10-14 12:58:10'),
(5, 92213408, 92213407, -1, 'hello', '2015-09-16 14:20:43'),
(6, 92213407, 92213408, -1, 'hi', '2015-09-16 14:20:47'),
(7, 92213407, 92213409, -1, 'yo', '2015-09-16 14:58:43'),
(8, 92213407, 92213408, -1, 'dfghio', '2015-09-16 15:27:04'),
(9, 92213407, -1, 1, 'josh may or may not like spagetti', '2015-09-16 15:28:13'),
(10, 92213407, -1, -2, 'Maybe its not on tomorrow?', '2015-10-14 12:58:27'),
(11, 92213407, 92213408, -1, '6', '2015-09-16 15:49:03'),
(12, 92213408, 92213407, -1, 'hello', '2015-09-16 15:52:25'),
(13, 92213408, -1, -2, 'I asked Jeff and he says he can''t make it anyway', '2015-10-14 12:58:47'),
(20, 92213408, -1, -2, 'Ok we will have to postpone the meeting then', '2015-10-14 12:59:30'),
(26, 92213408, 92213407, -1, 'lol', '2015-09-23 02:10:21'),
(27, 92213408, 81908605, -1, 'who dis', '2015-09-23 02:17:20'),
(31, 92213407, -1, 1, 'does null == null', '2015-10-07 06:21:45'),
(33, 92213408, -1, 1, 'test', '2015-10-07 10:38:45'),
(35, 92213408, -1, -2, 'test', '2015-10-23 10:21:23'),
(36, 92213408, -1, -2, 'a message', '2015-10-24 11:32:15'),
(37, 92213408, 92213409, -1, 'ayy m8', '2015-10-24 12:54:24'),
(38, 92213408, 92213410, -1, 'first message tho', '2015-10-24 12:54:30'),
(39, 92213408, -1, -2, 'sup', '2015-10-26 05:52:49'),
(40, 92213408, 92213407, -1, 'test', '2015-10-26 05:53:13'),
(41, 92213408, 92213410, -1, 'test', '2015-10-26 06:02:31'),
(42, 92213408, -1, 8, 'group 8 amng', '2015-10-26 06:35:05'),
(43, 92213407, -1, -2, 'hi', '2015-10-26 06:35:56'),
(44, 92213407, -1, 8, 'yo', '2015-10-26 06:36:50'),
(45, 92213408, -1, 8, 'fgfd', '2015-10-26 06:37:05'),
(46, 92213408, 92213407, -1, 'test ', '2015-10-26 07:56:17'),
(47, 92213408, -1, 1, 'test message', '2015-10-26 07:56:30'),
(48, 92213408, -1, 1, '@damon test ', '2015-10-26 07:57:34'),
(49, 92213408, -1, -2, 'FOOD', '2015-10-26 08:37:54'),
(57, 92213408, -1, 15, 'jhjhj', '2015-10-28 01:41:57'),
(56, 92213408, -1, -2, 'this is the chat', '2015-10-28 00:58:28'),
(54, 92213408, -1, -2, 'test', '2015-10-27 07:22:16'),
(55, 92213408, -1, -2, 'test agen', '2015-10-27 07:24:35');

-- --------------------------------------------------------

--
-- Table structure for table `D_Accounts`
--

CREATE TABLE IF NOT EXISTS `D_Accounts` (
  `UserId` int(11) NOT NULL,
  `PassPhrase` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Length` int(11) NOT NULL,
  `salt` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `Username` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `FirstName` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `LastName` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `DateOfBirth` date DEFAULT NULL,
  `Email` varchar(60) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=92213419 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `D_Accounts`
--

INSERT INTO `D_Accounts` (`UserId`, `PassPhrase`, `Length`, `salt`, `Username`, `FirstName`, `LastName`, `DateOfBirth`, `Email`) VALUES
(24332880, 'b53459f97a16b764ab54ce118252f368', 11, 'yêŽØFÂI5ÉûC<4ÙÖÁe®"vMø£ØDÕàß¨’J}¥Ï#æÝ™Ù¢ËK-G¬1ÙS#u`G©ÍuGV–:', '24332880', 'Metthew', 'Nuhn', NULL, '24332880@qut.edu.au'),
(22134460, '115cca086f46e9a83ae0bc4d83a1f8a2', 11, '¼ulfï@×*“déC°X;}…õü@ˆe Ü½}î;2ëìÓ.Õc€@{7<øGê”‚ºÅïõ9y1|}žÕÞA=', '22134460', 'Jecob', 'Grey', NULL, '22134460@qut.edu.au'),
(50687977, 'a55e45c60fbfdf7a3f7057a5458141cb', 11, '©Þ[ý32­zôÀØ¿xªÂ§óT)]ÙšBICØg€@*¢.™\Z)»†¤«sUwkê¤,\0ë\0hŽc¯h”h', '50687977', 'Victor', 'Alverez', NULL, '50687977@qut.edu.au'),
(50958474, 'd8267be2c1c20c6618bce239bcf08143', 11, 'Ù¦t$rb¿;ÐÅ³êau’[D58ˆ< Gû¥ÞêãzMD5ÃHÊøµ—à¶Äi÷‚•’Þá„	s{Ã¾4', '50958474', 'Tom', 'Gee Kee', NULL, '50958474@qut.edu.au'),
(70203403, '334f8be3e476635790de5870ae36c8df', 11, '9ý…Hã9”Â(øµ`ëÄ_î£È&«ZGÞÅþ;1€ŠC1%æ\Z†ˆ1d	€…AŸd—%¨¿ú,”', '70203403', 'Moneer Akeb M', 'Herredine', NULL, '70203403@qut.edu.au'),
(72027639, '4f049e52b97ad96ac24886ee40e182c8', 11, '(+]˜w7P4øXÖÏQ¡qg0ÌÇ¸èáó‹euj[=E¹‘Œªÿëf=…@»mžãu2…‚/ÜÞ 3Š•', '72027639', 'Heng Yung', 'Puc', NULL, '72027639@qut.edu.au'),
(73730988, '0b4945bc67b536645ea81d2f19cb87a3', 11, 'Ú†ØQMAÜRš€ã~aY:ð‚ç!T¸œPª¹*‚¼˜ »\0#ë©Ôã’cKÖJ`å:ä6Y¼¬-', '73730988', 'Yezeed Bender M', 'Perker', NULL, '73730988@qut.edu.au'),
(75560985, '5122d8fd73edadc1651ab2f601833a36', 11, '_á	}’Ó<¥öþÆ<¯ û<÷eÉ6Öá›÷ñzìã{ÛèŒ_ßHj5_]lg)"çÙµÛÇ™ÍBb|°Ö²;9', '75560985', 'Frederick', 'Brey', NULL, '75560985@qut.edu.au'),
(76310588, 'f9d29c006a5eb162d9f4ac27bd4d519e', 11, '9îQõÇ³íAÌB ÊQR³1{^úêö^_ÜNz Ü–É	ðÏmØˆ›&!ºù5/Ü%83³÷æO@Në6‰õ', '76310588', 'Aden', 'Nguyen', NULL, '76310588@qut.edu.au'),
(76810704, 'a380067260e6a01413892a6d51196034', 11, 'XXwE\ZìÉ17\0|3=½_åD·¡è‡L¢àÝO‹›µH‘ *88µäÇMO¤Ñ\r©ÊÍÃ-éQ«Üô\ZØÝí', '76810704', 'Christopher', 'Albeqmi', NULL, '76810704@qut.edu.au'),
(76936702, 'a828f0141a973893bc4937da45cd40df', 11, 'kO\0]„þ/sv›å’bXÊ‚!VnûúÊ4ªCwúÚ@‡mÜ¼Ûü’É,—³Ú,³iÕXV"êóp~Á', '76936702', 'John', 'Alghemdi', NULL, '76936702@qut.edu.au'),
(81004412, '7d2d136c1a0f913cd7597eebe2612950', 11, 'Æj‰‡×ëN÷˜7-‹‹¤øÚŠlÊ].¾ÜlùoÈ{‚ê5¢pVxbÃ+iqC”Ãƒ¨*K¤µŠ8éDåBUñ', '81004412', 'Leurence', 'Mek', NULL, '81004412@qut.edu.au'),
(81024766, 'dbae9e518cb6db6993cab43eee3aa50e', 11, '}ˆ.»uÛ‚`D\Zr¼Y›ãÅ»£‹è·	ùÅTÈ	v6oˆ‡ 1ý\rD&É =m~I‘:&!“¡ö¶nì‰”', '81024766', 'Mertin', 'Alherbi', NULL, '81024766@qut.edu.au'),
(81087636, '3905f8d260766307493cf670880630ab', 11, '…‡Úá†ÎÁå&ª\ZmLVþ~ú? Q!ûUD+¬à^Âš7+àD» WR+vX¯„KuúêÕ‡]h', '81087636', 'Moeyed Awedh A', 'Jones', NULL, '81087636@qut.edu.au'),
(81095281, '71c9d9ee2df295ef162b8f9e72df7560', 11, 'o«8©ÿšáá8°ªöA~šiBó	BÉÉÉ‡µ†[,}ºdLÅè¢ÛcÃ“(=ZêÖ›ï£Oß üë(ù0', '81095281', 'Shun-Wen', 'Begey', NULL, '81095281@qut.edu.au'),
(81099596, '65ffb808b870cf8d640c323cab40a36f', 11, '^‘žÉEÅ]:€¥ ~&b§"E\nÒœõß«´Ÿœ4~ÏÊ3\rGÔüU–1Ð$V¢óßÖ‰¡rLÌ$¿3×', '81099596', 'Minh Phet', 'Mecpherson', NULL, '81099596@qut.edu.au'),
(81104395, '99c28957971e73badc87ef228ea27295', 11, '›!²\Z’2 ¬0\n(›5KxyÖzkðwéâ³ÓTæÄApÅ%ÎCÆ×0Þœ¸.APÝœi‘<¢¤Yà', '81104395', 'Abdulleh Abdule', 'McCebe', NULL, '81104395@qut.edu.au'),
(81324522, '3e7bcbc4251fac87856bc7c313b74c21', 11, 'ÂôY#€0ÂÉtãv¯Ó`çê¬;ŸrPÈ…x ¯Ç¨š\0aŠèó„.ê*ù\ZÚ›IkEÃïkg~ºkP!.‹ˆ', '81324522', 'Stuert', 'Deyton', NULL, '81324522@qut.edu.au'),
(81371555, '27395826ac2647589054fffa28d069e0', 11, '¿µ?YtFB½î‚¦^âU­WÈN-šÆx¡|A9|6½¦K#Qû­Bu4QïœÜ`rói·\0©k[I·ZØx4õ', '81371555', 'Cemeron', 'Shih', NULL, '81371555@qut.edu.au'),
(81389772, 'a02c4ea4e090fdfb1e7ddf256a3172bf', 11, '‹VQAxÑUEö†«ÿàøÏXÜZ*î5‘íD—k>{)ãÞDòä×š°Ò«Æìèý\Z¹ß˜g^Õç', '81389772', 'Guy', 'Duong', NULL, '81389772@qut.edu.au'),
(81400962, '69acfb2766c7e7f9f1360d0b033cf8d3', 11, '{<øI0«Tâ’ínÑ•-Pk§ÁÀ.“3°ñìô•# \0\0ÂtÃä¼¿ësšÉæ±áÊ(EèYM¿T]mê!	', '81400962', 'Metthew', 'Stirling', NULL, '81400962@qut.edu.au'),
(81403571, 'a8b69fb764bd89d5a575dad2f80d148f', 11, 'å2A¤‡ûIÿÐ@Yºrý0i>(óJ»ƒq ‹ôb]dª:+ÎuaóÜG, ž’™ªWvÖc@ÃRúðž³ú \0', '81403571', 'Steven', 'Spencer', NULL, '81403571@qut.edu.au'),
(81430471, 'e9b4f2a951ba1e6100f39188ae9f4049', 11, '‡¡WŒ’W~„ä³nOkTßðÐ˜’M+O;bØ$Ø<ê2\rí4êýânc¼†dK\rï»È¾zóVÁ§\0T', '81430471', 'Duncen', 'Sentry', NULL, '81430471@qut.edu.au'),
(81505217, '091e4d22a5763a27cdbe1b7b124a1c8e', 11, '‘‡Pò Îô¨úo\Z»ï±yåãKÏÍ3TÁüæU¿Ìi*\Z¶µô#E\Zæ[ú…Û±GÝñâÛCApþP3°', '81505217', 'Micheel', 'Xu', NULL, '81505217@qut.edu.au'),
(81573557, '75416b362f8c498bc0a59459566a3d65', 11, '‘9f¬yÍKpÛ½ÒZÐÏùžº	SêÐ‹³Ö\nô¨?Äx›²°éªƒcþ«a5…!º½Pà(ýêW2', '81573557', 'Imren', 'Richerds', NULL, '81573557@qut.edu.au'),
(81576904, '3046609497458b7f21dabe7827141aab', 11, 'LvÍ¸4ÔÇìOŽðÊÇÙôŽP½2Þ*æóÒâ~ô½L2F>]*?(^Ù¥m dEõ}á‚¬x\Zî^cgšé', '81576904', 'Wei - Ming', 'Holdsworth', NULL, '81576904@qut.edu.au'),
(81578443, 'c4bb67a3a1c9603cd44097421dadc059', 11, 'ÅÌ7†§NelÉ8Æò+ðÔÔE¡ŒMð3•d~Xè®šÈ[y]d·O/ñòÑ\n¿ööÌ+=»~Ç=Q', '81578443', 'Metthew', 'Lomes', NULL, '81578443@qut.edu.au'),
(81581142, 'e450d5ba02e0af55a9c705a720b6ccab', 11, 'B—è©¸ÍrÐÊÙÚ½BÉéøí¬Xà³=7h’188Ï5WHÙYÚ³\Zï2îVÔccÙVjN¯bÍåÅ!E', '81581142', 'Edwerd', 'Meyers', NULL, '81581142@qut.edu.au'),
(81583820, '04d0d94f79abadec0a5a96c92acab034', 11, '‘­V}s«.ï	ª¨)¦f¹GJÕVÈLä%ØfÖ,á€F¼_w6­¹¢k®˜ø"X}³õQ8ˆ÷Ã¶K€–‡ç', '81583820', 'Letheem', 'Kroes', NULL, '81583820@qut.edu.au'),
(81590397, '08f9cc17279288c07a624d1c734e0deb', 11, '®XÕ^[Ó/øï½ÚQ¬ç¶×ÕœµÙrØAòÎ¾Tqk¬ïl¯ËÛQ0jÝ6Af,é/?îqÈško4‡ä¿¤L', '81590397', 'Yu', 'Theggerd', NULL, '81590397@qut.edu.au'),
(81594473, '5a48ca233795a62d61cfac80b0ee4dcb', 11, 'qmd\0^iåèCQN«m~sIoÉþß’CÕzÎàR‘k-ÈQåaNñ6Ó®Íâ^(—ÞÿC,È])‘)', '81594473', 'Tee Jun', 'Ten', NULL, '81594473@qut.edu.au'),
(81594945, 'defa3359cbc2c31778929f9d0db28d7f', 11, 'ª\rFAî,+îBA\Z<O‡@%¡¶&µ \Z¸úWb{éî´ÑSåq“µ”í“×¾÷xvã§#Êp²”5‰jy`oÏ', '81594945', 'Petrick', 'Tincknell', NULL, '81594945@qut.edu.au'),
(81595003, '42feea52fd85423db4c2c868324a141e', 11, 'ñ‘%NW\0V6RŠ®ðNO~DRD§Êœ†ü×rÆQ“‹7L  ‘\n%ˆèj¡ÕÀq£deúÀë4Ã¬±', '81595003', 'Zehui', 'Lloyd', NULL, '81595003@qut.edu.au'),
(81596972, '90034f9e40fe21ea82ca8e359653ffc2', 11, '¸+o~¬ŠºF©Ê2Y¾¨2XSí\Z³ îÇ\00"Å^ã¢U³HgA‹ÓTa0•³®ýõ¬ËpxŸ‘HC', '81596972', 'Seud Abduleziz ', 'Berkhout', NULL, '81596972@qut.edu.au'),
(81628769, 'db60e42a43c49463bd83312c58bd6edf', 11, 'ÒM¨Jf¶ÛrÒ%kÉ“-†mB8TOvÉ)¼(}’ð[?8òâªD%Ÿ/‚ƒ‹Þ!g*ïï:º`éiINÀç', '81628769', 'Andrew', 'Zheng', NULL, '81628769@qut.edu.au'),
(81633959, '00b2d6acc31b0d293153b4705e3bf09a', 11, '•mbÄƒ.]­ïÃŠ 3Û²ú¦ê.¨t>á¥ëÐL6È!\r<?½è`…ÕøXpºªQk\r."”Ó÷…¥‹ß', '81633959', 'Timothy', 'Jeon', NULL, '81633959@qut.edu.au'),
(81637342, 'f2b40d195be398a31b0bb34c1f37e4d9', 11, '´M¨ÀÉc8~U›p=~ŸO>þÉ–#‹œrx4òSPU»èì÷ÓP[½7ëÞ±-Ñ£C÷¤)þÛ2ÅzM6L', '81637342', 'Metthew', 'Beggermen', NULL, '81637342@qut.edu.au'),
(81646236, 'ff1b6426f3b7d149ef4f354038fa30c3', 11, '—F€À5 YÒïB˜%::°UI]Ö€}„C“—:¾tµ‰>×%›JËí˜#\0÷wØálx{ÐY©ògOÍ†ËÒ', '81646236', 'Zilu', 'Zheng', NULL, '81646236@qut.edu.au'),
(81659486, 'b0b214abc2207b5129bfecff2918f0a2', 11, 'È3(aÒóò­9%¢)4€øÿ÷EI‚ž“Ó¢eÐ×¯é\nŽHh¢£Vñ÷Š¦kœìûðWŽð=ž!', '81659486', 'Chun Hung', 'Aljeheni', NULL, '81659486@qut.edu.au'),
(81684243, 'c84b5614d078731763725e707386c415', 11, 'rÅm^±§Hzly>éðe-PÅá.xv@)8D‘v`ÅþTôYYž,„›Lƒµ£áepžËáqn‚Î‘_', '81684243', 'Chun Hin Justin', 'Metchett', NULL, '81684243@qut.edu.au'),
(81689750, 'c575ed20f2a11cdb2335ea8d1cc37a2a', 11, '3ƒ²<µ4ºƒtÒ˜þeõý2.ôeî¶kçMØäš ÎÏƒ¬¾ëB½-#§Hj¥zÝ•<\n=ŠŠ|', '81689750', 'Chun Pui', 'Brown', NULL, '81689750@qut.edu.au'),
(81699437, '291342ca1ebaa3027ae6ba069665ea56', 11, 'è¬/àñ-t-G´i%&ÍÀ¥èÀ7œ`W3ŠMãO›¼wj÷æÝAlftš² »=#óõ¢0ë:àQÁÔ\rO', '81699437', 'Kin Fu', 'Yeng', NULL, '81699437@qut.edu.au'),
(81701709, '9953b95509025695861880e202bd46d2', 11, '9ÆäÀÍ5—Lvt\0cÑ?æ¸Ï…F¦î$`;•³âH,ô¹öBüµÜ¾3R·¤á\08Âh?+Û.ŽƒŒ.}©‚O', '81701709', 'Yunshi', 'Chung', NULL, '81701709@qut.edu.au'),
(81701873, '1fa3ae2bea902dfe2ad35be97c9292d4', 11, '\nŸlºÿ§H­OÒèÅŠˆ©>ò;.´wZ~Ñ50­2n¤Ûã øžS©÷_²w2À{dq° ì–é¸', '81701873', 'Hui Sheng', 'Bhimeni', NULL, '81701873@qut.edu.au'),
(81702462, '06040a159179a222584c503211ffb0f9', 11, 'òõŠ\ZRz²².”d,b®pø“HXó\Z› Í¢J()ýPj¹ÞËIš|€¦;>3…^JÂÐõÒÌ%Ò†', '81702462', 'Chun-Ting', 'Ho', NULL, '81702462@qut.edu.au'),
(81703817, '76697ec9135d945ee8318202344bf66b', 11, 'Æ‹2q¥}æÂh>?ÚÓ6Ø\0nì‡@jˆ#J!bU2~«ã®*9¼Õ»u õ>½¼`¯§ùÞœªC', '81703817', 'Ashite Menoj', 'Alsellom', NULL, '81703817@qut.edu.au'),
(81706638, '708a954074fea8cba5c6718be62c4ae5', 11, 'úúñ¨×µþ%MbDñû«|$í(…{Â]r|¹60±_GXn¾Vê;ýKù›­Ðf„‡Ê\Zû/åI¨/ý¾ž•ƒ', '81706638', 'Mo Tin', 'Chen', NULL, '81706638@qut.edu.au'),
(81716145, '8e91afbec03f0b6c868d5edf7f538cb9', 11, '"†ë‰ÀD+ŠˆQ§W†™×ÎA¢¬õ|•Ó\0s€K°º¬àõ>Â?»T‚ÊUÊÉˆú€Œ†þöÉx»Gá', '81716145', 'Keen', 'Sun', NULL, '81716145@qut.edu.au'),
(81718563, '438177761a2f72f90af53ba00644111b', 11, 'q(DÄÚ}žzFÞq¹åUF8Ë¨«.ý	Jêð“T®iÝ;ÀŠ²¹R@|ù¿Ú{MGsUSw ûJZ´', '81718563', 'Chi-Kit', 'Kwen', NULL, '81718563@qut.edu.au'),
(81720347, 'a4d47fbd8bc5fc54c12c59833587bc52', 11, '»;ö•ñ`½;|[\r9€Ö³arF%Í¬cFå¿áôå¤­Rëø-Ü<¯-9‘ýÿ}¢)ÞüäÈÃ:Ç3)', '81720347', 'Dongmin', 'Chen', NULL, '81720347@qut.edu.au'),
(81721025, '2c6d5c03ad6acf68eabe02a1369ef306', 11, 'ƒ“¬ê¤ÝÛÞ<¶`TàÕ”Ã~RHW­‘§¶ÏËT•ÍÙô¢Vï‚ž½\rHÕ‰º—D¾ýé¢´\ZÈ4æGLO', '81721025', 'Chern Loon', 'Dhuleshie', NULL, '81721025@qut.edu.au'),
(81747300, 'f019b7789d47b6f186458dedac08fbe9', 11, 'm‡d]v4¶‘yþlº—©°Vú ^od©Dš·•±QwÑ•¬Ÿ-®B·È,œâ›ÈkúŸÄa?VOæ•I', '81747300', 'Derren', 'Offord', NULL, '81747300@qut.edu.au'),
(81750289, '62df842f729f2c113f301c736a59418b', 11, '´ÒiŸÞ#Ú•¼+%Oå"øÓûòc+ àeo±ˆ¡ÞÿW‘tõÈCy/^ÃèÓ—ÄÉ´`IÄÞAO0òIÝ<~íoH', '81750289', 'Semuel', 'Osmenegeoglu', NULL, '81750289@qut.edu.au'),
(81777284, '6b462aa9a07cc058a598f462d7c85c77', 11, 'EÔF-‘Ëlª::hôòËþmUðêLNÒÎÛ0ÖÔah	AH~pÓ¸h\0šmH8ÒlŒé,ÅYÚS¶L', '81777284', 'Alyksendr', 'Lee', NULL, '81777284@qut.edu.au'),
(81806713, '2b69a5314da95398d4af9de704450c32', 11, 'Ñ®2ªócŒÍ6äŸëØF7Ðsµ9Ü:	åM›ˆÂôÝ*¾­)1=+Î ãü8¤oÕá‹¬þgD¨¿»³ƒ¿', '81806713', 'Jorden', 'Thomes', NULL, '81806713@qut.edu.au'),
(81811229, 'a4ece3e9b7884c41442fce5ca3355a66', 11, 'œÙþŒ¦ùªËÒ¯ N‡£õ`L3ò3—-Î–‹ÆN˜=‘0už-l“d>¥É¥Zh¤ó|Òºæ5 \0{{d˜‰', '81811229', 'Jene', 'Hemmill', NULL, '81811229@qut.edu.au'),
(81823928, 'fdc945ec310c519c133ee2e4ec7f14ed', 11, '3ª—µ2s¶åôR#&eUÑ§QÈÓ1Ï)i«Í]QN€W¯£ÐN~În¯ÆÌFãŸÿ<PÚ`ûþ|·|Í', '81823928', 'Else', 'Selmond', NULL, '81823928@qut.edu.au'),
(81824193, '584a9ce98dca8eacb2d8353714c09f7c', 11, '…ö‹œË>säV0|ý,;ÂÛ¯$=!oð°ïxÎÞ£5qV¶QÑõ}Ùel])æ¨í·(³ŽÑÍÁR]‹', '81824193', 'Sem', 'Remington', NULL, '81824193@qut.edu.au'),
(81824240, '69feb0addff5281a9d2b4a0f1bdc05aa', 11, 'ëÜÅ=D)íVîNJßeÂ )aš²¡…õ£/ÉxÓ¦Æå–óÀ\r¸*˜PÈ^DªÝ©ùàL¤ÛÆ¾j5]ÑJŽ', '81824240', 'Jemes', 'Ivicevic', NULL, '81824240@qut.edu.au'),
(81824657, '27bdba110c5c59861a4ebc5388d3d75c', 11, 'èZŸ&3/-Ýq:0ÑŽ›ÊýÓ"ÃM#H¤ŽuØ•5—<F@X\0´£"yà×@½ã/i¦Ø]‹¯’ô', '81824657', 'Albert', 'Rees', NULL, '81824657@qut.edu.au'),
(81842205, '5ce4877f5322627702c91dd9e8a9b1c3', 11, '‡\n¬º†=ÛØ“¼ÒK[ý2eøÉµ;ÊaÆ§–=3çÅ|1îg³Ø¥á¦ŠaøµÅW:ÆL®¾|Qv\nÉ¡‡åšÑ/‹', '81842205', 'Cleerence Lizen', 'Nichol', NULL, '81842205@qut.edu.au'),
(81847380, '180e086b749dbe01a740687ccba0c9ad', 11, 'æð á tecv»Þ;÷2µ©ºPÓØk´"Þî@ls÷«§Ê\rÕ"”Õ¡)‡J^2äÅxÝ›\rÍÂ¤#', '81847380', 'Zhenyu', 'Howell', NULL, '81847380@qut.edu.au'),
(81854092, '123b483d77d8ba024ac813aeb363d1a5', 11, '/*–\Z–Ó+Çl`\0¢épõÚ®Ztž{â&«hµSIÉ§ì‚Ôºù‡¾É´<»øÜLêŽÀ3òÑG\Z', '81854092', 'Joshue', 'Smith', NULL, '81854092@qut.edu.au'),
(81873291, '0249e8c9a8a1c2a60e0ed66349086875', 11, '¢ßöZ@ýLõú´"^ÏÖì“ØšSÊÅµXî¸âwj½Û¡Æ8drC—ñ„5C£õ†	È=‰|à¢G1\Z”D*J', '81873291', 'Steven', 'Young', NULL, '81873291@qut.edu.au'),
(81887705, '3f165d1f4fc9cc996e4d9e48fb67c502', 11, 'ÆG½Ým™ñ¡ØŒ_5LtI4@O½œ,|(­• t³"‰0„²ÿGÌ›Rz~/Ž`ÄÍÃÞ^Õ}Q_ùÐ# V', '81887705', 'Cellum', 'Freser', NULL, '81887705@qut.edu.au'),
(81887918, '0f4b6e7aa195f3e693c50ebbcd7883db', 11, '¡öðØÜŸÙÿ+çiÇ®ùyO|¨^³ã(MáÍO>>mW ºµÏöÔûUø<Æî@Þ\Z|¨ÝWˆœ', '81887918', 'Blenke', 'Leung', NULL, '81887918@qut.edu.au'),
(81898642, '2921e93332b27bb9bc9385253e3d261d', 11, 'ˆµÃÆ¿9¤> Û½¤"OïNôøC‚ru\0©)-R —PôÖå:”¸ióˆï£&‚¬ÿ}úÎ&#Ãkl,»', '81898642', 'Soon Kok', 'Wisser Domingue', NULL, '81898642@qut.edu.au'),
(81901759, '244cbb928e4cd6cb859085a0b4a518eb', 11, ',~XmÓ\0- Ž!=S¥X£AodTY— hb<O©ójWMd±¦*árKžô|òš,=ðáÄv.->ÿ', '81901759', 'Gurpreet Singh', 'Jieng', NULL, '81901759@qut.edu.au'),
(81908605, '426cee3f8cf830043972e4822f0fb6be', 11, '›{‰â¦amVÂ¬Qfó‹JAMØðÆ˜)Nò5dõs8šî¦\rÓ€OãJ\nº„­/Ýì–º::0ZQs´Y^Øh\Z', '81908605', 'Boxuen', 'Hopkins', NULL, '81908605@qut.edu.au'),
(81911622, '4071f3139be653532422c134bbb262ef', 11, 'bmôÙ†Åž{Fùòæ"FGS¬Ý]¶rNJaï‚LEê¹±"&Ö¢¨ÕŒO,Ú1ýsžè„ë«hCÞe«-ºáå¹', '81911622', 'Peir Gen', 'Terry', NULL, '81911622@qut.edu.au'),
(81918392, '21b36377b26b30bf0f0d5789cdaf7c0b', 11, 'Â_9¿‚øG8ÇŸè‰Ñí—OG=»:¯¥–¶ÜX•\0X´úŸ(ƒ ‰h©fgKêDø¹m©ã+Åá0œ', '81918392', 'Cho Yen', 'Krotilove', NULL, '81918392@qut.edu.au'),
(81923078, 'f6b5e9e5cb6ec907c0a2d003816572d5', 11, 'J%%åw]+*Ì|ya”`pº‹†¾»AØ[Ýú„IÓõÇ»1‚èÁ?ªÔ€˜ÉÁyÖ8€jžÄú¸õS2Ã', '81923078', 'Junior', 'Koey', NULL, '81923078@qut.edu.au'),
(81925542, '1c33cf14e07a26e18fa6e232fe67e939', 11, 'NÑR=Y\0>¬âAèl³EÀôŽoô_™ï¬ÏYœt‘þÍ†{´3Öe,:”Zñµ†¿ÝÙyäÆuì{X^ý', '81925542', 'Shennon', 'Dheliwel', NULL, '81925542@qut.edu.au'),
(81934053, '1e25e150d0f3b01a0cdf0d477f33f09b', 11, 'FjáœiÍZz+Yýn|}ý­LÃr¦7óŒ+rIj½´%ƒª4~*Ø%*ÓžÞÅKiáKÅ8¤K„', '81934053', 'Deyne', 'Zheng', NULL, '81934053@qut.edu.au'),
(81935173, 'ea1c337c44c92eecdfb5f508f10a54a3', 11, ')Ø9ÞÜrgÍê¦ç£&Ã“s”F\Zê:œqú×ÍLyÙI!R	öÿ%Ñapf¼‹,â‚ç=w÷sð', '81935173', 'Hoeng', 'Me', NULL, '81935173@qut.edu.au'),
(81935254, '3622979dc8a62a42fcd90e666e854173', 11, '®ÇSÜQˆAƒ@–T¾2J{\r‘[úF¾	ëX#ÛG´IÉŠ¼Ñ™\ZÅÈúƒ0ÍŠQòQ¦~Pþ;_ŸŸm', '81935254', 'Brett', 'Aw', NULL, '81935254@qut.edu.au'),
(81938024, 'c80a5771458f39f5bf4851bffec3df60', 11, 'pzº«rÖñD»Ye<#”eÄ·³LˆÅçK5Sþ‚uµ||ÆlN¦·H}Û;L)ðËyñ¥@m½Õ\nr', '81938024', 'Jinxiong', 'Hui', NULL, '81938024@qut.edu.au'),
(81942161, '5d811d01d24d16b2082f5e7b6b9af4f8', 11, 'rÚÊS–áPgVÕQW‡­‹~â¦Ý8©c[(LÍ¼G”Ó<Œðbov`)»NæT§± üîØ¯ö%', '81942161', 'Ven', 'Kempen', NULL, '81942161@qut.edu.au'),
(81979821, '3595fbb95b0d82bef7b65d356f450d97', 11, 'eí´25œ¨§ÆlØâ²5gºÀß>Û¹oý5Š ŸúðÔ,m³¿GdÚ&p¥Œv#fm‹hBVC—™¢ã¥%×ˆ&', '81979821', 'Seedit', 'Weng', NULL, '81979821@qut.edu.au'),
(81986746, '9294e1739cd76d8ca083cecdcce3238d', 11, 'Õa­½÷š<e™Öæ™ª³¼$ú/†í¯aÞ`ÓÂwù¡j¼¬&x`)Ê$hRa¢|gŠ°ï§ÏD©ÁãŠ', '81986746', 'Metthew', 'Jeideep Singh', NULL, '81986746@qut.edu.au'),
(81994480, '606059be5abc26b8e9e708e802fe3e8c', 11, '‡Óf7ŒÁf…\r¸ç‰Õç¨h“¯Cšdµ!Šs¡‘³—6^¶~ö—OJ‰Äqt—æÁÑGï8|d¼\np´5FÐ‹x^', '81994480', 'Benjemin', 'To', NULL, '81994480@qut.edu.au'),
(92013164, 'e0ff8add5691067735adb627d12b0ff2', 11, 'Ÿ)Rx¤uyžõ¯sƒê<a\nã(# +ÍA¼yœ‡tò’³Ä\Z÷DÄreóFx¾…7²&‘Õ¥¶BÈ', '92013164', 'Sooji', 'Bretic', NULL, '92013164@qut.edu.au'),
(92013172, 'bf8fcea77703c48e36817b9328bbadc6', 11, '	Ïil\0|9ùE—_¶YËnÚbfl³ ð‘&,¬u›c,¿V‡–~ÄsÍ!ö\rUW_÷^ÄýAG‡EFXøÌ	', '92013172', 'Ryen', 'Sherifi', NULL, '92013172@qut.edu.au'),
(92014098, 'e7159aa17d670b96a046dba4bcab6af6', 11, 'à¬oGƒ˜É³58 ¯ 827RƒsÀ÷*¶F.VLªd°¥v‘¥¹ÐöÇîH”†·{‚ý…Ñ+ì\0F6', '92014098', 'Jecob', 'Khen', NULL, '92014098@qut.edu.au'),
(92014497, '88444e72d15bcd907e361012fd582c7b', 11, '»tÊŠñhÎ”W;$†Å«y¯qÚ¯ho±|M¥ÎZz"òÔÈQ~ç	|™"ˆ¡½Ù´PCIOyí)€ø3u', '92014497', 'Gie', 'Scott', NULL, '92014497@qut.edu.au'),
(92014560, '4f0d5366cecc2674a94bd084c3ad2542', 11, '/‡ý>úÄîóÜfü_š*§ˆ÷»(lÒ!Y‰Çã#Æ,éãi,VviŽyeA•¸i·”xƒ‘ZnÕQ ', '92014560', 'Devid', 'Norris', NULL, '92014560@qut.edu.au'),
(92029036, '86a369c0b691181e2e566027b9fef7fc', 11, ',*Î_×l‘ú¢\r×,¹/2\rh†…ä³ü˜€Ûý-£ÙDõ·ôqž #0<-e›5Oµ~þ5à+\0K®0›HÒ¸_', '92029036', 'Steven', 'Lim', NULL, '92029036@qut.edu.au'),
(92074147, 'ca27ffafb374e42333291188f92f6625', 11, 'zñ¤A¼:[%2…ï›øqÚ^°ÇëÓyQ7MÌyº4yq¦„û(4ðþn£–y`Èº¤iïüJ“Ç‘¦ƒ	¬û})', '92074147', 'Keith', 'Jones', NULL, '92074147@qut.edu.au'),
(92101900, '9d186ef70ab446ab23eb9473173dc4a0', 11, '•\nrÏ¨ø5¸ª~s*ÿõæ´\rü¹,PíÞ{Ö¥ZcgíygÚãÌå(q<â;xR%ŒÕÞMsZÏ!·Y®ËY£', '92101900', 'Alex', 'He', NULL, '92101900@qut.edu.au'),
(92106766, '9460addaed134f347101b4c6e8326dc8', 11, 'FŽé$yFòi°‡/ÏãúûÚ»‘0ÉG8ž»¸9´÷;ngM×¡Dåhf`c´hë‹&¬†ckQ', '92106766', 'Jose', 'Ven', NULL, '92106766@qut.edu.au'),
(92147934, '6c51516c998066f9e5929bd653a18655', 11, '–tì¼e¢9Ûoõ†PÈýwK%Nœµ&µ5¹È{$+ýs‰FGhï/º]„Ï^âÁ]°¹Ò÷í³>è8', '92147934', 'Devid', 'Weidt', NULL, '92147934@qut.edu.au'),
(92213406, '94f3e41d7055b965ee674649d3ce0374', 11, '±ß- ÙÝ…|ÄåT"\rø3ã-KÊŒ¼\0¶ö3_Ÿh³\Z}µ1UIÀÂ”øüY)ìEXÙtJQjƒ}¹Ð‡ŠfåR', '92213406', 'Lee', 'Joyce', NULL, '92213406@qut.edu.au'),
(25902940, '45a3cee688e27d534f9fb2e7d301a493', 11, 'Ìˆ¸&éi¤xÖžÖM®ìé­GÿûãN°wõ´r5~œŽó\0=ò–¿Ed£tS\0SŠ¿r’³è|gÄ?R¯ãŠ', '25902940', 'Nick', 'Sherme', NULL, '25902940@qut.edu.au'),
(50420938, 'b41973fce89685ca28a3b7b633050728', 11, 'Ôp	rUÅ¨¶˜îiøíË[Re(\n€`pº»©ºÒÐëÂÔ?PÚqÕ°¥ò«×…hÍ—ÍÞP\nq½\0Ä’4ûqsêx', '50420938', 'Metthew', 'Wilmen', NULL, '50420938@qut.edu.au'),
(60821693, '16afb34c54df67dbe66834036eeba23c', 11, '*Í•™.³?MW6óŒmwãÛ±jV¦”¿ýUZºËÆóœˆÏ[ñÁP¸°Í€>÷(¡ô¥”\0…]§»ûø_', '60821693', 'Alex', 'Werdle', NULL, '60821693@qut.edu.au'),
(70143494, '79b15ffd4ac5afd36ba14c816d565327', 11, '÷çQ\0˜‚\00óa†Ì}HŸî#ÈJ¹„8¼&ðZ“?feù˜Œê6µ/*E"€ÎRúªxek —1Kˆ', '70143494', 'Thenh Dung', 'Dwyer', NULL, '70143494@qut.edu.au'),
(72027558, '99222bf4ac010c90c3d08611e9aa29f6', 11, '³a–B©ƒ¯Cw[š€´ñ¡ÖŠF½\r®·”àŽá¾xq‰º$~0=*tÑMv GNN³/âMrµ×Oùò¸', '72027558', 'Ahmed Omer M', 'Lene', NULL, '72027558@qut.edu.au'),
(81037256, 'e829bcaca1c30767665c87ca445a5531', 11, '\rt	5ô†vXÙ°€Aà2!o+0®¹ûˆþt¥mþÌÚ ÷$A$¤Í»vwëõ\0ï¨„¿Œúxß/ä', '81037256', 'Williem', 'Du Plessis', NULL, '81037256@qut.edu.au'),
(81280495, '808172ce928c7ff155a17ef01a587eaf', 11, '	2Â)ì*pŠu{¡3ó€ó·G$—,OŒÎM[®º~¨áUt?-ï²â­½2· ý†ÑÂùlàuüKè', '81280495', 'Deniel', 'Wheeler', NULL, '81280495@qut.edu.au'),
(81375941, 'ac761008e52f8042921f0df2b15da991', 11, 'ÒÁûO¿0÷	ýÓ©+Þæü¹s\0“÷ôErêìÙÿýÊ»éD‰„¬6<ëÄ•™$:ðM4.¢h´¬9C', '81375941', 'Tei Ho', 'Tren', NULL, '81375941@qut.edu.au'),
(81388083, '450c7f20e04aff108a120e78317b11df', 11, '"4q’”ý—»Ù/=¡1	2¥Žßi 7ñ9±<Ýý¥Zw1eth¢áâŠÍ®zÆSõ¹¦8‚‹«Êùp©', '81388083', 'Qieoqi', 'Alghuneim', NULL, '81388083@qut.edu.au'),
(81502595, 'ab62b1297457dd9e4183fecdd813847c', 11, '+ l/Y?šÜ~ø¯ÔpßwZŒM[3–0pÀƒÒ(‘\nªhB/…®«vó»ˆëú:š69•Úì³¸‰ŒXkÜÓ', '81502595', 'Melisse', 'Nem', NULL, '81502595@qut.edu.au'),
(81620954, 'eee3e9ca0bdb432527e5396648804bc8', 11, '2{pÐÂ%Ñ¦ —ÒmKÿ¿,ë/”ö§²Õæ»I ºF<2&<Å÷—Ëí:9áúšrëèa×|ÁÈsíà§j³', '81620954', 'Abduleziz Menso', 'Allen', NULL, '81620954@qut.edu.au'),
(81678014, 'fb27d2389e523832cc062eccc87529d8', 11, '<˜ú^ìÅOVuÜ4lBë>•ÂÁä’.ì	Ûp^…VM‚P%#—S¾¥_n‡?1ýð¬žešvQ4ãféuÒO', '81678014', 'Misel Nitinbhei', 'Alsubhi', NULL, '81678014@qut.edu.au'),
(81686998, 'c88e0e51475fb988dd3a88c30798389d', 11, 'ìšœßÝF~,u.aùß9W/ ¦ÅçØ3+Tç°Øvu’á°ž__Ï•éÃ	,0òªŽ¯P-PýxUÒÈ', '81686998', 'Seed Abduleziz ', 'Merdon', NULL, '81686998@qut.edu.au'),
(81710414, 'f145889995c4be55360e7365c85e4e12', 11, '&Rð$aŒâñÉFl6àœÅz66ÕÏs\rÐPxF&¯"dv†vå•+>)¶mPÝ“Æuž÷|•"Ú??\Zž', '81710414', 'Scott', 'Wong', NULL, '81710414@qut.edu.au'),
(81726931, 'd0fedc2809a9638b2dbf728301ff569b', 11, '6€	ËhÓ8ïÚŽv™ÿ³‹wÄSaòik¨QÅ¢´EoIi9äÎ6¬›\Zh}pÒ¡X>QMíŸÕhŸòNêé"­', '81726931', 'Phillip', 'Chen', NULL, '81726931@qut.edu.au'),
(81770344, '83190c1295bcd9ca3a34ded271e86e08', 11, '˜=Æ+²k|ÇÐu/Ë’éþq KéÉ”¯þ£¥\nï§›Tí|£?ç1p3“s’AÂ\ZCª%ïoïÆôgJz(', '81770344', 'Joseph', 'Choi', NULL, '81770344@qut.edu.au'),
(81779759, '015eca07faf8ad59db838378df9179a6', 11, '¥‘„öÈ•üªR´ÄHÐ®C¢™Qy-ÂÊ.¹¾Än ‡lõ†Ï¥fúF½ö@GÍ©|Zú{­å?', '81779759', 'Temirlen', 'Chueh', NULL, '81779759@qut.edu.au'),
(81805644, '3a96215a17a59396d0c24fb28b1427bd', 11, '¹½ûƒ¹] ¿òÿÜ†ËNŒQŠWu=oÌü½NKÈ¼Ò/yG-8_¨\ZÓù—yá½„Ž-wi \ZÒçÍïÂk\n', '81805644', 'Frenkie', 'Bercley', NULL, '81805644@qut.edu.au'),
(81824037, 'e9fae6249f7529efdad9204f98ebe730', 11, 'ÂÅ…3µæ+c	ý5Á$~´²S†–ý®Ë\0å,`ÖN¼yíI%Ø+^6I(¤9†ÂKÖ•5}ýK±f·]æ', '81824037', 'Andrew', 'Skye', NULL, '81824037@qut.edu.au'),
(81909253, '2c6e016b456f62911f841f51d37d334a', 11, '…¥¢\0žÔ7ñÊvCüì.¡ðåG±ÜJµÕ¶ÄŽ"ð|·ádôˆQÓmyF>IÃGeè;Ñ§…Fc‹s5', '81909253', 'Sheohue', 'Stone', NULL, '81909253@qut.edu.au'),
(81963398, '80b0f8b12687e71e8efa6a11214c478c', 11, 'Ö6$=à\0IõXuZA¨Éï­id½sJ,IQéEb~x»¬dAÙÃÎ4’¹pñµwÛî¶NÞW¬©½ï6', '81963398', 'Jessie', 'Orr', NULL, '81963398@qut.edu.au'),
(81977232, '8ffac9c289c195663c53bd9580e0e8b4', 11, '½«ljjl™ü¥±=_6û‰OÈó•U·ùœ‡	|	Ï!h‹jj…/mHSìWüeyÅææŸišSÁkŠ£ªåà', '81977232', 'Nede', 'Chen', NULL, '81977232@qut.edu.au'),
(92138099, 'd556ad22c9ad172202d7e27a6a9e6b07', 11, '³\0O0DÌ3¶ÖÏÂWËeJ:|$÷»ô¹ê1bMªÒ`BØl%ò9UlŸb¦v#*F†Á¸Ž>º‡ƒæ¥Æ', '92138099', 'Jerry', 'Sunge', NULL, '92138099@qut.edu.au'),
(92138790, '63804b40e9c1629ba11665d524cc49af', 11, '¬´~"_gF î°Ôo‚²ü8¤ßÖfýæ 4rË"ƒL|H¼ÆÎOcÒZÍëEÁTq¤\rË¤Ýúå&73…¾öd?', '92138790', 'Reuben', 'Heckenberg', NULL, '92138790@qut.edu.au'),
(92149121, 'ed60418d628720b1dd3cfafe75bf579e', 11, '[Þ©¹VìâLÏâ)¸•VU—­t–å†#ÓãjŒ£˜BÖãú`/zŒ3MòGÓ"#ËÒËÙ\rŸ$Ã4-âX(', '92149121', 'Peter', 'Tren', NULL, '92149121@qut.edu.au'),
(81585911, 'f4726e8c40dcbd6b009b5e7eec05778a', 11, 'ED\rz‚å)Ë…Æ,0ÀçÐ`Ñ	¥Î:˜Ï6/—´ü_TÀükhrKÀa®ÆøßãûGwe‹àksY›', '81585911', 'Tristen', 'Henlon', NULL, '81585911@qut.edu.au'),
(81359113, '2f9ef6a2a8d86a32db60739f05f51540', 11, 'Cô¸ØJâÙ²\09ŸNjÒÙâuÍ¹†[j‰#ë ÞF~W¿ð©ô,°%Z¿p;4ïKˆŒnšNi¦9#', '81359113', 'Alexender', 'Aldhehri', NULL, '81359113@qut.edu.au'),
(81961221, '466e4bf5fe28a6bdce21d1d07689b8b7', 11, 'µžŒŸW-à*-ífMàä\r4p¬»Â¿•üdÓ:©ÔŒ|o£:  W*Cš;:NGêBggŒ~ËùSb^†°¨¤`', '81961221', 'Yuet Yiu', 'Nguyen', NULL, '81961221@qut.edu.au'),
(81941866, '7a1b72e99a3c24d8edc5c9cfb76f9a99', 11, 'ý7©\01nû’ÙµuëuÉ¡1c\ZJšƒ$+·>&hìtL/ñõuÅ¡”£½wKbµì‹ÝVÍá½ØoÏß', '81941866', 'Xin', 'O''Celleghen', NULL, '81941866@qut.edu.au'),
(92213407, '333aaab00310842c2e70a7707dc7b337', 8, 'øÐRXšêj	9i÷|è¼ªÐH2q-•þ ÃîNáŠ†EHó\Zg`*\Zü¹˜Ë–Ó…À©ý0ƒ+8§jªóÄ', 'n8857954', 'Damon', 'Jones', '0000-00-00', 'd72.jones@connect.qut.edu.au'),
(92213408, '079c0f7ad0928bd321faceab9da586af', 8, 'ó\0kX¬ìDêý~åáîä¤›ðI#©T#;…ÁOô­åXñT÷Í˜„p‹‡nó¶ ¡Pj-Àš»ãæDEóŒ', 'jesh', 'Jesh', 'Henrjrk', '1995-08-31', 'dhdjh@jrjf.com'),
(92213409, '64204daef0f3adc705ca16fe74d87a22', 8, 'ÝÚñµv)\\JoåŒºäêGçL†;/¸‚ÞõqFÈÝÖ‰™ç©hVÉm„¼Ýwq›e%8ûÉ¼b¸«h5þ=—', 'n123456789', 'Josh', 'Johnson', '0000-00-00', 'jh@jh.com'),
(92213410, '933eba6a666c2933c526802884bd9304', 9, '‘›¤w¨Zí©¦éš‹Ã ü Ë­ÉdüÂ\r\n\r\n©õs¢Èú@ª®^$XBú¶T¥.Å£óŒ}¡4½i¸ÑÕi', 'woops', 'Jane', 'Doe', '0000-00-00', '1@test.com'),
(92213411, 'e8e971cd0cf1428aa0730dc1389a9ca1', 8, 'N!…	þØŽÕíž¤‘$o‹/Pîw,Ò''¯îtß‹âCe­K[Iç''ä}õ›éùûŸÑ2cLD¹qG:Ðù', 'dwinterr', 'Declan', 'Winter', '0000-00-00', 'test@email.com'),
(92213412, '05ec49c4aaaeefbfcf88bfa793ed713f', 9, 'kGåZJü$;Öy‰wm…ÿº|~Mn±¯2ÐzµãäOpÃ­“Ê¾9Ë¸ø†IPc‚å	XëAØï¦”', 'emma', 'Emma', 'Jackson', '1995-07-01', 'er.jackson@test.com'),
(92213413, '3b3d2f91c8479f9041fbdb660895e25a', 9, 's„¥0˜ÞÜ8õïæ],ãŽôøÑ(ëW5˜G(ÜøË7î	­óú…ÌžŒýñ·43\ZÍtÈ¸Í{Z§CÊ£ýB', 'emmaa', 'Em', 'Jack', '1984-05-09', 'test@test.com'),
(92213414, '3e5401aabc058b7addcc7e04ef04c3f3', 8, '~^+¸ôl…A ¾¾w«ØÕUqVÙúKévÌ*nºœ{h(¼¬!2–ùBzýzRÌXÂ&7gQ[Çª', 'administrator', 'Bill', 'Jobs', '2000-01-01', 'linux@qut.edu.au'),
(92213415, '15313e9d75272dadbb6eb834fe67b293', 8, 'uWz`»óà H{ù¾)Æ0ñx‚	‘>iˆD mÙW„}Éœ˜À„©nD+Çy9ùÞ ßÕŸðP[âGë(ñÈò', 'n8858594', 'Joshua', 'Henley', '2015-09-30', 'joshua.henley@student.qut.edu.au'),
(92213416, '5b79947fdb534f3067e0bbca1b23d4d3', 12, 'ìÈÓ$qO¾ý´Útù$-Çý¿a*zÍ\n7^e÷wo;Bä+äGõ€Ù¶^Û>×{ÔòåÉ"­Y2×Gü~Šø¯Á.', 'yuefengli', 'Yuefeng', 'Li', '2015-10-28', 'y2.li@qut.edu.au'),
(92213417, 'af91610dd7447fb3c2f86398e3542838', 8, 'NüœÞþÛÒq¶ùñf‡ü$(Ø„¬Dë²³$ÂíÈ×û9nÿÊ%öÿFê±Ã“W¸Š]¾I!à ŽlµC', 'tutor', 'Tuuuu', 'Torr', '2015-10-08', 'tutor@qut.edu.au'),
(92213418, '1a921fca0bdf79d318461ce88098e047', 8, '…¥á8TTioÅ}_½F?5i°y¹ª´¤“\rûöç“v’„’c¿ÙpbéNbç¥@Ybe$Å“–þ[8†–O', 'n8858593', 'Joshuer', 'Henler', '2015-10-22', 'oisjdfo@email.com');

-- --------------------------------------------------------

--
-- Table structure for table `D_Articles`
--

CREATE TABLE IF NOT EXISTS `D_Articles` (
  `art_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `mod_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `tags` text COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `contents` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=127 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `D_Articles`
--

INSERT INTO `D_Articles` (`art_id`, `user_id`, `post_date`, `mod_date`, `tags`, `title`, `contents`) VALUES
(13, 92213407, '2015-10-26 11:01:03', '2015-10-26 11:01:03', '#1|@1|', 'Name Change', 'The Groups name has been changed to null'),
(14, 92213407, '2015-10-26 11:30:31', '2015-10-26 11:30:31', '@1|', 'Removal Vote', '<span class=''error''>Voted to Keep 92213408</span>'),
(15, 92213407, '2015-10-26 11:30:36', '2015-10-26 11:30:36', '@1|', 'Removal Vote', '<span class=''error''>Voted to remove 92213408</span>'),
(16, 92213407, '2015-10-26 12:03:25', '2015-10-26 12:03:25', '@1|@@1', 'Project status', 'So most of the core systems are in now.'),
(17, 92213407, '2015-10-26 12:03:25', '2015-10-26 12:03:25', '#1|@#1', 'Project status', 'So most of the core systems are in now.'),
(18, 92213408, '2015-10-26 12:08:41', '2015-10-26 12:08:41', '@1|', 'Removal Vote', '<span class=''error''>Voted to remove 92213410</span>'),
(19, 92213408, '2015-10-26 12:08:55', '2015-10-26 12:08:55', '@1|', 'Removal Vote', '<span class=''error''>Voted to remove 92213410</span>'),
(20, 92213407, '2015-10-26 12:18:13', '2015-10-26 12:18:13', '@1|', 'Add Vote', '<span class=''sucess''>Voted to reject 81908605</span>'),
(21, 92213407, '2015-10-26 12:18:20', '2015-10-26 12:18:20', '@1|', 'Add Vote', '<span class=''sucess''>Voted to add 81908605</span>'),
(22, 92213407, '2015-10-26 12:59:24', '2015-10-26 12:59:24', '#1|@1|', 'File uploaded', 'matrixmultiplier.txt was uploaded.'),
(23, 92213407, '2015-10-26 12:59:55', '2015-10-26 12:59:55', '#1|@1|', 'File Deleted', 'matrixmultiplier.txt was Deleted.'),
(24, 92213408, '2015-10-26 13:20:19', '2015-10-26 13:20:19', '#1|@1|', 'Milestone UnCompleted', '<span class=error> what </span>'),
(25, 92213408, '2015-10-26 13:20:20', '2015-10-26 13:20:20', '#1|@1|', 'Milestone Completed', '<span class=sucess> what </span>'),
(26, 92213408, '2015-10-26 13:20:22', '2015-10-26 13:20:22', '#1|@1|', 'Milestone Completed', '<span class=sucess> what </span>'),
(27, 92213408, '2015-10-26 14:23:48', '2015-10-26 14:23:48', '#8|@8|', 'Milestone UnCompleted', '<span class=error> what </span>'),
(28, 92213408, '2015-10-26 15:04:20', '2015-10-26 15:04:20', '@1|', 'Add Vote', '<span class=''sucess''>Voted to reject 81908605</span>'),
(29, 92213408, '2015-10-26 20:26:47', '2015-10-26 20:26:47', '#1|@1|', 'Milestone UnCompleted', '<span class=error> what </span>'),
(30, 92213411, '2015-10-27 01:16:52', '2015-10-27 01:16:52', '#8|@8|', 'Milestone UnCompleted', '<span class=error> what </span>'),
(31, 92213411, '2015-10-27 01:16:55', '2015-10-27 01:16:55', '#8|@8|', 'Milestone Completed', '<span class=sucess> what </span>'),
(32, 92213408, '2015-10-27 02:00:57', '2015-10-27 02:00:57', '#1|@1|', 'Name Change', 'The Groups name has been changed to ''Null'''),
(33, 92213408, '2015-10-27 03:48:05', '2015-10-27 03:48:05', '#1|@1|', 'Milestone UnCompleted', '<span class=error> what </span>'),
(34, 92213408, '2015-10-27 03:50:20', '2015-10-27 03:50:20', '@9|', 'Add Vote', '<span class=''sucess''>Voted to add 81986746</span>'),
(35, 92213408, '2015-10-27 03:50:28', '2015-10-27 03:50:28', '@9|', 'Removal Vote', '<span class=''error''>Voted to remove 92213407</span>'),
(36, 92213408, '2015-10-27 04:05:31', '2015-10-27 04:05:31', '@1|', 'Removal Vote', '<span class=''error''>Voted to remove 92213407</span>'),
(37, 92213408, '2015-10-27 04:26:26', '2015-10-27 04:26:26', '@1|', 'Removal Vote', '<span class=''error''>Voted to Keep 92213407</span>'),
(38, 92213408, '2015-10-27 04:26:30', '2015-10-27 04:26:30', '@1|', 'Removal Vote', '<span class=''error''>Voted to remove 92213407</span>'),
(39, 92213407, '2015-10-27 04:33:45', '2015-10-27 04:33:45', '#1|@1|', 'Member Added', '<span class=''sucess''>Unit staff added 81986746 to the group.</span>'),
(40, 92213407, '2015-10-27 04:33:55', '2015-10-27 04:33:55', '#1|@1|', 'Member Evicted', '<span class=''error''>Unit Staff removed 81986746 from the group.</span>'),
(41, 92213408, '2015-10-27 04:54:34', '2015-10-27 04:54:34', '#1|@1|', 'Milestone Completed', '<span class=sucess> what </span>'),
(42, 92213408, '2015-10-27 04:54:40', '2015-10-27 04:54:40', '#1|@1|', 'Milestone UnCompleted', '<span class=error> what </span>'),
(43, 92213408, '2015-10-27 05:29:27', '2015-10-27 05:29:27', '#1|@1|', 'Kicking Vote Cancelled', '<span class=''error''>Unit Staff cancelled the vote to kick 92213407 from the group.</span>'),
(44, 92213408, '2015-10-27 05:52:13', '2015-10-27 05:52:13', '#1|@1|', 'Milestone Completed', '<span class=sucess> what </span>'),
(45, 92213408, '2015-10-27 05:52:16', '2015-10-27 05:52:16', '#1|@1|', 'Milestone UnCompleted', '<span class=error> what </span>'),
(46, 92213408, '2015-10-27 05:52:44', '2015-10-27 05:52:44', '#1|@1|', 'Milestone Completed', '<span class=sucess> what </span>'),
(47, 92213408, '2015-10-27 05:52:46', '2015-10-27 05:52:46', '#1|@1|', 'Milestone UnCompleted', '<span class=error> what </span>'),
(48, 92213408, '2015-10-27 06:58:16', '2015-10-27 06:58:16', '#10|@10|', 'Member Evicted', '<span class=''error''>Unit Staff removed 81087636 from the group.</span>'),
(49, 92213408, '2015-10-27 07:02:08', '2015-10-27 07:02:08', '#10|@10|', 'Member Added', '<span class=''sucess''>Unit staff added 81908605 to the group.</span>'),
(50, 92213408, '2015-10-27 07:02:36', '2015-10-27 07:02:36', '#10|@10|', 'Member Added', '<span class=''sucess''>Unit staff added 81087636 to the group.</span>'),
(51, 92213408, '2015-10-27 07:03:35', '2015-10-27 07:03:35', '#10|@10|', 'Member Evicted', '<span class=''error''>Unit Staff removed 81087636 from the group.</span>'),
(52, 92213408, '2015-10-27 07:03:42', '2015-10-27 07:03:42', '#10|@10|', 'Member Added', '<span class=''sucess''>Unit staff added 81087636 to the group.</span>'),
(53, 92213408, '2015-10-27 07:06:49', '2015-10-27 07:06:49', '#10|@10|', 'Member Evicted', '<span class=''error''>Unit Staff removed 81087636 from the group.</span>'),
(54, 92213407, '2015-10-27 07:46:16', '2015-10-27 07:46:16', '#10|@10|', 'Member Added', '<span class=''sucess''>Unit staff added 81087636 to the group.</span>'),
(55, 92213407, '2015-10-27 07:47:34', '2015-10-27 07:47:34', '#10|@10|', 'Member Added', '<span class=''sucess''>Unit staff added 81908605 to the group.</span>'),
(56, 92213407, '2015-10-27 07:49:01', '2015-10-27 07:49:01', '#15|@15|', 'Name Change', 'The Groups name has been changed to ''Automated Tech'''),
(57, 92213407, '2015-10-27 07:51:38', '2015-10-27 07:51:38', '@15|@@15', 'Group Creation', 'So i made automated group creation much better :D'),
(58, 92213407, '2015-10-27 07:51:38', '2015-10-27 07:51:38', '#15|@#15', 'Group Creation', 'So i made automated group creation much better :D'),
(59, 92213407, '2015-10-27 07:52:38', '2015-10-27 07:52:38', '@15|@@15', 'Group forming', 'I''m gonna move the auto group forming button to the admin page'),
(60, 92213407, '2015-10-27 07:52:38', '2015-10-27 07:52:38', '#15|@#15', 'Group forming', 'I''m gonna move the auto group forming button to the admin page'),
(61, 92213408, '2015-10-27 08:57:37', '2015-10-27 08:57:37', '#1|@1|', 'Milestone Completed', '<span class=sucess>"test milestone"</span>'),
(62, 92213408, '2015-10-27 08:58:40', '2015-10-27 08:58:40', '#1|@1|', 'Milestone UnCompleted', '<span class=error>"test milestone"</span>'),
(63, 92213408, '2015-10-27 08:59:53', '2015-10-27 08:59:53', '#1|@1|', 'Milestone UnCompleted', '<span class=error>"test milestone"</span>'),
(64, 92213408, '2015-10-27 08:59:59', '2015-10-27 08:59:59', '#1|@1|', 'Milestone Completed', '<span class=sucess>"test milestone"</span>'),
(65, 92213408, '2015-10-27 09:10:39', '2015-10-27 09:10:39', '#1|@1|', 'Milestone Completed', '<span class=sucess>"Hand in project plan"</span>'),
(66, 92213408, '2015-10-27 09:10:41', '2015-10-27 09:10:41', '#1|@1|', 'Milestone UnCompleted', '<span class=error>"Hand in project plan"</span>'),
(67, 92213408, '2015-10-27 10:16:20', '2015-10-27 10:16:20', '#1|@1|', 'Milestone Completed', '<span class=sucess>"testMilestone"</span>'),
(68, 92213408, '2015-10-27 10:16:34', '2015-10-27 10:16:34', '#1|@1|', 'Milestone UnCompleted', '<span class=error>"testMilestone"</span>'),
(69, 92213408, '2015-10-27 10:53:41', '2015-10-27 10:53:41', '#15|@15|', 'Member Evicted', '<span class=''error''>Unit Staff removed 92213411 from the group.</span>'),
(70, 92213408, '2015-10-27 10:54:00', '2015-10-27 10:54:00', '#1|@1|', 'Milestone Completed', '<span class=sucess>"You can delete these now!''''"</span>'),
(71, 92213408, '2015-10-27 11:11:38', '2015-10-27 11:11:38', '#15|@15|', 'Member Added', '<span class=''sucess''>Unit staff added 92213411 to the group.</span>'),
(72, 92213413, '2015-10-27 11:29:03', '2015-10-27 11:29:03', '#17|@17|', 'Name Change', 'The Groups name has been changed to ''bob'''),
(73, 92213413, '2015-10-27 11:30:08', '2015-10-27 11:30:08', '#17|@17|', 'Member Quit', '<span class=''error''>emmaa quit Group 17: bob</span>'),
(74, 92213412, '2015-10-27 11:33:16', '2015-10-27 11:33:16', '@18|', 'Add Vote', '<span class=''sucess''>Voted to add 92213413</span>'),
(75, 92213412, '2015-10-27 11:33:16', '2015-10-27 11:33:16', '#18|@18|', 'Add vote completion', '<span class=''sucess''>The group added 92213413</span>'),
(76, 92213412, '2015-10-27 11:34:16', '2015-10-27 11:34:16', '@18|', 'Add Vote', '<span class=''sucess''>Voted to add 75560985</span>'),
(77, 92213413, '2015-10-27 11:34:28', '2015-10-27 11:34:28', '@18|', 'Add Vote', '<span class=''sucess''>Voted to reject 75560985</span>'),
(78, 92213413, '2015-10-27 11:34:28', '2015-10-27 11:34:28', '#18|@18|', 'Add vote completion', 'The group rejected 75560985'),
(79, 92213412, '2015-10-27 11:35:39', '2015-10-27 11:35:39', '@18|', 'Add Vote', '<span class=''sucess''>Voted to add 75560985</span>'),
(80, 92213413, '2015-10-27 11:35:44', '2015-10-27 11:35:44', '@18|', 'Add Vote', '<span class=''sucess''>Voted to reject 75560985</span>'),
(81, 92213413, '2015-10-27 11:35:44', '2015-10-27 11:35:44', '#18|@18|', 'Add vote completion', 'The group rejected 75560985'),
(82, 92213413, '2015-10-27 11:36:10', '2015-10-27 11:36:10', '@18|', 'Add Vote', '<span class=''sucess''>Voted to add 75560985</span>'),
(83, 92213412, '2015-10-27 11:36:23', '2015-10-27 11:36:23', '@18|', 'Add Vote', '<span class=''sucess''>Voted to add 75560985</span>'),
(84, 92213412, '2015-10-27 11:36:23', '2015-10-27 11:36:23', '#18|@18|', 'Add vote completion', '<span class=''sucess''>The group added 75560985</span>'),
(85, 92213412, '2015-10-27 11:37:54', '2015-10-27 11:37:54', '@18|', 'Removal Vote', '<span class=''error''>Voted to remove 75560985</span>'),
(86, 92213413, '2015-10-27 11:38:09', '2015-10-27 11:38:09', '@18|', 'Removal Vote', '<span class=''error''>Voted to remove 75560985</span>'),
(87, 92213413, '2015-10-27 11:38:09', '2015-10-27 11:38:09', '#18|@18|', 'Removal vote completion', '<span class=''error''>The group removed 75560985</span>'),
(88, 92213413, '2015-10-27 11:39:37', '2015-10-27 11:39:37', '@18|', 'Add Vote', '<span class=''sucess''>Voted to add 75560985</span>'),
(89, 92213412, '2015-10-27 11:39:51', '2015-10-27 11:39:51', '@18|', 'Add Vote', '<span class=''sucess''>Voted to add 75560985</span>'),
(90, 92213412, '2015-10-27 11:39:51', '2015-10-27 11:39:51', '#18|@18|', 'Add vote completion', '<span class=''sucess''>The group added 75560985</span>'),
(91, 92213412, '2015-10-27 11:39:55', '2015-10-27 11:39:55', '@18|', 'Removal Vote', '<span class=''error''>Voted to remove 75560985</span>'),
(92, 92213413, '2015-10-27 11:40:07', '2015-10-27 11:40:07', '@18|', 'Removal Vote', '<span class=''error''>Voted to Keep 75560985</span>'),
(93, 92213413, '2015-10-27 11:40:07', '2015-10-27 11:40:07', '#18|@18|', 'Removal vote completion', '<span class=''error''>The group kept 75560985</span>'),
(94, 92213412, '2015-10-27 11:43:32', '2015-10-27 11:43:32', '#18|@18|', 'File uploaded', 'Untitled.png was uploaded.'),
(95, 92213407, '2015-10-27 11:49:09', '2015-10-27 11:49:09', '#1|@1|', 'File uploaded', 'site.txt was uploaded.'),
(96, 92213407, '2015-10-27 12:05:58', '2015-10-27 12:05:58', '@1|', 'Removal Vote', '<span class=''error''>Voted to remove 92213410</span>'),
(97, 92213407, '2015-10-27 12:06:01', '2015-10-27 12:06:01', '@1|', 'Removal Vote', '<span class=''error''>Voted to Keep 92213410</span>'),
(98, 92213407, '2015-10-27 12:06:09', '2015-10-27 12:06:09', '@1|', 'Add Vote', '<span class=''sucess''>Voted to reject 81908605</span>'),
(99, 92213407, '2015-10-27 12:06:11', '2015-10-27 12:06:11', '@1|', 'Add Vote', '<span class=''sucess''>Voted to add 81908605</span>'),
(100, 92213413, '2015-10-27 12:24:30', '2015-10-27 12:24:30', '#18|@#18', 'New post', 'test'),
(101, 92213407, '2015-10-27 12:45:35', '2015-10-27 12:45:35', '#1|@1|', 'Name Change', 'The Groups name has been changed to ''Nullifier'''),
(102, 92213407, '2015-10-27 12:48:35', '2015-10-27 12:48:35', '#1|@1|', 'Name Change', 'The Groups name has been changed to ''Null'''),
(103, 92213407, '2015-10-27 14:00:17', '2015-10-27 14:00:17', '#8|@8|', 'Tutor Assigned', 'jesh is now this group''s allocated tutor.'),
(104, 92213407, '2015-10-27 14:00:24', '2015-10-27 14:00:24', '#8|@8|', 'Tutor Assigned', 'emma is now this group''s allocated tutor.'),
(105, 92213407, '2015-10-27 14:10:09', '2015-10-27 14:10:09', '#6|@6|', 'Tutor Assigned', 'jesh is now this group''s allocated tutor.'),
(106, 92213408, '2015-10-28 00:58:48', '2015-10-28 00:58:48', '#15|@15|', 'File uploaded', '38.0.2125.104.manifest was uploaded.'),
(107, 92213408, '2015-10-28 00:59:34', '2015-10-28 00:59:34', '#15|@15|', 'Milestone Completed', '<span class=sucess>"milestone"</span>'),
(108, 92213408, '2015-10-28 01:00:04', '2015-10-28 01:00:04', '#15|@15|', 'Milestone Completed', '<span class=sucess>"technology mannn"</span>'),
(109, 92213408, '2015-10-28 01:15:25', '2015-10-28 01:15:25', '#15|@15|', 'Milestone Completed', '<span class=sucess>"milestone 2"</span>'),
(110, 92213408, '2015-10-28 01:50:36', '2015-10-28 01:50:36', '#15|@15|', 'Milestone Completed', '<span class=sucess>"project report"</span>'),
(111, 92213408, '2015-10-28 02:09:22', '2015-10-28 02:09:22', '#15|@15|', 'Milestone Completed', '<span class=sucess>"delete project"</span>'),
(112, 92213407, '2015-10-28 04:19:14', '2015-10-28 04:19:14', '#1|@1|', 'New Member Rejected', 'Unit Staff rejected 81908605 joining the group.'),
(113, 92213407, '2015-10-28 04:26:57', '2015-10-28 04:26:57', '#1|@1|', 'Milestone Completed', '<span class=sucess>"Create Team Contract"</span>'),
(114, 92213407, '2015-10-28 04:40:36', '2015-10-28 04:40:36', '#6|@6|', 'Tutor Assigned', 'emma is now this group''s allocated tutor.'),
(115, 92213407, '2015-10-28 08:06:08', '2015-10-28 08:06:08', '#1|@1|', 'File Deleted', 'README_0.md was Deleted.'),
(116, 92213407, '2015-10-28 08:06:09', '2015-10-28 08:06:09', '#1|@1|', 'File Deleted', '1380078_10201429769764479_2054867537_n.jpg was Deleted.'),
(117, 92213407, '2015-10-28 08:06:11', '2015-10-28 08:06:11', '#1|@1|', 'File Deleted', 'lowresman.png was Deleted.'),
(118, 92213407, '2015-10-28 08:06:13', '2015-10-28 08:06:13', '#1|@1|', 'File Deleted', 'studentlistforteamworker.csv was Deleted.'),
(119, 92213407, '2015-10-28 08:06:14', '2015-10-28 08:06:14', '#1|@1|', 'File Deleted', 'test2.jpg was Deleted.'),
(120, 92213407, '2015-10-28 08:06:15', '2015-10-28 08:06:15', '#1|@1|', 'File Deleted', 'site.txt was Deleted.'),
(121, 92213407, '2015-10-28 08:06:45', '2015-10-28 08:06:45', '#15|@15|', 'File Deleted', '38.0.2125.104.manifest was Deleted.'),
(122, 92213407, '2015-10-28 08:10:11', '2015-10-28 08:10:11', '#18|@18|', 'File Deleted', 'Untitled.png was Deleted.'),
(123, 92213407, '2015-10-28 08:19:16', '2015-10-28 08:19:16', '#15|@15|', 'Tutor Assigned', 'tutor is now this group''s allocated tutor.'),
(124, 92213407, '2015-10-28 08:19:31', '2015-10-28 08:19:31', '#1|@1|', 'Tutor Assigned', 'yuefengli is now this group''s allocated tutor.'),
(125, 92213407, '2015-10-28 08:20:01', '2015-10-28 08:20:01', '#1|@1|', 'Member Evicted', '<span class=''error''>Unit Staff removed 92213410 from the group.</span>'),
(126, 92213408, '2015-11-25 04:51:48', '2015-11-25 04:51:48', '#1|@1|', 'Milestone UnCompleted', '<span class=error>"test milestone"</span>');

-- --------------------------------------------------------

--
-- Table structure for table `D_Media`
--

CREATE TABLE IF NOT EXISTS `D_Media` (
  `media_id` int(11) NOT NULL,
  `location` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `owner` int(11) NOT NULL,
  `share` smallint(6) NOT NULL,
  `people` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=54 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `D_Perms`
--

CREATE TABLE IF NOT EXISTS `D_Perms` (
  `Perm_No` int(11) NOT NULL,
  `UserId` int(11) NOT NULL,
  `what` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `level` int(11) NOT NULL,
  `other` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=39 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `D_Perms`
--

INSERT INTO `D_Perms` (`Perm_No`, `UserId`, `what`, `level`, `other`) VALUES
(13, 92213407, 'INB302', 2, ''),
(10, 92213407, 'Admin', 1, ''),
(36, 92213416, 'INB302', 2, ''),
(35, 92213412, 'INB302', 1, ''),
(29, 92213414, 'Admin', 1, ''),
(17, 92213409, 'INB300', 1, ''),
(37, 92213417, 'INB302', 1, ''),
(38, 92213408, 'INB302', 2, '');

-- --------------------------------------------------------

--
-- Table structure for table `Groups`
--

CREATE TABLE IF NOT EXISTS `Groups` (
  `GroupId` int(11) NOT NULL,
  `GroupName` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `GroupProject` int(11) NOT NULL,
  `UnitCode` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `Supervisor` int(11) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `Groups`
--

INSERT INTO `Groups` (`GroupId`, `GroupName`, `GroupProject`, `UnitCode`, `Supervisor`) VALUES
(1, 'Null', 1, 'INB302', 92213416),
(8, 'INB302 G8', 1, 'INB302', 92213412),
(6, 'INB302 G6', 0, 'INB302', 92213412),
(9, 'INB302 G9', 0, 'INB302', 92213408),
(10, 'INB302 G10', 0, 'INB302', 92213407),
(16, 'null', 0, 'INB300', 0),
(15, 'Automated Tech', 3, 'INB302', 92213417),
(18, 'bob', 0, 'INB302', 0);

-- --------------------------------------------------------

--
-- Table structure for table `Group_Members`
--

CREATE TABLE IF NOT EXISTS `Group_Members` (
  `GroupId` int(11) NOT NULL,
  `UserId` int(11) NOT NULL,
  `Role` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `Group_Members`
--

INSERT INTO `Group_Members` (`GroupId`, `UserId`, `Role`) VALUES
(1, 92213407, NULL),
(1, 92213408, NULL),
(1, 92213409, NULL),
(1, 92213413, NULL),
(9, 92213407, NULL),
(8, 81908605, NULL),
(8, 92213411, NULL),
(8, 92213408, NULL),
(8, 92213409, NULL),
(10, 81087636, NULL),
(16, 92213412, NULL),
(6, 81986746, NULL),
(6, 81087636, NULL),
(9, 92213409, NULL),
(9, 92213408, NULL),
(9, 92213411, NULL),
(10, 81908605, NULL),
(10, 81986746, NULL),
(15, 92213408, NULL),
(15, 92213411, NULL),
(15, 92213407, NULL),
(18, 92213413, NULL),
(18, 92213412, NULL),
(18, 75560985, NULL),
(1, 92213411, NULL),
(1, 92213418, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `Group_Mod`
--

CREATE TABLE IF NOT EXISTS `Group_Mod` (
  `User_Id` int(11) NOT NULL,
  `Group_Id` int(11) NOT NULL,
  `Action` enum('Add','Remove','Cancel','Deny') COLLATE utf8_unicode_ci NOT NULL,
  `Who` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `Group_Mod`
--

INSERT INTO `Group_Mod` (`User_Id`, `Group_Id`, `Action`, `Who`) VALUES
(92213407, 1, 'Remove', 92213408),
(92213408, 9, 'Add', 81986746),
(92213408, 9, 'Remove', 92213407);

-- --------------------------------------------------------

--
-- Table structure for table `Group_Requests`
--

CREATE TABLE IF NOT EXISTS `Group_Requests` (
  `UserId` int(11) NOT NULL,
  `UnitCode` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `Similar` int(1) NOT NULL,
  `PreferenceType1` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `PreferenceType2` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `PreferenceType3` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `Group_Requests`
--

INSERT INTO `Group_Requests` (`UserId`, `UnitCode`, `Similar`, `PreferenceType1`, `PreferenceType2`, `PreferenceType3`) VALUES
(92213408, 'INB302', 0, 'any', 'Application', 'Database'),
(92213413, 'INB302', 1, 'Development', 'Application', 'Research'),
(92213407, 'INB302', 0, 'Web', '', ''),
(92213409, 'INB302', 0, 'Web', 'forty-two', ''),
(92213408, 'INB375', 1, 'Application', 'Database', 'Research'),
(92213408, 'IAB330', 0, 'Analysis', 'Database', 'any');

-- --------------------------------------------------------

--
-- Table structure for table `Milestones`
--

CREATE TABLE IF NOT EXISTS `Milestones` (
  `MID` int(11) NOT NULL,
  `GroupId` int(11) DEFAULT NULL,
  `Content` text COLLATE utf8_unicode_ci,
  `Checked` int(1) DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `Milestones`
--

INSERT INTO `Milestones` (`MID`, `GroupId`, `Content`, `Checked`) VALUES
(1, 1, 'test milestone', 0),
(19, 15, 'delete project', 1),
(3, 1, 'yeee lad', 1),
(6, 1, 'Hand in project plan', 0),
(7, 8, 'group 8 milestones ayyyyyyyyyy', 0),
(8, 8, 'yo but make sure u get the cheese', 1),
(9, 1, 'Create Team Contract', 1),
(10, 1, 'New milestone', 0),
(11, 1, 'another milestone', 0),
(14, 1, 'You can delete these now!''''', 1),
(17, 15, 'hand in project', 0),
(16, 15, 'milestone 2', 1),
(18, 15, 'project report', 1),
(5, 1, 'Create project plan', 0);

-- --------------------------------------------------------

--
-- Table structure for table `Projects`
--

CREATE TABLE IF NOT EXISTS `Projects` (
  `P_Id` int(11) NOT NULL,
  `Name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `ProjectType1` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `ProjectType2` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ProjectType3` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Description` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `skill` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `requirements` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `UnitCode` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `Supervisor` int(11) NOT NULL,
  `Start` date NOT NULL,
  `End` date NOT NULL,
  `Dueby` date NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `Projects`
--

INSERT INTO `Projects` (`P_Id`, `Name`, `ProjectType1`, `ProjectType2`, `ProjectType3`, `Description`, `skill`, `requirements`, `UnitCode`, `Supervisor`, `Start`, `End`, `Dueby`) VALUES
(1, 'Teamwork', 'Web', 'Development', 'Application', 'Create a web system for qut to manage industry placements. This system will have a section for teams to work on projects together and must be better than inplace.', 'web,css,php,etc', 'Web programming skills and good user interface design.', 'INB302', 1, '2015-08-03', '2015-10-23', '2015-08-02'),
(0, 'Not Selected', '', NULL, NULL, '', '', '', '', 0, '0000-00-00', '0000-00-00', '0000-00-00'),
(3, 'Bird Watch', 'Development', 'Application', 'Database', 'Create an android application to log species of bird in the wild. Will primarily be used by Australian icon Troy Bundaberg,', 'java,xml,sql', 'Previous application development experience', 'INB302', 1, '2015-08-10', '2015-09-30', '2015-08-02'),
(4, 'Accounting Software', 'Development', 'Web', 'Application', 'Create a website to manage accounting things, must be better than MYOB.', 'html,css,php,mysql', 'Must be very scaleable', 'INB300', 2, '2015-08-05', '2015-11-30', '2015-08-02'),
(16, 'Project Title (meta)', 'Analysis', 'Development', 'Database', 'It is good project yes please do this for me it is much fun yes', 'Nunchuck skills', 'All the things', 'INB304', 1, '2015-10-16', '2015-10-15', '2015-10-14'),
(17, 'test project mang', 'any', 'any', 'any', 'this project involved free credit poitns fdvdsfgf dgsfdg fdsg fdsg fd', 'none at all', 'none', 'INB302', 2, '2015-10-24', '2015-10-27', '2015-10-30');

-- --------------------------------------------------------

--
-- Table structure for table `Project_Applications`
--

CREATE TABLE IF NOT EXISTS `Project_Applications` (
  `ApplicationID` int(11) NOT NULL,
  `P_Id` int(11) DEFAULT NULL,
  `GroupId` int(11) DEFAULT NULL,
  `CoverLetter` text COLLATE utf8_unicode_ci,
  `Status` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `TimeSubmitted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM AUTO_INCREMENT=37 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `Project_Applications`
--

INSERT INTO `Project_Applications` (`ApplicationID`, `P_Id`, `GroupId`, `CoverLetter`, `Status`, `TimeSubmitted`) VALUES
(31, 17, 15, 'cover letter #2', 'Applied', '2015-10-28 01:03:12'),
(36, 3, 15, 'this one', 'StudentAccepted', '2015-10-28 04:35:25'),
(26, 3, 9, 'cover letter', 'SupervisorAccepted', '2015-10-27 10:24:59'),
(27, 3, 9, 'cover letter', 'Applied', '2015-10-27 10:23:08'),
(34, 1, 15, '', 'Applied', '2015-10-28 02:25:51'),
(35, 1, 1, 'yuefeng li\r\n', 'StudentAccepted', '2015-10-28 08:26:31'),
(3, 4, 1, 'this is a cover letter man', 'Applied', '2015-10-21 02:14:01'),
(4, 1, 8, 'i rlly need this project to begin my career in rocket ship designing. I will build mega website, will be fantastic friend.', 'StudentAccepted', '2015-10-23 11:51:28'),
(5, 1, 9, 'excellent time to upgrade your solar, save money now with our exclusive limited time all year round offer, 2 solar panels for the price of 3, never before has anyone had a deal this good.', 'SupervisorDeclined', '2015-10-26 06:42:21'),
(6, 3, 8, 'bjkjgjkgjkgtjkgjgjkgtjkgtgtkjgtkjcvoreer lettert', 'SupervisorAccepted', '2015-10-26 06:04:04'),
(22, 17, 1, 'test ur project ay', 'Applied', '2015-10-26 11:02:09');

-- --------------------------------------------------------

--
-- Table structure for table `Project_Types`
--

CREATE TABLE IF NOT EXISTS `Project_Types` (
  `type` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `Project_Types`
--

INSERT INTO `Project_Types` (`type`) VALUES
('Analysis'),
('Application'),
('Database'),
('Development'),
('Research'),
('Web');

-- --------------------------------------------------------

--
-- Table structure for table `Supervisor`
--

CREATE TABLE IF NOT EXISTS `Supervisor` (
  `SupervisorID` int(11) NOT NULL,
  `Username` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `FirstName` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Surname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Salt` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `Supervisor`
--

INSERT INTO `Supervisor` (`SupervisorID`, `Username`, `FirstName`, `Surname`, `Email`, `Password`, `Salt`) VALUES
(2, 'test', 'test', 'test', 'dsfsdf@fdslj.com', '277c737c1c70537cf6ad7f4e78463960', 'š%‹Àí|ÒçÁÀ|�Õ§â¥·j.ûÖåÇå7`¢˜Š%«"¦T§©s¹ÅæXÈ¤šN}B×/Ÿÿ ŒŸ'),
(1, 'josh', 'Joshua', 'Henley', 'josh@joshuahenley.com', '293ed2260ca2afa857e52eabc122b229', 'ËVÁ]%`Xi!.X€¯Ùãá¿ƒJéFíÚTÑOdøÒ”ÄË†ƒ+HægtNœÁ’¡•Q×4ú­ÆŸÝ*ß²*™×'),
(0, 'none', 'n/a', 'n/a', 'n/a', 'n/a', 'n/a'),
(12, 'supervisor', 'Super', 'Visor', 'super@visor.com', 'f78ca09d30a8ac7243836d684d97a7d7', 'j J¨…Mâ(§©éjLø3`èõOËz©fÝ§ºcü²½Mqÿ“l\0Ç\ndãWûz±ûÚÞå)<ÈûÄ# S^’');

-- --------------------------------------------------------

--
-- Table structure for table `Unit`
--

CREATE TABLE IF NOT EXISTS `Unit` (
  `UnitCode` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `Unit` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `Unit`
--

INSERT INTO `Unit` (`UnitCode`, `Unit`) VALUES
('INB302', 'IT Capstone Project'),
('INB300', 'Professional Practice in IT'),
('IAB330', 'Mobile App'),
('INB375', 'Parallel Computing'),
('Admin', 'QUT Admin'),
('INB301', 'The Business of IT');

-- --------------------------------------------------------

--
-- Table structure for table `User_Details`
--

CREATE TABLE IF NOT EXISTS `User_Details` (
  `UserId` int(11) NOT NULL,
  `GPA` decimal(7,1) DEFAULT NULL,
  `Skills` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `Blurb` text COLLATE utf8_unicode_ci NOT NULL,
  `LinkedIn` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Email` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Facebook` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Skype` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Phone` varchar(12) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `User_Details`
--

INSERT INTO `User_Details` (`UserId`, `GPA`, `Skills`, `Blurb`, `LinkedIn`, `Email`, `Facebook`, `Skype`, `Phone`) VALUES
(92213409, '6.0', '', 'doklfjdslk jdslkf jadslfjk asldjkf lkdsj lk', NULL, NULL, NULL, 'person', '405141011'),
(92213407, '5.9', 'Coding, Php, Python, C#, C++, Java, SQL', '1000 Starting in 1894, Tesla began investigating what he referred to as radiant energy of "invisible" kinds after he had noticed damaged film in his laboratory in previous experiments[84][85] (later identified as "Roentgen rays" or "X-Rays"). His early experiments were with Crookes tubes, a cold cathode electrical discharge tube. Soon after, much of Tesla''s early research—hundreds of invention models, plans, notes, laboratory data, tools, photographs, valued at $50,000—was lost in the 5th Avenue laboratory fire of March 1895. Tesla is quoted by The New York Times as saying, "I am in too much grief to talk. What can I say?"[86] Tesla may have inadvertently captured an X-ray image (predating Wilhelm Röntgen''s December 1895 announcement of the discovery of x-rays by a few weeks) when he tried to photograph Mark Twain illuminated by a Geissler tube, an earlier type of gas discharge tube. The only thing captured in the image was the metal locking screw on the camera lens.[10]:134', 'AAIAABgh6WUBfFVnI-Qenit7oiphAiyoIjAcO6I', 'dittopower@gmail.com', 'dittopower', 'dittopower', '466971872'),
(92213408, '7.0', 'PHP, SQL, HTML, CSS, Javascript, JQuery', 'My strongest skills are in web design. I can code using a variety of different programming languages and have built many systems before.', 'AAMAABsl7QoBSP1AFW5tJTxeT9x6NmoLY5zrv2c', 'josh@joshuahenley.com', 'joshuahenley', 'jesh2222222', '0405141011'),
(81087636, '4.0', '', '', NULL, NULL, NULL, NULL, '404040404'),
(81986746, '4.0', '', '', NULL, NULL, NULL, NULL, '2147483647'),
(81908605, '3.6', '', '', NULL, NULL, NULL, NULL, '2147483647'),
(92213411, '5.5', '', 'testerino', 'Declan-Winter', 'cool@guy.com.au', 'declan.winter.9', 'hotticket', '400777000'),
(92213412, '7.0', 'Research, Beign cool', 'i''m REALLY cool', '', 'emma@emma.com', 'ema', 'emma', '0411111111'),
(92213413, '4.0', 'Kinda nice', 'wahtever', '', 'test@test.com', 'emmmmmm', 'emmm', '0411111111'),
(92213414, '7.0', 'Everything', 'have a guess, i''m the best system admin.', '', 'icloud@outlook.com', '', 'echo123', '0466666666'),
(92213416, '4.0', '', 'A good supervisor', '', 'y2.li@qut.edu.au', '', '', '0000000000'),
(92213418, '6.5', 'Programming, Networking, Css, Html, Sql', 'I really enjoy cooking and also creating complex information systems to be used in the real world.', '', 'email@email.com', 'facebook', 'skype.name', '0405141022'),
(92213417, '5.6', 'Html, Css, Php', 'I really enjoy watching movies about steve jobs and his life, I am a tutor also.', '', 'tutor@tutor.com', 'fffffffffffff', 'skypeee.nameeee', '0425215444');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Chat`
--
ALTER TABLE `Chat`
  ADD PRIMARY KEY (`ChatID`);

--
-- Indexes for table `D_Accounts`
--
ALTER TABLE `D_Accounts`
  ADD PRIMARY KEY (`UserId`), ADD UNIQUE KEY `usernames` (`Username`), ADD KEY `Username` (`Username`);

--
-- Indexes for table `D_Articles`
--
ALTER TABLE `D_Articles`
  ADD PRIMARY KEY (`art_id`), ADD UNIQUE KEY `art_id` (`art_id`);

--
-- Indexes for table `D_Media`
--
ALTER TABLE `D_Media`
  ADD PRIMARY KEY (`media_id`);

--
-- Indexes for table `D_Perms`
--
ALTER TABLE `D_Perms`
  ADD PRIMARY KEY (`Perm_No`), ADD KEY `UserId` (`UserId`);

--
-- Indexes for table `Groups`
--
ALTER TABLE `Groups`
  ADD PRIMARY KEY (`GroupId`);

--
-- Indexes for table `Group_Members`
--
ALTER TABLE `Group_Members`
  ADD PRIMARY KEY (`GroupId`,`UserId`);

--
-- Indexes for table `Group_Mod`
--
ALTER TABLE `Group_Mod`
  ADD PRIMARY KEY (`User_Id`,`Group_Id`,`Who`);

--
-- Indexes for table `Group_Requests`
--
ALTER TABLE `Group_Requests`
  ADD PRIMARY KEY (`UserId`,`UnitCode`);

--
-- Indexes for table `Milestones`
--
ALTER TABLE `Milestones`
  ADD PRIMARY KEY (`MID`);

--
-- Indexes for table `Projects`
--
ALTER TABLE `Projects`
  ADD PRIMARY KEY (`P_Id`);

--
-- Indexes for table `Project_Applications`
--
ALTER TABLE `Project_Applications`
  ADD PRIMARY KEY (`ApplicationID`);

--
-- Indexes for table `Project_Types`
--
ALTER TABLE `Project_Types`
  ADD PRIMARY KEY (`type`);

--
-- Indexes for table `Supervisor`
--
ALTER TABLE `Supervisor`
  ADD PRIMARY KEY (`SupervisorID`);

--
-- Indexes for table `Unit`
--
ALTER TABLE `Unit`
  ADD PRIMARY KEY (`UnitCode`);

--
-- Indexes for table `User_Details`
--
ALTER TABLE `User_Details`
  ADD PRIMARY KEY (`UserId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Chat`
--
ALTER TABLE `Chat`
  MODIFY `ChatID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=58;
--
-- AUTO_INCREMENT for table `D_Accounts`
--
ALTER TABLE `D_Accounts`
  MODIFY `UserId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=92213419;
--
-- AUTO_INCREMENT for table `D_Articles`
--
ALTER TABLE `D_Articles`
  MODIFY `art_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=127;
--
-- AUTO_INCREMENT for table `D_Media`
--
ALTER TABLE `D_Media`
  MODIFY `media_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=54;
--
-- AUTO_INCREMENT for table `D_Perms`
--
ALTER TABLE `D_Perms`
  MODIFY `Perm_No` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=39;
--
-- AUTO_INCREMENT for table `Groups`
--
ALTER TABLE `Groups`
  MODIFY `GroupId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `Milestones`
--
ALTER TABLE `Milestones`
  MODIFY `MID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `Projects`
--
ALTER TABLE `Projects`
  MODIFY `P_Id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `Project_Applications`
--
ALTER TABLE `Project_Applications`
  MODIFY `ApplicationID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT for table `Supervisor`
--
ALTER TABLE `Supervisor`
  MODIFY `SupervisorID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
