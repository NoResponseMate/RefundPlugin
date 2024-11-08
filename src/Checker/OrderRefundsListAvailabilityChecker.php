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

namespace Sylius\RefundPlugin\Checker;

use Sylius\Component\Core\Model\OrderInterface;
use Sylius\Component\Core\OrderPaymentStates;
use Sylius\Component\Core\Repository\OrderRepositoryInterface;

final class OrderRefundsListAvailabilityChecker implements OrderRefundingAvailabilityCheckerInterface
{
    /** @param OrderRepositoryInterface<OrderInterface> $orderRepository */
    public function __construct(private readonly OrderRepositoryInterface $orderRepository)
    {
    }

    public function __invoke(string $orderNumber): bool
    {
        /** @var OrderInterface|null $order */
        $order = $this->orderRepository->findOneByNumber($orderNumber);
        if ($order === null) {
            throw new \InvalidArgumentException(sprintf('Order with number "%s" does not exist.', $orderNumber));
        }

        return
            in_array($order->getPaymentState(), [
                OrderPaymentStates::STATE_PAID,
                OrderPaymentStates::STATE_PARTIALLY_REFUNDED,
                OrderPaymentStates::STATE_REFUNDED,
            ], true) &&
            $order->getTotal() !== 0
        ;
    }
}
