<?php

	$app->get('/first', function($request, $response){
		return 'My first route';
	});

	$app->get('/home', function($request, $response){
		return $this->view->render($response, 'home.twig');
	});

	$app->get('/create', 'HomeController:create')->setName('create');
	$app->get('/all', 'HomeController:index')->setName('all');