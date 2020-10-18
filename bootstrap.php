<?php
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

require_once "vendor/autoload.php";

$isDevMode = true;
$proxyDir = null;
$cache = null;
$useSimpleAnnotationReader = false;
$config = Setup::createAnnotationMetadataConfiguration(array(__DIR__ . "/Entity"), $isDevMode, $proxyDir, $cache, $useSimpleAnnotationReader);

$conn = array(
    'driver' => 'pdo_sqlite',
    'path' => __DIR__ . '/Phinx/db/wineDatabase.db',
);

$entityManager = EntityManager::create($conn, $config);
