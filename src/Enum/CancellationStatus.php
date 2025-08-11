<?php

declare(strict_types=1);

namespace Monobank\Acquiring\Enum;

enum CancellationStatus: string
{
    case UNKNOWN = 'unknown';
    case PROCESSING = 'processing';
    case SUCCESS = 'success';
    case FAILURE = 'failure';
}
