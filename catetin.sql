DROP TABLE IF EXISTS `tb_users`;

CREATE TABLE `tb_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `tb_users`
--

LOCK TABLES `tb_users` WRITE;
INSERT INTO `tb_users` VALUES
(1,'eva','$2y$10$j5Vu947BiocnTg2h3/el8O8lo2NoNotuMamqGOahLjeXGkHgO26mO'),
(2,'admin','$2y$10$0mPtusC/i5q2I2819rN9wun2z2xTURZ3ekQA6dZowBLtxCsWNxrNm'),
(3,'miko','$2y$10$hJUPcWOA.jQBwUEP/pBIeORBCZ.9oqMDhS.YMeAUhJ/1KFBiJgGvK');

UNLOCK TABLES;
--
-- Table structure for table `tb_todo`
--


DROP TABLE IF EXISTS `tb_todo`;
CREATE TABLE `tb_todo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `todo` text NOT NULL,
  `color` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `created_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `todo_owner` (`created_by`),
  CONSTRAINT `todo_owner` FOREIGN KEY (`created_by`) REFERENCES `tb_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;
