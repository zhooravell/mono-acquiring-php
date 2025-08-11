<?php

declare(strict_types=1);

namespace Monobank\Acquiring\ValueObject;

use Composer\InstalledVersions;

/**
 * Value object for X-Cms and X-Cms-Version
 *
 * @see https://api.monobank.ua/docs/acquiring.html
 */
final class Cms
{
    private const PACKAGE = 'monobank/acquiring';
    private readonly string $name;
    private readonly string $version;

    public function __construct(string $name = '', string $version = '')
    {
        $name = trim($name);
        $version = trim($version);

        if (empty($name)) {
            $name = 'PHP SDK';
        }

        if (empty($version)) {
            if (InstalledVersions::isInstalled(self::PACKAGE)) {
                $version = InstalledVersions::getPrettyVersion(self::PACKAGE);
            }
        }

        $this->name = $name;
        $this->version = $version;
    }

    public function getVersion(): string
    {
        return $this->version;
    }

    public function getName(): string
    {
        return $this->name;
    }
}
