SET FOREIGN_KEY_CHECKS = 0;
DROP DATABASE IF EXISTS eventmars;
CREATE DATABASE eventmars;
USE eventmars;
DROP TABLE IF EXISTS;
SET FOREIGN_KEY_CHECKS = 1;

-- Create Tables
CREATE TABLE `festival` (
                         `id` int  NOT NULL PRIMARY KEY AUTO_INCREMENT,
                         `name` VARCHAR(255),
                         `coordinate_X` smallint,
                         `coordinate_Y` smallint,
                         `city` VARCHAR(10),
                         `date` DATETIME,
                         `description` TEXT,
                         `url` VARCHAR(255)
);

CREATE TABLE `mark` (
                            `id` int  NOT NULL PRIMARY KEY AUTO_INCREMENT,
                            `name` VARCHAR(255),
                            `coordinate_X` smallint,
                            `coordinate_Y` smallint,
                            `description` TEXT,
                            `url` VARCHAR(255)
);

INSERT INTO `mark` (`coordinate_X`, `coordinate_Y`) VALUES ("230", "80"),
                                                                                ("180","160"),
                                                                                 ("120","100"),
                                                                                ("70","10"),
                                                                                ("100","50"),
                                                                                ("190","20");

