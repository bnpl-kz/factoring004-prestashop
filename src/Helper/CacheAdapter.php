<?php

namespace BnplPartners\Factoring004Prestashop\Helper;

use Psr\SimpleCache\CacheInterface;
use Cache;

class CacheAdapter implements CacheInterface
{
    private $cache;

    public function __construct(Cache $cache)
    {
        $this->cache = $cache;
    }

    /**
     * @inheritDoc
     */
    public function get($key, $default = null)
    {
        if ($this->has($key)) {
            return $this->cache->get($key);
        }
        return $default;
    }

    /**
     * @inheritDoc
     */
    public function set($key, $value, $ttl = null)
    {
        return $this->cache->set($key, $value, $ttl);
    }

    /**
     * @inheritDoc
     */
    public function delete($key)
    {
        $this->cache->delete($key);
    }

    /**
     * @inheritDoc
     */
    public function clear()
    {
        $this->cache->clear();
    }

    /**
     * @inheritDoc
     */
    public function getMultiple($keys, $default = null)
    {
    }

    /**
     * @inheritDoc
     */
    public function setMultiple($values, $ttl = null)
    {
    }

    /**
     * @inheritDoc
     */
    public function deleteMultiple($keys)
    {
    }

    /**
     * @inheritDoc
     */
    public function has($key)
    {
        return $this->cache->exists($key);
    }
}