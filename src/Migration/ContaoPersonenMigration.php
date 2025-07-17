<?php

// src/Migration/ContaoPersonenMigration.php
namespace Arminfrey\ContaoPersonenBundle\Migration;

use Contao\CoreBundle\Migration\AbstractMigration;
use Contao\CoreBundle\Migration\MigrationResult;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Exception;

class PersonenMigration extends AbstractMigration
{
    public function __construct(
        private Connection $connection
    ) {}

    public function shouldRun(): bool
    {
        $schemaManager = $this->connection->createSchemaManager();
        
        try {
            return !$schemaManager->tablesExist(['tl_personen']);
        } catch (Exception $e) {
            return true;
        }
    }

    public function run(): MigrationResult
    {
        try {
            $sql = "
                CREATE TABLE IF NOT EXISTS `tl_personen` (
                    `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
                    `tstamp` int(10) unsigned NOT NULL DEFAULT 0,
                    `name1` varchar(255) NOT NULL DEFAULT '',
                    `vorname1` varchar(255) NOT NULL DEFAULT '',
                    `name2` varchar(255) NOT NULL DEFAULT '',
                    `vorname2` varchar(255) NOT NULL DEFAULT '',
                    `anrede` varchar(10) NOT NULL DEFAULT '',
                    `strasse` varchar(255) NOT NULL DEFAULT '',
                    `hausnummer` varchar(20) NOT NULL DEFAULT '',
                    `plz` varchar(10) NOT NULL DEFAULT '',
                    `ort` varchar(255) NOT NULL DEFAULT '',
                    `email` varchar(255) NOT NULL DEFAULT '',
                    `ansprache` varchar(255) NOT NULL DEFAULT '',
                    `partnerfeld` varchar(255) NOT NULL DEFAULT '',
                    `kategorie` varchar(50) NOT NULL DEFAULT '',
                    PRIMARY KEY (`id`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
            ";
            
            $this->connection->executeStatement($sql);
            
            return $this->createResult(true, 'Tabelle tl_personen wurde erfolgreich erstellt.');
        } catch (Exception $e) {
            return $this->createResult(false, 'Fehler beim Erstellen der Tabelle: ' . $e->getMessage());
        }
    }
}
