<?php

use Openapi\OauthClient;
use PHPUnit\Framework\TestCase;

final class OauthClientTest extends TestCase
{
    private string $username = 'test_username';
    private string $apikey = 'test_apikey';

    public function testOauthClientCreation(): void
    {
        $client = new OauthClient($this->username, $this->apikey, true);
        $this->assertInstanceOf(OauthClient::class, $client);
    }

    public function testOauthClientCanBeCreatedFromEnvironmentVariables(): void
    {
        $username = getenv('OPENAPI_USERNAME');
        $apikey = getenv('OPENAPI_SANDBOX_KEY');

        $this->assertNotFalse($username, 'OPENAPI_USERNAME is not set');
        $this->assertNotFalse($apikey, 'OPENAPI_SANDBOX_KEY is not set');
        $this->assertNotSame('', $username, 'OPENAPI_USERNAME is empty');
        $this->assertNotSame('', $apikey, 'OPENAPI_SANDBOX_KEY is empty');

        $client = new OauthClient($username, $apikey, true);
        $this->assertInstanceOf(OauthClient::class, $client);
    }

    public function testOauthClientProductionMode(): void
    {
        $client = new OauthClient($this->username, $this->apikey, false);
        $this->assertInstanceOf(OauthClient::class, $client);
    }

    public function testEnvironmentVariablesAreAvailable(): void
    {
        $this->assertSame('test_user', getenv('OPENAPI_USERNAME'));
        $this->assertSame('test_key', getenv('OPENAPI_SANDBOX_KEY'));
        $this->assertSame('https://api.com', getenv('OPENAPI_OAUTH_SANDBOX_URL'));
        $this->assertSame('https://api.com', getenv('OPENAPI_OAUTH_URL'));
        $this->assertSame('https://example.com', getenv('OPENAPI_BASE_URL'));
    }

    public function testCreateTokenWithScopes(): void
    {
        $this->markTestSkipped('Requires valid credentials for integration test');

        $client = new OauthClient($this->username, $this->apikey, true);
        $scopes = [
            'GET:test.imprese.openapi.it/advance',
            'POST:test.postontarget.com/fields/country'
        ];

        $result = $client->createToken($scopes, 3600);
        $this->assertIsString($result);
        $data = json_decode($result, true);
        $this->assertArrayHasKey('token', $data);
    }
}
