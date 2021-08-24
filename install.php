<?php

/**
 * This function is called on installation and is used to create database schema for the plugin
 */
function extension_install_pendingreboot()
{
    $commonObject = new ExtensionCommon;

    $commonObject -> sqlQuery("CREATE TABLE IF NOT EXISTS `pendingreboot` (
                          `ID` INT(11) NOT NULL AUTO_INCREMENT,
                          `HARDWARE_ID` INT(11) NOT NULL,
                          `PENDING_REBOOT` VARCHAR(255) DEFAULT NULL,
                          `LAST_CHECKED` DATETIME DEFAULT NULL,
                          PRIMARY KEY  (`ID`,`HARDWARE_ID`)
                          ) ENGINE=INNODB;");
}

/**
 * This function is called on removal and is used to destroy database schema for the plugin
 */
function extension_delete_pendingreboot()
{
    $commonObject = new ExtensionCommon;
    $commonObject -> sqlQuery("DROP TABLE IF EXISTS `pendingreboot`");
}

/**
 * This function is called on plugin upgrade
 */
function extension_upgrade_pendingreboot()
{

}
