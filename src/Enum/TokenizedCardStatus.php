<?php

declare(strict_types=1);

namespace Monobank\Acquiring\Enum;

enum TokenizedCardStatus: string
{
    case UNKNOWN = 'unknown';
    case NEW = 'new';
    case CREATED = 'created';
    case FAILED = 'failed';
}
