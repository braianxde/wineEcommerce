<?php

return
[
    'paths' => [
        'migrations' => '%%PHINX_CONFIG_DIR%%/DB/Migrations',
        'seeds' => '%%PHINX_CONFIG_DIR%%/DB/Seeds'
    ],
    'environments' => [
        'default_migration_table' => 'phinxlog',
        'default_environment' => 'development',
        'production' => [
            'adapter' => 'sqlite',
            'name' => './wineDatabase',
            'suffix'=> '.db'
        ],
        'development' => [
            'adapter' => 'sqlite',
            'name' => './wineDatabase',
            'suffix'=> '.db'
        ],
        'testing' => [
            'adapter' => 'sqlite',
            'name' => './wineDatabase',
            'suffix'=> '.db'
        ]
    ],
    'version_order' => 'creation'
];
