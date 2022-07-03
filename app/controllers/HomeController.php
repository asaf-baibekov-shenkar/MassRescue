<?php

class HomeController extends Controller {

	public function index() {
		$this->view('home/index', [
			'js' => JS_PATH . 'home.js'
		]);
	}

	public function create() {
		User::create([
			'id_number' => '206423131',
			'first_name' => 'Ori',
			'last_name' => 'Bashary',
			'password' => '1234567'
		]);
	}

	public function users() {
		header('Content-Type: application/json');
		echo User::all()->toJson();
	}
}