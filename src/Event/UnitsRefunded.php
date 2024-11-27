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

namespace Sylius\RefundPlugin\Event;

use Sylius\RefundPlugin\Model\OrderItemUnitRefund;
use Sylius\RefundPlugin\Model\UnitRefundInterface;
use Webmozart\Assert\Assert;

class UnitsRefunded
{
    /**
     * @param array<UnitRefundInterface[]|OrderItemUnitRefund[]> $units
     */
    public function __construct(
        private readonly string $orderNumber,
        /** @var array|UnitRefundInterface[]|OrderItemUnitRefund[] */
        private readonly array $units,
        private readonly mixed $paymentMethodId,
        private readonly int $amount,
        private readonly string|int $currencyCode,
        private readonly string $comment,
    ) {
        Assert::allIsInstanceOf($units, UnitRefundInterface::class);
    }

    public function orderNumber(): string
    {
        return $this->orderNumber;
    }

    /** @return array|UnitRefundInterface[] */
    public function units(): array
    {
        return $this->units;
    }

    public function paymentMethodId(): int
    {
        Assert::integer($this->paymentMethodId);

        return $this->paymentMethodId;
    }

    public function amount(): int
    {
        Assert::integer($this->amount);

        return $this->amount;
    }

    public function currencyCode(): string
    {
        Assert::string($this->currencyCode);

        return $this->currencyCode;
    }

    public function comment(): string
    {
        return $this->comment;
    }
}
