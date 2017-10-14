<?php

	session_start();

	require __DIR__."/../vendor/autoload.php";

	$app = new \Slim\App([
		"displayErrorDetails" => true,
		"db" => [
 
               'driver' => 'mysql',
 
               'host' => 'localhost',
 
               'database' => 'slim',
 
               'username' => 'root',
 
               'password' => '',
 
               'charset' => 'utf8',
 
               'collation' => 'utf8_unicode_ci',
       ]
	]);
	//Attaching our views to Slim container

	$container = $app->getContainer();

	//Set database connection and add it to the container:

	$capsule = new \Illuminate\Database\Capsule\Manager;
	$capsule->addConnection($container['db']);
	//$capsule->setGlobal();
	$capsule->bootEloquent();

	$conatiner['db'] = function($container) use ($capsule){
		return $capsule;
	};

	$container['view'] = function($container){

		$view = new \Slim\Views\Twig(__DIR__."/../resources/views", [
			"cache" => false
		]);

		$view->addExtension(new \Slim\Views\TwigExtension(
			$container->router,
			$container->request->getUri()
		));

		return $view;
	};

	//Adding BaseController to the container

	$container['BaseController'] = function($container){
		return new \App\Controllers\BaseController($container);
	};

	//Adding home controller to the container

	$container['HomeController'] = function($container){
		return new \App\Controllers\HomeController($container);
	};

	//Declaring routes
	
	require __DIR__."/../app/routes.php";