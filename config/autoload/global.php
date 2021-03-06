<?php

return [
    'doctrine'    => [
        'connection'    => [
            'orm_default' => [
                'driverClass' => 'Doctrine\DBAL\Driver\PDOMySql\Driver',
                'params'      => [
                    'host'          => '',
                    'port'          => '3306',
                    'user'          => '',
                    'password'      => '',
                    'dbname'        => '',
                    'driverOptions' => [
                        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"
                    ]
                ]
            ]
        ],
        'configuration' => [
            'orm_default' => [
                'metadata_cache'   => 'filesystem',
                'query_cache'      => 'filesystem',
                'generate_proxies' => true,
                'proxy_dir'        => __DIR__ . '/../../data/generated/doctrine-module-proxy'
            ]
        ],
        'cache'         => [
            'filesystem' => [
                'directory' => __DIR__ . '/../../data/cache/doctrine-module-cache'
            ]
        ]
    ],
    'google_maps' => [
        'source_url' => 'https://maps.googleapis.com/maps/api/js',
        'api_key'    => '${google.maps.api_key}',
    ],
    'twitter'     => [
        'api_endpoint' => 'https://api.twitter.com',
        'api_version'  => '1.1',
        'api_key'      => null,
        'api_secret'   => null
    ],
    'search_api'  => [
        'radius' => '50km',
        'cache'  => [
            'enabled' => true,
            'ttl'     => 3600,
            'adapter' => [
                'name'    => 'filesystem',
                'options' => [
                    'cache_dir' => 'data/cache/search-api-cache'
                ],
            ],
            'plugins' => [
                'exceptionhandler'     => ['throw_exceptions' => false],
                ['name' => 'serializer'],
                'clearexpiredbyfactor' => ['clearing_factor' => 5]
            ],
        ]
    ],
    'http_client_defaults' => [
        'sslverifypeer' => true,
        'sslcapath' => '/etc/ssl/certs'
    ]
];
