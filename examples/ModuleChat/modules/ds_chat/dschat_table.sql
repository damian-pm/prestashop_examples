CREATE TABLE IF NOT EXISTS `PREFIX_ds_chat_messages` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `content` text DEFAULT '' NOT NULL,
  `customer` int(10) unsigned NULL,
  `ip_user` varchar(100) NULL,
  `employee` int(10) unsigned NOT NULL,
  `owner` varchar(100) NULL, 
  `state` varchar(100) NOT NULL,
  `token` varchar(100) NOT NULL,
  `added_time` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=ENGINE_TYPE  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `PREFIX_ds_chat_bot_messages` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `question` text DEFAULT '' NOT NULL,
  `answer` text DEFAULT '' NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=ENGINE_TYPE  DEFAULT CHARSET=utf8;

INSERT INTO `PREFIX_ds_chat_bot_messages` (`id`, `question`, `answer`) VALUES (NULL, 'Hi', 'Hello! I am SimpleBot. How can I help you?');
INSERT INTO `PREFIX_ds_chat_bot_messages` (`id`, `question`, `answer`) VALUES (NULL, 'BOT_START_MESSAGE', 'Hi, how can I help you?');

-- INSERT INTO PREFIX_ds_chat_messages
-- (content, customer, ip_user, employee, owner, state)
-- VALUES('witaj panie', 2, '127.0.0.1', 1, 'employee', 'unreaded');

-- CREATE TABLE IF NOT EXISTS `ps_ds_chat_messages` (
--   `id` int(10) unsigned NOT NULL auto_increment,
--   `content` text NOT NULL,
--   `from_user` int(10) unsigned NOT NULL,
--   `to_user` int(10) unsigned  NOT NULL,
--   `state` varchar(100) NOT NULL,
--   `added_time` datetime DEFAULT CURRENT_TIMESTAMP,
--   PRIMARY KEY (`id`),
--   FOREIGN KEY (from_user) 
--     REFERENCES ps_customer(id_customer),
--   FOREIGN KEY (to_user) 
--     REFERENCES ps_employee(id_employee)
-- ) ENGINE=INNODB  DEFAULT CHARSET=utf8;

-- CREATE TABLE IF NOT EXISTS `ps_ds_chat_bot_messages` (
--   `id` int(10) unsigned NOT NULL auto_increment,
--   `question` text NOT NULL,
--   `answer` int(10) unsigned NOT NULL,
--   PRIMARY KEY (`id`)
-- ) ENGINE=INNODB  DEFAULT CHARSET=utf8;