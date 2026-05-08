<?php

use Openapi\ApiException;
use PHPUnit\Framework\TestCase;

final class ApiExceptionTest extends TestCase
{
    public function testApiExceptionCreation(): void
    {
        $message = 'Test exception message';
        $code = 400;

        $exception = new ApiException($message, $code);

        $this->assertEquals($message, $exception->getMessage());
        $this->assertEquals($code, $exception->getCode());
    }

    public function testSetServerResponse(): void
    {
        $exception = new ApiException('Test message');

        $response = ['error' => 'Server error'];
        $headers = 'Content-Type: application/json';

        $exception->setServerResponse($response, $headers, 'raw body', 500);

        $this->assertEquals($response, $exception->getServerResponse());
        $this->assertEquals($headers, $exception->getHeaders());
        $this->assertEquals('raw body', $exception->getRawResponse());
        $this->assertEquals(500, $exception->getHttpCode());
    }
}
