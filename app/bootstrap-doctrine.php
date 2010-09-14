<?php

use	Nette\Environment,
	Doctrine\Common\EventManager,
	Doctrine\ORM\Configuration,
	Doctrine\ORM\EntityManager,
	NBlog\Panels\Doctrine2\Doctrine2Panel;


$database	= Environment::getConfig('database');
$doctrine	= Environment::getConfig('doctrine');
$config		= new Configuration();

// Proxies
$config->setProxyDir($doctrine->proxyDir);
$config->setProxyNamespace($doctrine->proxyNamespace);
$config->setAutoGenerateProxyClasses(!Environment::isProduction());


// Metadata
$metadataDriver = $config->newDefaultAnnotationDriver($doctrine->entityDir);
$config->setMetadataDriverImpl($metadataDriver);


// Cache
if (Environment::isProduction() && extension_loaded('apc')) {
	$cache = new Doctrine\Common\Cache\ApcCache();
} else {
	$cache = new Doctrine\Common\Cache\ArrayCache();
}
$config->setMetadataCacheImpl($cache);
$config->setQueryCacheImpl($cache);


// Setup charset for MySQL
$eventManager = new EventManager();
if ($database->driver == 'pdo_mysql') {
	$eventManager->addEventSubscriber(new \Doctrine\DBAL\Event\Listeners\MysqlSessionInit('utf8'));
}


// EntityManager
$entityManager = EntityManager::create((array) $database, $config, $eventManager);
Environment::getServiceLocator()->addService('Doctrine\ORM\EntityManager', $entityManager);


// Aliases
Environment::setServiceAlias('Doctrine\\ORM\\EntityManager', 'EntityManager');
Environment::setServiceAlias('NBlog\\ORM\\DatabaseManager', 'DatabaseManager');


// Debugbar
if ($database->profiler) {
	$config->setSQLLogger(Doctrine2Panel::getAndRegister());
}


// cleanup
unset($database, $doctrine, $cache, $config, $metadataDriver, $eventManager, $entityManager);
