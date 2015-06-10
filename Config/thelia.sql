
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- diaporama
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `diaporama`;

CREATE TABLE `diaporama`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `shortcode` VARCHAR(32) NOT NULL,
    `created_at` DATETIME,
    `updated_at` DATETIME,
    `version` INTEGER DEFAULT 0,
    `version_created_at` DATETIME,
    `version_created_by` VARCHAR(100),
    PRIMARY KEY (`id`),
    UNIQUE INDEX `un_shortcode` (`shortcode`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- diaporama_image
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `diaporama_image`;

CREATE TABLE `diaporama_image`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `diaporama_id` INTEGER NOT NULL,
    `file` VARCHAR(255) NOT NULL,
    `visible` TINYINT DEFAULT 1 NOT NULL,
    `position` INTEGER NOT NULL,
    `created_at` DATETIME,
    `updated_at` DATETIME,
    PRIMARY KEY (`id`),
    INDEX `idx_diaporama_image_diaporama_id` (`diaporama_id`),
    INDEX `idx_diaporama_image_diaporama_id_position` (`diaporama_id`, `position`),
    CONSTRAINT `diaporama_image_FK_1`
        FOREIGN KEY (`diaporama_id`)
        REFERENCES `diaporama` (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- diaporama_i18n
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `diaporama_i18n`;

CREATE TABLE `diaporama_i18n`
(
    `id` INTEGER NOT NULL,
    `locale` VARCHAR(5) DEFAULT 'en_US' NOT NULL,
    `title` VARCHAR(255) DEFAULT '' NOT NULL,
    PRIMARY KEY (`id`,`locale`),
    CONSTRAINT `diaporama_i18n_FK_1`
        FOREIGN KEY (`id`)
        REFERENCES `diaporama` (`id`)
        ON DELETE CASCADE
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- diaporama_image_i18n
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `diaporama_image_i18n`;

CREATE TABLE `diaporama_image_i18n`
(
    `id` INTEGER NOT NULL,
    `locale` VARCHAR(5) DEFAULT 'en_US' NOT NULL,
    `title` VARCHAR(255),
    `description` LONGTEXT,
    `chapo` TEXT,
    `postscriptum` TEXT,
    PRIMARY KEY (`id`,`locale`),
    CONSTRAINT `diaporama_image_i18n_FK_1`
        FOREIGN KEY (`id`)
        REFERENCES `diaporama_image` (`id`)
        ON DELETE CASCADE
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- diaporama_version
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `diaporama_version`;

CREATE TABLE `diaporama_version`
(
    `id` INTEGER NOT NULL,
    `shortcode` VARCHAR(32) NOT NULL,
    `created_at` DATETIME,
    `updated_at` DATETIME,
    `version` INTEGER DEFAULT 0 NOT NULL,
    `version_created_at` DATETIME,
    `version_created_by` VARCHAR(100),
    PRIMARY KEY (`id`,`version`),
    CONSTRAINT `diaporama_version_FK_1`
        FOREIGN KEY (`id`)
        REFERENCES `diaporama` (`id`)
        ON DELETE CASCADE
) ENGINE=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
