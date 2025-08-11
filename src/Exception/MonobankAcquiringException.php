<?php

declare(strict_types=1);

namespace Monobank\Acquiring\Exception;

use Throwable;

interface MonobankAcquiringException extends Throwable
{
    public const INVALID_BASE_URL_CODE = 2000;
    public const INVALID_API_TOKEN_CODE = 2001;
    public const INVALID_QR_ID_CODE = 2002;
    public const INVALID_REDIRECT_URL_CODE = 2003;
    public const INVALID_WEBHOOK_URL_CODE = 2004;
    public const INVALID_VALIDITY_TIME_CODE = 2005;
    public const INVALID_TERMINAL_CODE = 2006;
    public const INVALID_EMPLOYEE_ID_CODE = 2007;
    public const INVALID_DESTINATION_CODE = 2008;
    public const INVALID_EMAIL_CODE = 2009;
    public const INVALID_BASKET_ITEM_CODE = 2010;
    public const INVALID_COMMENT_CODE = 2011;
    public const INVALID_INVOICE_ID_CODE = 2011;
    public const INVALID_CARD_TOKEN_CODE = 2012;
    public const INVALID_WALLET_ID_CODE = 2013;
    public const INVALID_CARD_DATA_CODE = 2014;
    public const INVALID_GOOGLE_PAY_DATA_CODE = 2015;
    public const INVALID_APPLE_PAY_DATA_CODE = 2016;


    public const FORBIDDEN_CODE = 3000;
    public const NOT_FOUND_CODE = 3001;
    public const TOO_MANY_REQUEST_CODE = 3002;
    public const INTERNAL_SERVER_ERROR_CODE = 3003;
    public const UNEXPECTED_ERROR_CODE = 3004;
    public const BAD_REQUEST_ERROR_CODE = 3005;
    public const WEBHOOK_VERIFICATION_ERROR_CODE = 3006;
}
