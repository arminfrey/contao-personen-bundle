<?php

// src/Migration/ContaoPersonenMigration.php
// src/Migration/PersonenMigration.php
namespace Arminfrey\ContaoPersonenBundle\Migration;

use Contao\CoreBundle\Migration\AbstractMigration;
use Contao\CoreBundle\Migration\MigrationResult;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Schema\Schema;

class PersonenMigration extends AbstractMigration
{
    public function __construct(
        private Connection $connection
    ) {}

    public function shouldRun(): bool
    {
        $schemaManager = $this->connection->createSchemaManager();
        
        if (!$schemaManager->tablesExist(['tl_personen'])) {
            return true;
        }
        
        return false;
    }

    public function run(): MigrationResult
    {
        $schema = new Schema();
        $table = $schema->createTable('tl_personen');
        
        $table->addColumn('id', 'integer', ['unsigned' => true, 'autoincrement' => true]);
        $table->addColumn('tstamp', 'integer', ['unsigned' => true, 'default' => 0]);
        $table->addColumn('name1', 'string', ['length' => 255, 'default' => '']);
        $table->addColumn('vorname1', 'string', ['length' => 255, 'default' => '']);
        $table->addColumn('name2', 'string', ['length' => 255, 'default' => '']);
        $table->addColumn('vorname2', 'string', ['length' => 255, 'default' => '']);
        $table->addColumn('anrede', 'string', ['length' => 10, 'default' => '']);
        $table->addColumn('strasse', 'string', ['length' => 255, 'default' => '']);
        $table->addColumn('hausnummer', 'string', ['length' => 20, 'default' => '']);
        $table->addColumn('plz', 'string', ['length' => 10, 'default' => '']);
        $table->addColumn('ort', 'string', ['length' => 255, 'default' => '']);
        $table->addColumn('email', 'string', ['length' => 255, 'default' => '']);
        $table->addColumn('ansprache', 'text', ['notnull' => false]);
        $table->addColumn('partnerfeld', 'string', ['length' => 255, 'default' => '']);
        $table->addColumn('kategorie', 'string', ['length' => 50, 'default' => '']);
        
        $table->setPrimaryKey(['id']);
        
        foreach ($schema->toSql($this->connection->getDatabasePlatform()) as $sql) {
            $this->connection->executeStatement($sql);
        }

        return $this->createResult(true, 'Tabelle tl_personen wurde erfolgreich erstellt.');
    }
}
