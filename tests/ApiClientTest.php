<?php

use Openapi\Client;
use PHPUnit\Framework\TestCase;

final class ApiClientTest extends TestCase
{
    private string $testToken = 'test_token_123';

    public function testClientCreation(): void
    {
        $client = new Client($this->testToken);
        $this->assertInstanceOf(Client::class, $client);
    }

    public function testGetRequest(): void
    {
        $this->markTestSkipped('Requires valid token for integration test');

        $client = new Client($this->testToken);
        $params = ['denominazione' => 'altravia', 'provincia' => 'RM'];

        $result = $client->get('https://test.company.openapi.com/IT-advanced', $params);
        $this->assertIsString($result);
    }

    public function testPostRequest(): void
    {
        $this->markTestSkipped('Requires valid token for integration test');

        $client = new Client($this->testToken);
        $payload = ['limit' => 10, 'query' => ['country_code' => 'IT']];

        $result = $client->post('https://test.postontarget.com/fields/country', $payload);
        $this->assertIsString($result);
    }

    public function testPutRequest(): void
    {
        $this->markTestSkipped('Requires valid token for integration test');

        $client = new Client($this->testToken);
        $result = $client->put('https://example.com/api', ['test' => 'data']);
        $this->assertIsString($result);
    }

    public function testDeleteRequest(): void
    {
        $this->markTestSkipped('Requires valid token for integration test');

        $client = new Client($this->testToken);
        $result = $client->delete('https://example.com/api/123');
        $this->assertIsString($result);
    }

    public function testPatchRequest(): void
    {
        $this->markTestSkipped('Requires valid token for integration test');

        $client = new Client($this->testToken);
        $result = $client->patch('https://example.com/api/123', ['update' => 'data']);
        $this->assertIsString($result);
    }
}
