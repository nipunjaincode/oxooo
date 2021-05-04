DELETE FROM config WHERE title = 'version';
INSERT INTO `config` (`config_id`, `title`, `value`) VALUES (NULL, 'version', '1.0.1');