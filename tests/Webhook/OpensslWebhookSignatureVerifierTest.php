<?php // phpcs:ignoreFile

declare(strict_types=1);

namespace Monobank\Acquiring\Tests\Webhook;

use Monobank\Acquiring\Exception\MonobankAcquiringException;
use Monobank\Acquiring\Exception\WebhookSignatureException;
use Monobank\Acquiring\Webhook\OpensslWebhookSignatureVerifier;
use PHPUnit\Framework\TestCase;

class OpensslWebhookSignatureVerifierTest extends TestCase
{
    public function testValidSignature(): void
    {
        $signature = 'MEQCIEaJMN/d0xcZoEgI1zya+yE6GYJb2f2osBZMPgjtXNUiAiAGVfUR9dxj2Ix7blF7MjMdAU2VZcpuyUuB6zncVoFadg==';
        $publicKey = 'LS0tLS1CRUdJTiBQVUJMSUMgS0VZLS0tLS0KTUZrd0V3WUhLb1pJemowQ0FRWUlLb1pJemowREFRY0RRZ0FFK0UxRnBVZzczYmhGdmp2SzlrMlhJeTZtQkU1MQpib2F0RU1qU053Z1l5ZW55blpZQWh3Z3dyTGhNY0FpT25SYzNXWGNyMGRrY2NvVnFXcVBhWVQ5T3hRPT0KLS0tLS1FTkQgUFVCTElDIEtFWS0tLS0tCg==';
        $payload = '{"invoiceId":"250811tUZjKAWjrnb9b","status":"success","payMethod":"wallet","amount":20200,"ccy":980,"finalAmount":20200,"createdDate":"2025-08-11T06:08:52Z","modifiedDate":"2025-08-11T06:08:54Z","reference":"ce223cb7-1c95-4f3b-8a3e-2a5fe21bce6c","destination":"Розрахунок за дату 2025-08-11 по картці {{masked_pan}} в торговій точці {{terminal_owner}} ({{terminal_retailer}})","paymentInfo":{"rrn":"061673331001","approvalCode":"117524","tranId":"19277588","terminal":"XPZ10001","bank":"Універсал Банк","paymentSystem":"visa","country":"804","fee":263,"paymentMethod":"wallet","maskedPan":"44440311******39"}}';

        $verifier = new OpensslWebhookSignatureVerifier();

        self::assertTrue($verifier->verify($signature, $payload, $publicKey));
    }

    public function testInvalidSignature(): void
    {
        $signature = 'MEQCIEaJMN/d0xcZoEgI1zya+yE6GYJb2f2osBZMPgjtXNUiAiAGVfUR9dxj2Ix7blF7MjMdAU2VZcpuyUuB6zncVoFadg==';
        $publicKey = 'LS0tLS1CRUdJTiBQVUJMSUMgS0VZLS0tLS0KTUZrd0V3WUhLb1pJemowQ0FRWUlLb1pJemowREFRY0RRZ0FFK0UxRnBVZzczYmhGdmp2SzlrMlhJeTZtQkU1MQpib2F0RU1qU053Z1l5ZW55blpZQWh3Z3dyTGhNY0FpT25SYzNXWGNyMGRrY2NvVnFXcVBhWVQ5T3hRPT0KLS0tLS1FTkQgUFVCTElDIEtFWS0tLS0tCg==';
        $payload = '{"invoiceId":"250811tUZjKAWjrnb9b"}}';

        $verifier = new OpensslWebhookSignatureVerifier();

        self::assertFalse($verifier->verify($signature, $payload, $publicKey));
    }

    public function testError(): void
    {
        error_reporting(E_ALL);  // Показати всі помилки, включаючи попередження
        ini_set('display_errors', 1);  // Виводити помилки в браузер

        $this->expectException(WebhookSignatureException::class);
        $this->expectException(MonobankAcquiringException::class);
        $this->expectExceptionCode(MonobankAcquiringException::WEBHOOK_VERIFICATION_ERROR_CODE);

        $signature = 'test';
        $publicKey = 'test';
        $payload = '{"invoiceId":"250811tUZjKAWjrnb9b"}}';

        $verifier = new OpensslWebhookSignatureVerifier();

        $verifier->verify($signature, $payload, $publicKey);
    }
}
