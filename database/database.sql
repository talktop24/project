CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(225) NOT NULL,
  `password` varchar(225) NOT NULL,
  `email` varchar(225) NOT NULL,
  `name` varchar(225) NOT NULL,
  `phone` int(10) NOT NULL,
  `position` varchar(225) NOT NULL,
  `branch` varchar(225) NOT NULL,
  `status` varchar(225) ,
    PRIMARY KEY (`id`)
)ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;