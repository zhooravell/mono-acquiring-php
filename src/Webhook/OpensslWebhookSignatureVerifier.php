<?php

declare(strict_types=1);

namespace Monobank\Acquiring\Webhook;

use Monobank\Acquiring\Exception\WebhookSignatureException;

class OpensslWebhookSignatureVerifier implements WebhookSignatureVerifierInterface
{
    /**
     * @throws WebhookSignatureException
     */
    public function verify(string $signature, string $payload, string $publicKey): bool
    {
        $sign = base64_decode($signature);
        $key = openssl_get_publickey(base64_decode($publicKey));
        $result = @openssl_verify($payload, $sign, $key, OPENSSL_ALGO_SHA256);

        if ($result === 1) {
            return true;
        } elseif ($result === 0) {
            return false;
        } else {
            throw WebhookSignatureException::create((string) openssl_error_string());
        }
    }
}
