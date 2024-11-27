<?php

declare(strict_types=1);

namespace Tests\Sylius\RefundPlugin\Behat\Context\Transform;

use Behat\Behat\Context\Context;
use Sylius\Component\Core\Model\OrderInterface;
use Sylius\Component\Core\Repository\OrderRepositoryInterface;
use Webmozart\Assert\Assert;

final class OrderContext implements Context
{
    /** @param OrderRepositoryInterface<OrderInterface> $orderRepository */
    public function __construct(private readonly OrderRepositoryInterface $orderRepository)
    {
    }

    /**
     * @Transform /^order "([^"]+)"$/
     */
    public function getOrderByNumber(string $orderNumber): OrderInterface
    {
        /** @var OrderInterface|null $order */
        $order = $this->orderRepository->findOneBy(['number' => str_replace('#', '', $orderNumber)]);

        Assert::notNull($order, sprintf('Cannot find order with number %s', $orderNumber));

        return $order;
    }
}
