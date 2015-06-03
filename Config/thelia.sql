
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
    `diaporama_type_id` INTEGER NOT NULL,
    `entity_id` INTEGER NOT NULL,
    `created_at` DATETIME,
    `updated_at` DATETIME,
    `version` INTEGER DEFAULT 0,
    `version_created_at` DATETIME,
    `version_created_by` VARCHAR(100),
    PRIMARY KEY (`id`),
    UNIQUE INDEX `un_shortcode` (`shortcode`),
    INDEX `diaporama_FI_1` (`diaporama_type_id`),
    CONSTRAINT `diaporama_FK_1`
        FOREIGN KEY (`diaporama_type_id`)
        REFERENCES `diaporama_type` (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- diaporama_type
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `diaporama_type`;

CREATE TABLE `diaporama_type`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `code` VARCHAR(16) NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE INDEX `un_code` (`code`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- diaporama_image
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `diaporama_image`;

CREATE TABLE `diaporama_image`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `diaporama_id` INTEGER NOT NULL,
    `diaporama_type_id` INTEGER NOT NULL,
    `entity_id` INTEGER NOT NULL,
    `position` INTEGER NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE INDEX `un_image` (`diaporama_id`, `diaporama_type_id`, `position`),
    INDEX `diaporama_image_FI_2` (`diaporama_type_id`),
    CONSTRAINT `diaporama_image_FK_1`
        FOREIGN KEY (`diaporama_id`)
        REFERENCES `diaporama` (`id`),
    CONSTRAINT `diaporama_image_FK_2`
        FOREIGN KEY (`diaporama_type_id`)
        REFERENCES `diaporama_type` (`id`)
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
-- diaporama_type_i18n
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `diaporama_type_i18n`;

CREATE TABLE `diaporama_type_i18n`
(
    `id` INTEGER NOT NULL,
    `locale` VARCHAR(5) DEFAULT 'en_US' NOT NULL,
    `title` VARCHAR(16) NOT NULL,
    PRIMARY KEY (`id`,`locale`),
    CONSTRAINT `diaporama_type_i18n_FK_1`
        FOREIGN KEY (`id`)
        REFERENCES `diaporama_type` (`id`)
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
    `diaporama_type_id` INTEGER NOT NULL,
    `entity_id` INTEGER NOT NULL,
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
