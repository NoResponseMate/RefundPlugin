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

namespace Sylius\RefundPlugin\Generator;

use Symfony\Component\Config\FileLocatorInterface;

final readonly class PdfOptionsGenerator implements PdfOptionsGeneratorInterface
{
    /**
     * @param array<string, mixed> $knpSnappyOptions
     * @param string[] $allowedFiles
     */
    public function __construct(
        private FileLocatorInterface $fileLocator,
        private array $knpSnappyOptions,
        private array $allowedFiles,
    ) {
    }

    /** @return array<string, mixed> */
    public function generate(): array
    {
        $options = $this->knpSnappyOptions;

        if (empty($this->allowedFiles)) {
            return $options;
        }

        if (!isset($options['allow'])) {
            $options['allow'] = [];
        } elseif (!is_array($options['allow'])) {
            $options['allow'] = [$options['allow']];
        }

        $options['allow'] = array_merge(
            $options['allow'],
            array_map(fn ($file) => $this->fileLocator->locate($file), $this->allowedFiles),
        );

        return $options;
    }
}
