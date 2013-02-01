<?php
/**
 * Script non interactif d'installation du module utilisateurs
 */

$sql = <<<SQL

-- -----------------------------------------------------
-- Table `clementine_cms_instance_zone_has_contenu`
-- -----------------------------------------------------

ALTER TABLE `clementine_cms_instance_zone_has_contenu` CHANGE `poids` `poids` INT NULL DEFAULT NULL;

SQL;

$db->query($sql);
return true;
?>
