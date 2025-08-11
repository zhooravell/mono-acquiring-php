<?php

declare(strict_types=1);

namespace Monobank\Acquiring\Webhook;

interface WebhookSignatureVerifierInterface
{
    /**
     * @param string $signature value from X-Sign header in webhook request
     * @param string $payload webhook request body
     * @param string $publicKey value from /api/merchant/pubkey
     */
    public function verify(string $signature, string $payload, string $publicKey): bool;
}
