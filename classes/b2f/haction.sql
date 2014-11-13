CREATE TABLE IF NOT EXISTS `hactions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hash` varchar(64) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `expire_ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `actor_class_name` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `actor_id` int(11) DEFAULT NULL,
  `actor_data` text,
  `create_ts` timestamp NULL DEFAULT NULL,
  `modify_ts` timestamp NULL DEFAULT NULL,
  `owner_id` int(10) unsigned DEFAULT NULL,
  `last_editor_id` int(10) unsigned DEFAULT NULL,
  `last_editor_ip` varchar(16) DEFAULT NULL,
  `last_editor_ua` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
