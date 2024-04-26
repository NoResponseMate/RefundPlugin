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

namespace Sylius\RefundPlugin\Exception;

final class MoreThanOneTaxAdjustment extends \InvalidArgumentException
{
    public static function occur(): self
    {
        return new self('Each adjustable entity must not have more than 1 tax adjustment');
    }
}
