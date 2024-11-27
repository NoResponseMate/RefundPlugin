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

namespace Sylius\RefundPlugin\Model;

final readonly class ShipmentRefund implements UnitRefundInterface
{
    public function __construct(private int $shipmentId, private int $total)
    {
    }

    public function id(): int
    {
        return $this->shipmentId;
    }

    public function total(): int
    {
        return $this->total;
    }

    public static function type(): RefundType
    {
        return RefundType::shipment();
    }
}
