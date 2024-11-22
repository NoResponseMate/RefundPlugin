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

final class Version20180718125528 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE sylius_refund_refund ADD type VARCHAR(255) NOT NULL, CHANGE refundedunitid refunded_unit_id INT DEFAULT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_DEF86A0EE8F826668CDE5729 ON sylius_refund_refund (refunded_unit_id, type)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP INDEX UNIQ_DEF86A0EE8F826668CDE5729 ON sylius_refund_refund');
        $this->addSql('ALTER TABLE sylius_refund_refund DROP type, CHANGE refunded_unit_id refundedUnitId INT DEFAULT NULL');
    }
}
