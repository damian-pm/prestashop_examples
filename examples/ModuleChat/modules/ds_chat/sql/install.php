<?php

$sql    = array();

$sql[]  = strtr("CREATE TABLE IF NOT EXISTS `%PREFIX_ds_chat_messages` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `content` text DEFAULT '' NOT NULL,
    `customer` int(10) unsigned NULL,
    `ip_user` varchar(100) NULL,
    `employee` int(10) unsigned NOT NULL,
    `owner` varchar(100) NULL, 
    `state` varchar(100) NOT NULL,
    `token` varchar(100) NOT NULL,
    `added_time` datetime DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY  (`id`)
    ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1", [
        '%PREFIX_' => _DB_PREFIX_
]);
$sql[]  = strtr("CREATE TABLE IF NOT EXISTS `%PREFIX_ds_chat_bot_messages` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `question` text DEFAULT '' NOT NULL,
    `answer` text DEFAULT '' NOT NULL,
    PRIMARY KEY  (`id`)
    ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1", [
        '%PREFIX_' => _DB_PREFIX_
]);
$sql[]  = strtr("INSERT INTO `%PREFIX_ds_chat_bot_messages` (`id`, `question`, `answer`) VALUES (NULL, 'Hi', 'Hello! I am SimpleBot. How can I help you?');", [
        '%PREFIX_' => _DB_PREFIX_
]);
$sql[]  = strtr("  INSERT INTO `%PREFIX_ds_chat_bot_messages` (`id`, `question`, `answer`) VALUES (NULL, 'BOT_START_MESSAGE', 'Hi, how can I help you?');", [
        '%PREFIX_' => _DB_PREFIX_
]);

foreach ($sql as $query) {
    if (Db::getInstance()->execute($query) == false) {
        return false;
    }
}

return true;