<?php

declare(strict_types=1);

namespace Monobank\Acquiring\Webhook;

class OpensslWebhookSignatureVerifier implements WebhookSignatureVerifierInterface
{
    public function verify(string $signature, string $payload, string $publicKey): bool
    {
        $sign = base64_decode($signature);
        $key = openssl_get_publickey(base64_decode($publicKey));
        $result = openssl_verify($payload, $sign, $key, OPENSSL_ALGO_SHA256);

        return 1 === $result;
    }
}
