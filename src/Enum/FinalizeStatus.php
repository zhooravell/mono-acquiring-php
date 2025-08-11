<?php

declare(strict_types=1);

namespace Monobank\Acquiring\Enum;

enum FinalizeStatus: string
{
    case UNKNOWN = 'unknown';
    case SUCCESS = 'success';
}
