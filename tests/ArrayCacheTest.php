<?php

use Openapi\Cache\ArrayCache;
use PHPUnit\Framework\TestCase;

final class ArrayCacheTest extends TestCase
{
    private ArrayCache $cache;

    protected function setUp(): void
    {
        $this->cache = new ArrayCache();
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
