<?php

use Openapi\OpenapiException;
use PHPUnit\Framework\TestCase;

final class OpenapiExceptionTest extends TestCase
{
    public function testExceptionCreation(): void
    {
        $message = 'Test exception message';
        $code = 400;

        $exception = new OpenapiException($message, $code);

        $this->assertEquals($message, $exception->getMessage());
        $this->assertEquals($code, $exception->getCode());
    }

    public function testSetServerResponse(): void
    {
        $exception = new OpenapiException('Test message');

        $response = ['error' => 'Server error'];
        $headers = 'Content-Type: application/json';

        $exception->setServerResponse($response, $headers, 'raw body', 500);

        $this->assertEquals($response, $exception->getServerResponse());
        $this->assertEquals($headers, $exception->getHeaders());
        $this->assertEquals('raw body', $exception->getRawResponse());
        $this->assertEquals(500, $exception->getHttpCode());
    }
}
