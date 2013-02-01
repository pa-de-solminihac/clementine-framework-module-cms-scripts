<?php
/**
 * Script non interactif d'installation du module utilisateurs
 */

$sql = <<<SQL

-- ---------------------------
-- Table `clementine_cms_page`
-- ---------------------------

ALTER TABLE `clementine_cms_page` ADD `active` TINYINT(1) DEFAULT 1 AFTER `slug`;

SQL;

if (!$db->prepare($sql)->execute()) {
    $db->rollBack();
    return false;
}

// deja appele par l'installer
// $db->commit();
return true;
?>
