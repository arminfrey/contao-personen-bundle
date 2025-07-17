<?php

// src/Migration/ContaoPersonenMigration.php
namespace Arminfrey\ContaoPersonenBundle\Migration;

use Contao\CoreBundle\Migration\AbstractMigration;
use Contao\CoreBundle\Migration\MigrationResult;
use Doctrine\DBAL\Connection;

class PersonenMigration extends AbstractMigration
{
    private Connection $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function shouldRun(): bool
    {
        $schemaManager = $this->connection->createSchemaManager();
        
        return !$schemaManager->tablesExist(['tl_personen']);
    }

    public function run(): MigrationResult
    {
        $this->connection->executeStatement("
            CREATE TABLE tl_personen (
                id int(10) unsigned NOT NULL auto_increment,
                tstamp int(10) unsigned NOT NULL default 0,
                name1 varchar(255) NOT NULL default '',
                vorname1 varchar(255) NOT NULL default '',
                name2 varchar(255) NOT NULL default '',
                vorname2 varchar(255) NOT NULL default '',
                anrede varchar(10) NOT NULL default '',
                strasse varchar(255) NOT NULL default '',
                hausnummer varchar(20) NOT NULL default '',
                plz varchar(10) NOT NULL default '',
                ort varchar(255) NOT NULL default '',
                email varchar(255) NOT NULL default '',
                ansprache varchar(255) text NULL,
                partnerfeld varchar(255) NOT NULL default '',
                kategorie varchar(50) NOT NULL default '',
                PRIMARY KEY (id)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
        ");

        return $this->createResult(true);
    }
}
