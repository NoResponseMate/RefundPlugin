<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Sylius\RefundPlugin\Resolver;

use Sylius\RefundPlugin\Entity\CreditMemoInterface;
use Sylius\RefundPlugin\Model\CreditMemoPdf;

interface CreditMemoFileResolverInterface
{
    public function resolveById(string $creditMemoId): CreditMemoPdf;

    public function resolveByCreditMemo(CreditMemoInterface $creditMemo): CreditMemoPdf;
}
