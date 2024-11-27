<?php

declare(strict_types=1);

namespace Tests\Sylius\RefundPlugin\Behat\Context\Setup;

use Behat\Behat\Context\Context;
use Doctrine\Persistence\ObjectManager;
use Sylius\Behat\Service\SharedStorageInterface;
use Sylius\Component\Core\Formatter\StringInflector;
use Sylius\Component\Core\Test\Services\DefaultChannelFactoryInterface;

final class ChannelContext implements Context
{
    public function __construct(
        private readonly SharedStorageInterface $sharedStorage,
        private readonly DefaultChannelFactoryInterface $unitedStatesChannelFactory,
        private readonly DefaultChannelFactoryInterface $defaultChannelFactory,
        private readonly ObjectManager $channelManager
    ) {
    }

    /**
     * @Given the store operates on a single :color channel in "United States"
     */
    public function storeOperatesOnASingleColorChannelInUnitedStates(string $color): void
    {
        $defaultData = $this->unitedStatesChannelFactory->create();
        $defaultData['channel']->setColor($color);

        $this->sharedStorage->setClipboard($defaultData);
        $this->sharedStorage->set('channel', $defaultData['channel']);
        $this->channelManager->flush();
    }

    /**
     * @Given the store operates on a channel named :channelName in :currencyCode currency with :color color
     */
    public function theStoreOperatesOnAColorChannelNamed(string $channelName, string $currencyCode, string $color): void
    {
        $channelCode = StringInflector::nameToLowercaseCode($channelName);
        $defaultData = $this->defaultChannelFactory->create($channelCode, $channelName, $currencyCode);
        $defaultData['channel']->setColor($color);

        $this->sharedStorage->setClipboard($defaultData);
        $this->sharedStorage->set('channel', $defaultData['channel']);
        $this->channelManager->flush();
    }
}
