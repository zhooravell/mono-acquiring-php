<?php

declare(strict_types=1);

namespace Monobank\Acquiring\Exception;

use Exception;

final class InvalidBasketItemException extends Exception implements MonobankAcquiringException
{
    public static function blankName(): self
    {
        return new self('Basket order item name should not be blank.', self::INVALID_BASKET_ITEM_CODE);
    }

    public static function blankCode(): self
    {
        return new self('Basket order item code should not be blank.', self::INVALID_BASKET_ITEM_CODE);
    }

    public static function blankIconUrl(): self
    {
        return new self(
            'Basket order item icon URL should not be blank.',
            self::INVALID_BASKET_ITEM_CODE,
        );
    }

    public static function invalidIconURL(string $url): self
    {
        return new self(
            sprintf('Basket order item icon URL "%s" is not a valid url.', $url),
            self::INVALID_BASKET_ITEM_CODE,
        );
    }
}
