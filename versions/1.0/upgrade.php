<?php
/**
 * Script non interactif d'installation du module utilisateurs
 */

$sql = <<<SQL

-- -----------------------------------------------------
-- Table `clementine_cms_template`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `clementine_cms_template` (
  `id_template` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT ,
  `chemin` VARCHAR(255) NOT NULL ,
  PRIMARY KEY (`id_template`) )
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;

SQL;

$db->query($sql);

$sql = <<<SQL

-- -----------------------------------------------------
-- Table `clementine_cms_page`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `clementine_cms_page` (
  `id_page` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT ,
  `template_id_template` INT(11) UNSIGNED NOT NULL ,
  `nom_page` VARCHAR(255) NOT NULL ,
  `slug` VARCHAR(255) NULL ,
  PRIMARY KEY (`id_page`) ,
  INDEX `fk_page_template` (`template_id_template` ASC) ,
  UNIQUE INDEX `nom` (`nom_page` ASC) ,
  UNIQUE INDEX `slug_UNIQUE` (`slug` ASC) ,
  CONSTRAINT `fk_page_template`
    FOREIGN KEY (`template_id_template` )
    REFERENCES `clementine_cms_template` (`id_template` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;

SQL;

$db->query($sql);

$sql = <<<SQL

-- -----------------------------------------------------
-- Table `clementine_cms_page_categories`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `clementine_cms_page_categories` (
  `categories_id_categorie` INT UNSIGNED NOT NULL ,
  `page_id_page` INT(11) UNSIGNED NOT NULL ,
  `page_rang_tri` INT NULL ,
  PRIMARY KEY (`categories_id_categorie`, `page_id_page`) ,
  INDEX `fk_clementine_cms_page_categories_clementine_cms_page1` (`page_id_page` ASC) ,
  CONSTRAINT `fk_clementine_cms_page_categories_clementine_cms_page1`
    FOREIGN KEY (`page_id_page` )
    REFERENCES `clementine_cms_page` (`id_page` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

SQL;

$db->query($sql);

$sql = <<<SQL

-- -----------------------------------------------------
-- Table `clementine_cms_zone`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `clementine_cms_zone` (
  `id_zone` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT ,
  `nom_zone` VARCHAR(255) NOT NULL ,
  PRIMARY KEY (`id_zone`) ,
  UNIQUE INDEX `nom` (`nom_zone` ASC) )
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;

SQL;

$db->query($sql);

$sql = <<<SQL

-- -----------------------------------------------------
-- Table `clementine_cms_instance_zone`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `clementine_cms_instance_zone` (
  `id_instance_zone` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `page_id_page` INT(11) UNSIGNED NOT NULL ,
  `zone_id_zone` INT(11) UNSIGNED NOT NULL ,
  PRIMARY KEY (`id_instance_zone`) ,
  INDEX `fk_instance_zone_zone1` (`zone_id_zone` ASC) ,
  INDEX `fk_instance_zone_page1` (`page_id_page` ASC) ,
  CONSTRAINT `fk_instance_zone_zone1`
    FOREIGN KEY (`zone_id_zone` )
    REFERENCES `clementine_cms_zone` (`id_zone` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_instance_zone_page1`
    FOREIGN KEY (`page_id_page` )
    REFERENCES `clementine_cms_page` (`id_page` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

SQL;

$db->query($sql);

$sql = <<<SQL

-- -----------------------------------------------------
-- Table `clementine_cms_parametres_zone`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `clementine_cms_parametres_zone` (
  `instance_zone_id_instance_zone` INT UNSIGNED NOT NULL ,
  `nom` VARCHAR(45) NOT NULL ,
  `valeur` TEXT NOT NULL ,
  PRIMARY KEY (`nom`, `instance_zone_id_instance_zone`) ,
  INDEX `fk_parametres_zone_instance_zone1` (`instance_zone_id_instance_zone` ASC) ,
  CONSTRAINT `fk_parametres_zone_instance_zone1`
    FOREIGN KEY (`instance_zone_id_instance_zone` )
    REFERENCES `clementine_cms_instance_zone` (`id_instance_zone` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;

SQL;

$db->query($sql);

$sql = <<<SQL

-- -----------------------------------------------------
-- Table `clementine_cms_parametres_page`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `clementine_cms_parametres_page` (
  `page_id_page` INT(11) UNSIGNED NOT NULL ,
  `nom` VARCHAR(45) NOT NULL ,
  `valeur` TEXT NOT NULL ,
  PRIMARY KEY (`page_id_page`, `nom`) ,
  INDEX `fk_parametres_page_page` (`page_id_page` ASC) ,
  CONSTRAINT `fk_parametres_page_page`
    FOREIGN KEY (`page_id_page` )
    REFERENCES `clementine_cms_page` (`id_page` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

SQL;

$db->query($sql);

$sql = <<<SQL

-- -----------------------------------------------------
-- Table `clementine_cms_template_has_zone`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `clementine_cms_template_has_zone` (
  `template_id_template` INT(11) UNSIGNED NOT NULL ,
  `zone_id_zone` INT(11) UNSIGNED NOT NULL ,
  PRIMARY KEY (`template_id_template`, `zone_id_zone`) ,
  INDEX `fk_template_has_zone_template1` (`template_id_template` ASC) ,
  INDEX `fk_template_has_zone_zone1` (`zone_id_zone` ASC) ,
  CONSTRAINT `fk_template_has_zone_template1`
    FOREIGN KEY (`template_id_template` )
    REFERENCES `clementine_cms_template` (`id_template` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_template_has_zone_zone1`
    FOREIGN KEY (`zone_id_zone` )
    REFERENCES `clementine_cms_zone` (`id_zone` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

SQL;

$db->query($sql);

$sql = <<<SQL

-- -----------------------------------------------------
-- Table `clementine_cms_contenu`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `clementine_cms_contenu` (
  `id_contenu` INT UNSIGNED NOT NULL ,
  `table_contenu` VARCHAR(45) NOT NULL ,
  `nom_contenu` VARCHAR(255) NOT NULL ,
  `lang` CHAR(2) NOT NULL ,
  `date_lancement` DATETIME NULL ,
  `date_arret` DATETIME NULL ,
  `valide` TINYINT NOT NULL DEFAULT 0 ,
  PRIMARY KEY (`id_contenu`, `table_contenu`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

SQL;

$db->query($sql);

$sql = <<<SQL

-- -----------------------------------------------------
-- Table `clementine_cms_parametres_contenu`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `clementine_cms_parametres_contenu` (
  `contenu_id_contenu` INT UNSIGNED NOT NULL ,
  `contenu_table_contenu` VARCHAR(45) NOT NULL ,
  `nom` VARCHAR(45) NOT NULL ,
  `valeur` TEXT NOT NULL ,
  PRIMARY KEY (`nom`, `contenu_id_contenu`, `contenu_table_contenu`) ,
  INDEX `fk_parametres_contenu_clementine_cms_contenu1` (`contenu_id_contenu` ASC, `contenu_table_contenu` ASC) ,
  CONSTRAINT `fk_parametres_contenu_clementine_cms_contenu1`
    FOREIGN KEY (`contenu_id_contenu` , `contenu_table_contenu` )
    REFERENCES `clementine_cms_contenu` (`id_contenu` , `table_contenu` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

SQL;

$db->query($sql);

$sql = <<<SQL

-- -----------------------------------------------------
-- Table `clementine_cms_instance_zone_has_contenu`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `clementine_cms_instance_zone_has_contenu` (
  `id_contenu` INT UNSIGNED NOT NULL ,
  `table_contenu` VARCHAR(45) NOT NULL ,
  `id_instance_zone` INT UNSIGNED NOT NULL ,
  `poids` VARCHAR(45) NULL ,
  PRIMARY KEY (`id_contenu`, `table_contenu`, `id_instance_zone`) ,
  INDEX `fk_clementine_cms_contenu_has_clementine_cms_instance_zone_cl1` (`id_contenu` ASC, `table_contenu` ASC) ,
  INDEX `fk_clementine_cms_contenu_has_clementine_cms_instance_zone_cl2` (`id_instance_zone` ASC) ,
  CONSTRAINT `fk_clementine_cms_contenu_has_clementine_cms_instance_zone_cl1`
    FOREIGN KEY (`id_contenu` , `table_contenu` )
    REFERENCES `clementine_cms_contenu` (`id_contenu` , `table_contenu` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_clementine_cms_contenu_has_clementine_cms_instance_zone_cl2`
    FOREIGN KEY (`id_instance_zone` )
    REFERENCES `clementine_cms_instance_zone` (`id_instance_zone` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

SQL;

$db->query($sql);

$sql = <<<SQL

-- -----------------------------------------------------
-- Data for table `clementine_cms_template`
-- -----------------------------------------------------
INSERT INTO `clementine_cms_template` (`id_template`, `chemin`) VALUES ('1', 'templates/3colonnes');
INSERT INTO `clementine_cms_template` (`id_template`, `chemin`) VALUES ('2', 'templates/2colonnes');
INSERT INTO `clementine_cms_template` (`id_template`, `chemin`) VALUES ('3', 'templates/unique');

SQL;

$db->query($sql);

$sql = <<<SQL

-- -----------------------------------------------------
-- Data for table `clementine_cms_page`
-- -----------------------------------------------------
INSERT INTO `clementine_cms_page` (`id_page`, `template_id_template`, `nom_page`, `slug`) VALUES ('1', '1', 'Premiere page', 'premiere-page');

SQL;

$db->query($sql);

$sql = <<<SQL

-- -----------------------------------------------------
-- Data for table `clementine_cms_zone`
-- -----------------------------------------------------
INSERT INTO `clementine_cms_zone` (`id_zone`, `nom_zone`) VALUES ('1', 'edito');
INSERT INTO `clementine_cms_zone` (`id_zone`, `nom_zone`) VALUES ('2', 'texte_principal');
INSERT INTO `clementine_cms_zone` (`id_zone`, `nom_zone`) VALUES ('3', 'colonne_droite');

SQL;

$db->query($sql);

$sql = <<<SQL

-- -----------------------------------------------------
-- Data for table `clementine_cms_instance_zone`
-- -----------------------------------------------------
INSERT INTO `clementine_cms_instance_zone` (`id_instance_zone`, `page_id_page`, `zone_id_zone`) VALUES ('1', '1', '1');
INSERT INTO `clementine_cms_instance_zone` (`id_instance_zone`, `page_id_page`, `zone_id_zone`) VALUES ('2', '1', '2');
INSERT INTO `clementine_cms_instance_zone` (`id_instance_zone`, `page_id_page`, `zone_id_zone`) VALUES ('3', '1', '3');

SQL;

$db->query($sql);

$sql = <<<SQL

-- -----------------------------------------------------
-- Data for table `clementine_cms_parametres_page`
-- -----------------------------------------------------
INSERT INTO `clementine_cms_parametres_page` (`page_id_page`, `nom`, `valeur`) VALUES ('1', 'description', 'Premiere page');
INSERT INTO `clementine_cms_parametres_page` (`page_id_page`, `nom`, `valeur`) VALUES ('1', 'keywords', 'premiere, page');

SQL;

$db->query($sql);

$sql = <<<SQL

-- -----------------------------------------------------
-- Data for table `clementine_cms_template_has_zone`
-- -----------------------------------------------------
INSERT INTO `clementine_cms_template_has_zone` (`template_id_template`, `zone_id_zone`) VALUES ('1', '1');
INSERT INTO `clementine_cms_template_has_zone` (`template_id_template`, `zone_id_zone`) VALUES ('1', '2');
INSERT INTO `clementine_cms_template_has_zone` (`template_id_template`, `zone_id_zone`) VALUES ('1', '3');
INSERT INTO `clementine_cms_template_has_zone` (`template_id_template`, `zone_id_zone`) VALUES ('2', '1');
INSERT INTO `clementine_cms_template_has_zone` (`template_id_template`, `zone_id_zone`) VALUES ('2', '2');
INSERT INTO `clementine_cms_template_has_zone` (`template_id_template`, `zone_id_zone`) VALUES ('3', '2');

SQL;

$db->query($sql);
?>
<pre>
Interface de gestion du cms <a href="../cms" target="_blank">site monolingue</a> ou <a href="../fr/cms" target="_blank">site multilingue</a>
</pre>
<?php
return true;
?>
