
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
    `descendant_class` VARCHAR(100),
    PRIMARY KEY (`id`),
    UNIQUE INDEX `un_shortcode` (`shortcode`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- product_diaporama
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `product_diaporama`;

CREATE TABLE `product_diaporama`
(
    `product_id` INTEGER NOT NULL,
    `id` INTEGER NOT NULL,
    `shortcode` VARCHAR(32) NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE INDEX `product_diaporama_U_1` (`shortcode`),
    INDEX `product_diaporama_FI_1` (`product_id`),
    CONSTRAINT `product_diaporama_FK_1`
        FOREIGN KEY (`product_id`)
        REFERENCES `product` (`id`),
    CONSTRAINT `product_diaporama_FK_2`
        FOREIGN KEY (`id`)
        REFERENCES `diaporama` (`id`)
        ON DELETE CASCADE
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- category_diaporama
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `category_diaporama`;

CREATE TABLE `category_diaporama`
(
    `category_id` INTEGER NOT NULL,
    `id` INTEGER NOT NULL,
    `shortcode` VARCHAR(32) NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE INDEX `category_diaporama_U_1` (`shortcode`),
    INDEX `category_diaporama_FI_1` (`category_id`),
    CONSTRAINT `category_diaporama_FK_1`
        FOREIGN KEY (`category_id`)
        REFERENCES `category` (`id`),
    CONSTRAINT `category_diaporama_FK_2`
        FOREIGN KEY (`id`)
        REFERENCES `diaporama` (`id`)
        ON DELETE CASCADE
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- brand_diaporama
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `brand_diaporama`;

CREATE TABLE `brand_diaporama`
(
    `brand_id` INTEGER NOT NULL,
    `id` INTEGER NOT NULL,
    `shortcode` VARCHAR(32) NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE INDEX `brand_diaporama_U_1` (`shortcode`),
    INDEX `brand_diaporama_FI_1` (`brand_id`),
    CONSTRAINT `brand_diaporama_FK_1`
        FOREIGN KEY (`brand_id`)
        REFERENCES `brand` (`id`),
    CONSTRAINT `brand_diaporama_FK_2`
        FOREIGN KEY (`id`)
        REFERENCES `diaporama` (`id`)
        ON DELETE CASCADE
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- folder_diaporama
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `folder_diaporama`;

CREATE TABLE `folder_diaporama`
(
    `folder_id` INTEGER NOT NULL,
    `id` INTEGER NOT NULL,
    `shortcode` VARCHAR(32) NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE INDEX `folder_diaporama_U_1` (`shortcode`),
    INDEX `folder_diaporama_FI_1` (`folder_id`),
    CONSTRAINT `folder_diaporama_FK_1`
        FOREIGN KEY (`folder_id`)
        REFERENCES `folder` (`id`),
    CONSTRAINT `folder_diaporama_FK_2`
        FOREIGN KEY (`id`)
        REFERENCES `diaporama` (`id`)
        ON DELETE CASCADE
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- content_diaporama
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `content_diaporama`;

CREATE TABLE `content_diaporama`
(
    `content_id` INTEGER NOT NULL,
    `id` INTEGER NOT NULL,
    `shortcode` VARCHAR(32) NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE INDEX `content_diaporama_U_1` (`shortcode`),
    INDEX `content_diaporama_FI_1` (`content_id`),
    CONSTRAINT `content_diaporama_FK_1`
        FOREIGN KEY (`content_id`)
        REFERENCES `content` (`id`),
    CONSTRAINT `content_diaporama_FK_2`
        FOREIGN KEY (`id`)
        REFERENCES `diaporama` (`id`)
        ON DELETE CASCADE
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- diaporama_image
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `diaporama_image`;

CREATE TABLE `diaporama_image`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `diaporama_id` INTEGER NOT NULL,
    `position` INTEGER NOT NULL,
    `descendant_class` VARCHAR(100),
    PRIMARY KEY (`id`),
    INDEX `diaporama_image_FI_1` (`diaporama_id`),
    CONSTRAINT `diaporama_image_FK_1`
        FOREIGN KEY (`diaporama_id`)
        REFERENCES `diaporama` (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- product_diaporama_image
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `product_diaporama_image`;

CREATE TABLE `product_diaporama_image`
(
    `product_image_id` INTEGER NOT NULL,
    `position` INTEGER NOT NULL,
    `id` INTEGER NOT NULL,
    `diaporama_id` INTEGER NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE INDEX `un_image` (`diaporama_id`, `product_image_id`, `position`),
    INDEX `product_diaporama_image_FI_1` (`product_image_id`),
    INDEX `product_diaporama_image_I_2` (`diaporama_id`),
    CONSTRAINT `product_diaporama_image_FK_1`
        FOREIGN KEY (`product_image_id`)
        REFERENCES `product_image` (`id`),
    CONSTRAINT `product_diaporama_image_FK_2`
        FOREIGN KEY (`id`)
        REFERENCES `diaporama_image` (`id`)
        ON DELETE CASCADE,
    CONSTRAINT `product_diaporama_image_FK_3`
        FOREIGN KEY (`diaporama_id`)
        REFERENCES `diaporama` (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- category_diaporama_image
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `category_diaporama_image`;

CREATE TABLE `category_diaporama_image`
(
    `category_image_id` INTEGER NOT NULL,
    `position` INTEGER NOT NULL,
    `id` INTEGER NOT NULL,
    `diaporama_id` INTEGER NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE INDEX `un_image` (`diaporama_id`, `category_image_id`, `position`),
    INDEX `category_diaporama_image_FI_1` (`category_image_id`),
    INDEX `category_diaporama_image_I_2` (`diaporama_id`),
    CONSTRAINT `category_diaporama_image_FK_1`
        FOREIGN KEY (`category_image_id`)
        REFERENCES `category_image` (`id`),
    CONSTRAINT `category_diaporama_image_FK_2`
        FOREIGN KEY (`id`)
        REFERENCES `diaporama_image` (`id`)
        ON DELETE CASCADE,
    CONSTRAINT `category_diaporama_image_FK_3`
        FOREIGN KEY (`diaporama_id`)
        REFERENCES `diaporama` (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- brand_diaporama_image
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `brand_diaporama_image`;

CREATE TABLE `brand_diaporama_image`
(
    `brand_image_id` INTEGER NOT NULL,
    `position` INTEGER NOT NULL,
    `id` INTEGER NOT NULL,
    `diaporama_id` INTEGER NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE INDEX `un_image` (`diaporama_id`, `brand_image_id`, `position`),
    INDEX `brand_diaporama_image_FI_1` (`brand_image_id`),
    INDEX `brand_diaporama_image_I_2` (`diaporama_id`),
    CONSTRAINT `brand_diaporama_image_FK_1`
        FOREIGN KEY (`brand_image_id`)
        REFERENCES `brand_image` (`id`),
    CONSTRAINT `brand_diaporama_image_FK_2`
        FOREIGN KEY (`id`)
        REFERENCES `diaporama_image` (`id`)
        ON DELETE CASCADE,
    CONSTRAINT `brand_diaporama_image_FK_3`
        FOREIGN KEY (`diaporama_id`)
        REFERENCES `diaporama` (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- folder_diaporama_image
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `folder_diaporama_image`;

CREATE TABLE `folder_diaporama_image`
(
    `folder_image_id` INTEGER NOT NULL,
    `position` INTEGER NOT NULL,
    `id` INTEGER NOT NULL,
    `diaporama_id` INTEGER NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE INDEX `un_image` (`diaporama_id`, `folder_image_id`, `position`),
    INDEX `folder_diaporama_image_FI_1` (`folder_image_id`),
    INDEX `folder_diaporama_image_I_2` (`diaporama_id`),
    CONSTRAINT `folder_diaporama_image_FK_1`
        FOREIGN KEY (`folder_image_id`)
        REFERENCES `folder_image` (`id`),
    CONSTRAINT `folder_diaporama_image_FK_2`
        FOREIGN KEY (`id`)
        REFERENCES `diaporama_image` (`id`)
        ON DELETE CASCADE,
    CONSTRAINT `folder_diaporama_image_FK_3`
        FOREIGN KEY (`diaporama_id`)
        REFERENCES `diaporama` (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- content_diaporama_image
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `content_diaporama_image`;

CREATE TABLE `content_diaporama_image`
(
    `content_image_id` INTEGER NOT NULL,
    `position` INTEGER NOT NULL,
    `id` INTEGER NOT NULL,
    `diaporama_id` INTEGER NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE INDEX `un_image` (`diaporama_id`, `content_image_id`, `position`),
    INDEX `content_diaporama_image_FI_1` (`content_image_id`),
    INDEX `content_diaporama_image_I_2` (`diaporama_id`),
    CONSTRAINT `content_diaporama_image_FK_1`
        FOREIGN KEY (`content_image_id`)
        REFERENCES `content_image` (`id`),
    CONSTRAINT `content_diaporama_image_FK_2`
        FOREIGN KEY (`id`)
        REFERENCES `diaporama_image` (`id`)
        ON DELETE CASCADE,
    CONSTRAINT `content_diaporama_image_FK_3`
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
-- product_diaporama_i18n
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `product_diaporama_i18n`;

CREATE TABLE `product_diaporama_i18n`
(
    `id` INTEGER NOT NULL,
    `locale` VARCHAR(5) DEFAULT 'en_US' NOT NULL,
    `title` VARCHAR(255) DEFAULT '' NOT NULL,
    PRIMARY KEY (`id`,`locale`),
    CONSTRAINT `product_diaporama_i18n_FK_1`
        FOREIGN KEY (`id`)
        REFERENCES `product_diaporama` (`id`)
        ON DELETE CASCADE
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- category_diaporama_i18n
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `category_diaporama_i18n`;

CREATE TABLE `category_diaporama_i18n`
(
    `id` INTEGER NOT NULL,
    `locale` VARCHAR(5) DEFAULT 'en_US' NOT NULL,
    `title` VARCHAR(255) DEFAULT '' NOT NULL,
    PRIMARY KEY (`id`,`locale`),
    CONSTRAINT `category_diaporama_i18n_FK_1`
        FOREIGN KEY (`id`)
        REFERENCES `category_diaporama` (`id`)
        ON DELETE CASCADE
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- brand_diaporama_i18n
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `brand_diaporama_i18n`;

CREATE TABLE `brand_diaporama_i18n`
(
    `id` INTEGER NOT NULL,
    `locale` VARCHAR(5) DEFAULT 'en_US' NOT NULL,
    `title` VARCHAR(255) DEFAULT '' NOT NULL,
    PRIMARY KEY (`id`,`locale`),
    CONSTRAINT `brand_diaporama_i18n_FK_1`
        FOREIGN KEY (`id`)
        REFERENCES `brand_diaporama` (`id`)
        ON DELETE CASCADE
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- folder_diaporama_i18n
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `folder_diaporama_i18n`;

CREATE TABLE `folder_diaporama_i18n`
(
    `id` INTEGER NOT NULL,
    `locale` VARCHAR(5) DEFAULT 'en_US' NOT NULL,
    `title` VARCHAR(255) DEFAULT '' NOT NULL,
    PRIMARY KEY (`id`,`locale`),
    CONSTRAINT `folder_diaporama_i18n_FK_1`
        FOREIGN KEY (`id`)
        REFERENCES `folder_diaporama` (`id`)
        ON DELETE CASCADE
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- content_diaporama_i18n
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `content_diaporama_i18n`;

CREATE TABLE `content_diaporama_i18n`
(
    `id` INTEGER NOT NULL,
    `locale` VARCHAR(5) DEFAULT 'en_US' NOT NULL,
    `title` VARCHAR(255) DEFAULT '' NOT NULL,
    PRIMARY KEY (`id`,`locale`),
    CONSTRAINT `content_diaporama_i18n_FK_1`
        FOREIGN KEY (`id`)
        REFERENCES `content_diaporama` (`id`)
        ON DELETE CASCADE
) ENGINE=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
