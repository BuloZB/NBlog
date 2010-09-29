<?php

use Nette\Debug,
	Nette\Environment,
	Nette\Application\Route,
	Nette\Application\SimpleRouter;


// Load Nette Framework
require LIBS_DIR . '/Nette/loader.php';


// Configure environment
Debug::enable();
Environment::loadConfig();
$application = Environment::getApplication();
$application->errorPresenter = 'Error';
$application->catchExceptions = Environment::isProduction();


// Database (Doctrine)
require(__DIR__ . '/bootstrap-doctrine.php');


if (Environment::getName() !== 'console') {

	// Setup router
	$router = $application->getRouter();

	if (function_exists('apache_get_modules') && in_array('mod_rewrite', apache_get_modules())) {

		# AdminModule routes
		$router[] = new Route('admin/<presenter>/<action>/<id>', array(
			'module'	=> 'Admin',
			'presenter'	=> 'Default',
			'action'	=> 'default',
			'id'		=> null
		));

		# FrontModule routes
		$router[] = new Route('tag/<tag>', array(
			'presenter'	=> 'Front:Default',
			'action'	=> 'tag',
		));

		$router[] = new Route('<slug [a-z0-9_-]+>', array(
			'presenter'	=> 'Front:Default',
			'action'	=> 'post',
		));

		$router[] = new Route('index.php', array(
			'module'	=> 'Front',
			'presenter'	=> 'Default',
		), Route::ONE_WAY);

		$router[] = new Route('<presenter>/<action>/<id>', array(
			'presenter'	=> 'Front:Default',
			'action'	=> 'default',
			'id'		=> NULL,
		));

	} else {
		$router[] = new SimpleRouter('Front:Default:default');
	}


	// Run the application!!!
	$application->run();

}
