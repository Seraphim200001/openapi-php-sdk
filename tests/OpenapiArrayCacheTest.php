<?php

use Openapi\Cache\OpenapiArrayCache;
use PHPUnit\Framework\TestCase;

final class OpenapiArrayCacheTest extends TestCase
{
    private OpenapiArrayCache $cache;

    protected function setUp(): void
    {
        $this->cache = new OpenapiArrayCache();
    }

    public function testCacheImplementation(): void
    {
        $this->cache->save('key1', 'value1', 3600);
        $this->assertEquals('value1', $this->cache->get('key1'));
    }

    public function testCacheExpiration(): void
    {
        $this->cache->save('key2', 'value2', -1);
        $this->assertNull($this->cache->get('key2'));
    }

    public function testCacheDelete(): void
    {
        $this->cache->save('key3', 'value3', 3600);
        $this->cache->delete('key3');
        $this->assertNull($this->cache->get('key3'));
    }

    public function testCacheClear(): void
    {
        $this->cache->save('key4', 'value4', 3600);
        $this->cache->save('key5', 'value5', 3600);
        $this->cache->clear();
        $this->assertNull($this->cache->get('key4'));
        $this->assertNull($this->cache->get('key5'));
    }
}
