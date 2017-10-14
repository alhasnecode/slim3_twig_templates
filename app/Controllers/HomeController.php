<?php


	namespace App\Controllers;

	use Slim\Views\Twig as Views;
	use App\Models\User;

	/**
	* The home controller
	*/
	class HomeController extends BaseController
	{

		public function index($request, $response){

			$users = User::all();

			return $this->container->view->render($response, 'home.twig', ['users' => $users]);
		}

		public function create($request, $response){

			$user = User::create([
				'name' => 'Mohamed',
				'email' => 'alhasne5.mohamed@gmail.com',
				'password' => '123456'
			]);
			$router = $this->container->router;
			return $response->withRedirect($router->pathFor('all'));

		}
	}