/*Table structure for table `tabla` */

DROP TABLE IF EXISTS `tabla`;

CREATE TABLE `tabla` (
  `Sor` int(10) unsigned NOT NULL,
  `Username` varchar(256) NOT NULL,
  `Titkos` varchar(16) NOT NULL,
  PRIMARY KEY (`Sor`),
  KEY `Username` (`Username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `tabla` */

insert  into `tabla`(`Sor`,`Username`,`Titkos`) values 
(1,'katika@gmail.com','piros'),
(2,'arpi40@freemail.hu','zold'),
(3,'zsanettka@hotmail.com','sarga'),
(4,'hatizsak@protonmail.com','kek'),
(5,'terpeszterez@citromail.hu','fekete'),
(6,'nagysanyi@gmail.hu','feher');