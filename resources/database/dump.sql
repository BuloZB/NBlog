SET NAMES utf8;
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

CREATE TABLE `Comment` (
  `id`			int				NOT NULL AUTO_INCREMENT,
  `post_id`		int				NOT NULL,
  `author`		varchar(100)	NOT NULL,
  `text`		longtext		NOT NULL,
  `created`		datetime		NOT NULL,
  `authorEmail`	varchar(100)	NOT NULL,
  `authorUrl`	varchar(100)	DEFAULT NULL,
  `authorIp`	int				NOT NULL,
  `approved`	tinyint(1)		NOT NULL,
  `agent`		varchar(255)	NOT NULL,

  PRIMARY KEY	(`id`),
  KEY			`Comment_post_id_idx` (`post_id`),
  CONSTRAINT `Comment_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `Post`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `Comment` (`id`, `post_id`, `author`, `text`, `created`, `authorEmail`, `authorUrl`, `authorIp`, `approved`, `agent`) VALUES
(NULL,	1,	'drepo',		'<p>Well I\'da done better, but it\'s plum hard pleading a case while awaiting trial for that there incompetence. [laughing evilly] THE BIG BRAIN AM WINNING AGAIN! I AM THE GREETEST! NOW I AM LEAVING EARTH, FOR NO RAISEN! You can see how I lived before I met you. Hello, little man. I will destroy you! But existing is basically all I do!</p>',	'2010-09-13 23:05:23',	'kolar85@atlas.cz',	NULL,	85682358,	1,	'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:x.x.x) Gecko/20041107 Firefox/x.x  '),
(NULL,	1,	'admin',		'<p>Wow, you got that off the Internet? In my day, the Internet was only used to download pornography. Isn\'t it true that you have been paid for your testimony? I can explain. It\'s very valuable. I found what I need. And it\'s not friends, it\'s things. Why would a robot need to drink?</p>\r\n<p>It doesn\'t look so shiny to me. Hey, whatcha watching? Fry! Quit doing the right thing, you jerk! Too much work. Let\'s burn it and say we dumped it in the sewer.</p>',	'2010-09-13 23:05:15',	'pokorna@email.cz',	'www.pokorna.cz',	453245326,	0,	'Mozilla/5.0 (X11; U; Linux i686; en-US; rv:1.6) Gecko/20040413 Epiphany/1.2.1  '),
(NULL,	1,	'srigi',		'Maecenas dignissim enim eget dolor viverra ut dapibus purus iaculis. Fusce in suscipit velit. Aenean blandit erat vitae nunc tempor fermentum id in nulla. Nam tempor dignissim adipiscing. Phasellus odio turpis, dapibus at tempor convallis, tincidunt sit amet enim. Nunc dignissim elit convallis risus euismod non malesuada massa bibendum. Nulla sodales bibendum suscipit. In hac habitasse platea sed.',	'2010-09-30 10:25:23',	'srigi@srigi.sk',	'www.srigi.sk',	2130706433,	1,	'Mozilla/5.0 (X11; U; Linux i686; en-US; rv:1.9.2.10) Gecko/20100928 Firefox/3.6.10'),
(NULL,	1,	'Anna',			'I don\'t \'need\' to drink. I can quit anytime I want! You know the worst thing about being a slave? They make you work, but they don\'t pay you or let you go. They\'re like sex, except I\'m having them! Of all the friends I\'ve had... you\'re the first.',	'2010-09-30 10:30:38',	'anna@zeleny.dom',	NULL,	2130706433,	1,	'Mozilla/5.0 (X11; U; Linux i686; en-US; rv:1.9.2.10) Gecko/20100928 Firefox/3.6.10'),
(NULL,	2,	'developer',	'Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Fusce eros elit, fringilla ac ullamcorper.',	'2010-09-30 10:33:03',	'devel@devel.cz',	NULL,	2130706433,	1,	'Mozilla/5.0 (X11; U; Linux i686; en-US; rv:1.9.2.10) Gecko/20100928 Firefox/3.6.10'),
(NULL,	2,	'Anča',			'Nunc convallis lobortis neque, non mattis purus tincidunt sed. Integer velit urna, scelerisque ac lobortis a, elementum in metus. Etiam interdum tortor et purus convallis eu congue risus viverra. Suspendisse eget tellus sapien, ac volutpat enim. Maecenas convallis ante in elit elementum convallis. Proin cursus sapien sed odio fermentum interdum dapibus mi condimentum. Lorem ipsum dolor sit nullam.',	'2010-09-30 15:01:21',	'anna@zeleny.dom',	NULL,	2130706433,	1,	'Mozilla/5.0 (X11; U; Linux i686; en-US; rv:1.9.2.10) Gecko/20100928 Firefox/3.6.10 FirePHP/0.4');




CREATE TABLE `Post` (
  `id`				int				NOT NULL AUTO_INCREMENT,
  `user_id`			int				NOT NULL,
  `headline`		varchar(255)	NOT NULL,
  `slug`			varchar(100)	NOT NULL,
  `text`			longtext		NOT NULL,
  `status`			varchar(45)		NOT NULL,
  `commentsCount`	int				NOT NULL,
  `created`			datetime		NOT NULL,

  PRIMARY KEY	(`id`),
  UNIQUE KEY	`Post_slug_uniq` (`slug`),
  KEY			`Post_user_id_idx` (`user_id`),
  CONSTRAINT `Post_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `User` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `Post` (`id`, `headline`, `slug`, `created`, `user_id`, `text`, `status`, `commentsCount`) VALUES
(NULL,	'Lorem ipsum',				'lorem-ipsum',				'2010-09-12 20:19:29',	1,	'<p>Nulla facilisi. Donec vel velit erat. Mauris euismod commodo dolor, non tristique leo blandit at. Morbi ut mi nisl. Sed vel libero et lectus egestas adipiscing a id felis. Aliquam lobortis faucibus ligula, ac vehicula mauris sodales non. Nullam sagittis quam at tortor iaculis ac tincidunt arcu fringilla. Morbi sed risus nisl, id tincidunt neque. In erat lectus, aliquam ac vulputate et, sodales sit amet nibh. Sed consequat bibendum ultricies. Donec condimentum velit nisl, a semper felis. Etiam at diam ipsum. Duis molestie aliquet sapien, nec rutrum tellus cursus eget. Curabitur porttitor metus.</p>',	'published',	4),
(NULL,	'Fillerama',				'fillerama',				'2010-09-12 20:20:42',	1,	'<p>Fry, you can\'t just sit here in the dark listening to classical music. You seem malnourished. Are you suffering from intestinal parasites? I don\'t \'need\' to drink. I can quit anytime I want! Meh. Is that a cooking show? I haven\'t felt much of anything since my guinea pig died.</p><!--break-->\r\n<p>OK, if everyone\'s finished being stupid. And I\'d do it again! And perhaps a third time! But that would be it. That\'s a popular name today. Little \"e\", big \"B\"? It doesn\'t look so shiny to me. I had more, but you go ahead.  Ah, yes! John Quincy Adding Machine.  He struck a chord with the voters when he pledged not to go on a killing spree.</p>\r\n<p>[turns the TV back on] Bender, I didn\'t know you liked cooking. That\'s so cute. I meant \'physically\'. Look, perhaps you could let me work for a little food? I could clean the floors or paint a fence, or service you sexually? And I\'m his friend Jesus. Bender! Ship! Stop bickering or I\'m going to come back there and change your opinions manually! Hello Morbo, how\'s the family?</p>\r\n<p>Well, let\'s just dump it in the sewer and say we delivered it. Shinier than yours, meatbag. Morbo will now introduce tonight\'s candidates... PUNY HUMAN NUMBER ONE, PUNY HUMAN NUMBER TWO, and Morbo\'s good friend, Richard Nixon.</p>\r\n<p>You guys realize you live in a sewer, right? Leela, Bender, we\'re going grave robbing. Too much work. Let\'s burn it and say we dumped it in the sewer. Kif might!</p>',	'published',	2),
(NULL,	'Pseudo-Czech Dummy Text',	'pseudo-czech-dummy-text',	'2010-09-12 20:21:39',	1,	'<p>Děj tušt dlakte. Dis tlž boti di rátýv běd jediž omřa fágryhli, ktyzkuž uti sé sámaň lýtizrou o bě memluz. Di pěst věchrupežrét tlyp nébas dléně a zyď běťáš blacpřích úgrýtrtist, i hroubtěšt vřouchlů tlašloubučlou děp ptasatisk nil tizko řouvrů maťoti žlist živ.\r\n<!--break-->\r\nTluchklí loplamlz mubyz pyčuma de hřuškež tidlu diprůktu dist tějnim, be pybiz nidří s křívy ďůž mise. Děcstásruc glůně nitgrask tkyděpo o fez, zétrou tině i vých graro, vřatkůstoslo diniď papy a člépyvu bryniblá zlebřítihloum. O obyl tkatěd hřoveďů divej hřízyjfrý z skýnib pyj. S šrevo žad paštni pič brýď.\r\n</p>',	'draft',	0);




CREATE TABLE `Tag` (
  `id`		int				NOT NULL AUTO_INCREMENT,
  `name`	varchar(100)	NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `Tag` (`id`, `name`) VALUES
(NULL, 'lipsum'),
(NULL, 'futurama'),
(NULL, 'dummy-text');




CREATE TABLE `User` (
  `id`			int				NOT NULL AUTO_INCREMENT,
  `name`		varchar(100)	NOT NULL,
  `email`		varchar(100)	NOT NULL,
  `password`	varchar(40)		NOT NULL,
  `role`		varchar(100)	NOT NULL,

  PRIMARY KEY	(`id`),
  UNIQUE KEY	`User_email_uniq` (`email`),
  KEY `idx_email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `User` (`id`, `name`, `email`, `password`, `role`) VALUES
(NULL, 'Srigi', 'demo@phpq.info', 'dcc1e12b13ab27f79f66a4b52347beae84a7175c', 'admin');




CREATE TABLE `post_tag` (
  `post_id`	int(11)	NOT NULL,
  `tag_id`	int(11)	NOT NULL,

  PRIMARY KEY	(`post_id`,`tag_id`),
  KEY			`post_tag_tag_id_idx` (`tag_id`),
  CONSTRAINT `post_tag_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `Post` (`id`) ON DELETE CASCADE,
  CONSTRAINT `post_tag_ibfk_2` FOREIGN KEY (`tag_id`) REFERENCES `Tag` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `post_tag` (`post_id`, `tag_id`) VALUES
(1,	1),
(2,	2),
(1,	3),
(2,	3),
(3,	3);

