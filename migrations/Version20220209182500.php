<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20220209182500 extends AbstractMigration
{
    private const TABLE_NAME = 'Money';
    /**
     * @param Schema $schema
     * @return void
     */
    public function up(Schema $schema): void
    {
        $table = $schema->createTable(self::TABLE_NAME);
        $table->addColumn('id', 'string', ['length' => 36]);
        $table->addColumn('amount', 'float', ['notnull' => true]);
        $table->addColumn('currency', 'string', ['length' => 3, 'notnull' => true]);
        $table->setPrimaryKey(['id']);
    }

    /**
     * @param Schema $schema
     * @return void
     */
    public function down(Schema $schema): void
    {
        $schema->dropTable(self::TABLE_NAME);
    }
}
