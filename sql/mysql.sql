CREATE TABLE `{inventory}`
(
    `id`     INT(10) UNSIGNED    NOT NULL AUTO_INCREMENT,
    `title`  VARCHAR(255)        NOT NULL DEFAULT '',
    `url`    TEXT                         DEFAULT NULL,
    `status` TINYINT(1) UNSIGNED NOT NULL DEFAULT '0',
    `click`  INT(10) UNSIGNED    NOT NULL DEFAULT '0',
    PRIMARY KEY (`id`)
);