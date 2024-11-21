<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Sylius Sp. z o.o.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Sylius\RefundPlugin\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Sylius\Bundle\CoreBundle\Doctrine\Migrations\AbstractMigration;

final class Version20190207125150 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE sylius_refund_credit_memo_sequence (id INT AUTO_INCREMENT NOT NULL, idx INT NOT NULL, version INT DEFAULT 1 NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET UTF8 COLLATE UTF8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sylius_refund_credit_memo (id VARCHAR(255) NOT NULL, number VARCHAR(255) NOT NULL, orderNumber VARCHAR(255) NOT NULL, total INT NOT NULL, units LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', currencyCode VARCHAR(255) NOT NULL, localeCode VARCHAR(255) NOT NULL, comment LONGTEXT NOT NULL, issued_at DATETIME DEFAULT NULL, channel_code VARCHAR(255) NOT NULL, channel_name VARCHAR(255) NOT NULL, channel_color VARCHAR(255) NOT NULL, INDEX IDX_5C4F3331989A8203 (orderNumber), PRIMARY KEY(id)) DEFAULT CHARACTER SET UTF8 COLLATE UTF8_unicode_ci ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE sylius_refund_credit_memo_sequence');
        $this->addSql('DROP TABLE sylius_refund_credit_memo');
    }
}
