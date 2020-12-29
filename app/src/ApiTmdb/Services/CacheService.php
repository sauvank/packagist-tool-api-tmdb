<?php


namespace ApiTmdb\Services;


class CacheService
{
    private static $prefix = 'SAUVANK_APITMDB_CACHE_';
    private static $_instance = null;


    public function __construct()
    {
        var_dump('init cacheService');
    }

    public static function getCache(string $host = 'localhost',int $port = 11211, int $weight = 0):\Memcached {

        if(is_null(self::$_instance)) {
            self::$_instance = new \Memcached();
            self::$_instance->addServer($host, $port,$weight);
//            self::$_instance->flush(2);
        }

        return self::$_instance;
    }

    public function set(string $key, $data, int $expiration = 60*60): bool
    {
        return self::getCache()->set(self::$prefix . $key, $data, $expiration);
    }

    public function get(string $key){
        return self::getCache()->get(self::$prefix . $key);
    }
}
