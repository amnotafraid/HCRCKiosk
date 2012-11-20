<?php
// bootstrap_doctrine.php

// See :doc:`Configuration <../reference/configuration>` for up to date autoloading details.
// $path = 'C:\xampp\htdocs\WebOnData2\vendor\doctrine\orm\lib\Doctrine\ORM\Tools';
// set_include_path(get_include_path() . PATH_SEPARATOR . $path);

use Doctrine\ORM\Tools\Setup;

require_once "Doctrine/ORM/Tools/Setup.php";
Setup::registerAutoloadPEAR();

// Create a simple "default" Doctrine ORM configuration for XML Mapping
$isDevMode = true;
//$config = Setup::createXMLMetadataConfiguration(array(__DIR__."/config/xml"), $isDevMode);
// or if you prefer yaml or annotations
//$config = Setup::createAnnotationMetadataConfiguration(array(__DIR__."/entities"), $isDevMode);
$config = Setup::createYAMLMetadataConfiguration(array(__DIR__."/config/yaml"), $isDevMode);
//The next line is the one that makes it verbose:
//$config->setSQLLogger(new \Doctrine\DBAL\Logging\EchoSQLLogger());

// database configuration parameters
$conn = array(
    'driver' => 'pdo_mysql',
    'host' => '127.0.0.1',            // localhost
    'dbname' => 'web_on_data_2',
    'user' => 'root',
    'password' => 'Prov356'
);

// obtaining the entity manager
$entityManager = \Doctrine\ORM\EntityManager::create($conn, $config);
/** @var $em \Doctrine\ORM\EntityManager */
