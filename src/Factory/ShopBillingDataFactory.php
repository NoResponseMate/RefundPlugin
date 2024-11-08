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

namespace Sylius\RefundPlugin\Factory;

use Sylius\Component\Resource\Factory\FactoryInterface;
use Sylius\RefundPlugin\Entity\ShopBillingDataInterface;

final class ShopBillingDataFactory implements ShopBillingDataFactoryInterface
{
    public function __construct(private readonly FactoryInterface $shopBillingDataFactory)
    {
    }

    public function createNew(): ShopBillingDataInterface
    {
        /** @var ShopBillingDataInterface $shopBillingData */
        $shopBillingData = $this->shopBillingDataFactory->createNew();

        return $shopBillingData;
    }

    public function createWithData(
        ?string $company,
        ?string $taxId,
        ?string $countryCode,
        ?string $street,
        ?string $city,
        ?string $postcode,
    ): ShopBillingDataInterface {
        $shopBillingData = $this->createNew();

        $shopBillingData->setCompany($company);
        $shopBillingData->setTaxId($taxId);
        $shopBillingData->setCountryCode($countryCode);
        $shopBillingData->setStreet($street);
        $shopBillingData->setCity($city);
        $shopBillingData->setPostcode($postcode);

        return $shopBillingData;
    }
}
