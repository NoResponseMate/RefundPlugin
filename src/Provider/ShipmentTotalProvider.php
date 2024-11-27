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

namespace Sylius\RefundPlugin\Provider;

use Sylius\Component\Core\Model\AdjustmentInterface;
use Sylius\Component\Order\Model\AdjustableInterface;
use Sylius\Component\Resource\Repository\RepositoryInterface;
use Sylius\RefundPlugin\Model\RefundTypeInterface;
use Webmozart\Assert\Assert;

final readonly class ShipmentTotalProvider implements RefundUnitTotalProviderInterface
{
    public function __construct(
        private RepositoryInterface $adjustmentRepository,
    ) {
    }

    public function getRefundUnitTotal(int $id): int
    {
        /** @var AdjustmentInterface|null $shippingAdjustment */
        $shippingAdjustment = $this->adjustmentRepository->findOneBy([
            'id' => $id,
            'type' => AdjustmentInterface::SHIPPING_ADJUSTMENT,
        ]);
        Assert::notNull($shippingAdjustment);

        $shipment = $shippingAdjustment->getShipment();
        Assert::isInstanceOf($shipment, AdjustableInterface::class);

        return $shipment->getAdjustmentsTotal();
    }

    public static function refundType(): string
    {
        return RefundTypeInterface::SHIPMENT;
    }
}
