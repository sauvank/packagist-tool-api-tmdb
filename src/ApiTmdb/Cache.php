<?php


namespace ApiTmdb;


class Cache extends \Memcached
{
    private $prefix = 'SAUVANK_APITMDB_CACHE_';
    public function __construct(string $host = 'localhost',int $port = 11211, int $weight = 0)
    {
        parent::__construct();
        $this->addServer($host, $port,$weight);
//        $this->flush();
    }
}
