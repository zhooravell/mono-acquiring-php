How to work with exceptions
===========================
> All exceptions in SDK implement MonobankAcquiringException interface.

[<- Back to README.md](../README.md)

# Categories

| Category         | Code  | Description                               |
|------------------|-------|-------------------------------------------|
| Validation       | 2**** | Internal SDK validation exception         |
| Service Response | 3**** | Exception from Monobank Acquiring Service |

# Example

Catch all SDK's exceptions

```php
<?php

namespace App;

use Monobank\Acquiring\Client;
use Monobank\Acquiring\Request\RemoveQrPaymentAmountRequest;
use Monobank\Acquiring\Exception\MonobankAcquiringException;

$client = new Client();

try {
    $client->removeQrPaymentAmount(new RemoveQrPaymentAmountRequest('123456'));
} catch (MonobankAcquiringException $exception) {
    var_dump($exception->getCode());
    // your code
}
```
Catch specific SDK's exception

```php
<?php

namespace App;

use Monobank\Acquiring\Client;
use Monobank\Acquiring\Request\RemoveQrPaymentAmountRequest;
use Monobank\Acquiring\Exception\InvalidQRIdException;
use Monobank\Acquiring\Exception\NotFoundException;

$client = new Client();

try {
    $client->removeQrPaymentAmount(new RemoveQrPaymentAmountRequest('123456'));
} catch (InvalidQRIdException $exception) {
    // your code
} catch (NotFoundException $exception) {
    // your code
}
```

[<- Back to README.md](../README.md)