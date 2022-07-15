<?php

class HomeController extends Controller {

	public function index() {
		try {
			if (isset($_SESSION['user_id'])) {
				$user = User::findOrFail($_SESSION['user_id']);
				header('Location: ' . BASE_URL . 'events');
			} else {
				$this->view('home/index', [
					'js' => JS_PATH . 'home.js',
					'css' => CSS_PATH . 'home.css'
				]);
			}
		} catch (Illuminate\Database\Eloquent\ModelNotFoundException $exception) {
			$this->view('home/index', [
				'js' => JS_PATH . 'home.js',
				'css' => CSS_PATH . 'home.css'
			]);
		}
	}

	public function create() {
		header('Content-Type: application/json');
		$errors = [];
		if (!isset($_POST['id_number']))
			$errors['id_number'] = "id_number is missing";
		if (!isset($_POST['first_name']))
			$errors['first_name'] = "first_name is missing";
		if (!isset($_POST['last_name']))
			$errors['last_name'] = "last_name is missing";
		if (!isset($_POST['password']))
			$errors['password'] = "password is missing";
		if (!isset($_POST['role']))
			$errors['role'] = "role is missing";
		else if ($_POST['role'] != "admin" && $_POST['role'] != 'force')
			$errors['role'] = "role has to be admin or force";
		if (!empty($errors)) {
			echo '{ "errors": '; echo json_encode($errors); echo ' }';
			return;
		}
		try {
			$user = User::create([
				'id_number' => $_POST['id_number'],
				'password' => $_POST['password'],
				'first_name' => $_POST['first_name'],
				'last_name' => $_POST['last_name'],
				'role' => $_POST['role']
			]);
			echo '{ "user": '; print($user->toJson()); echo ' }';
		} catch (Illuminate\Database\QueryException $e) {
			$errorCode = $e->errorInfo[1];
			if ($errorCode == 1062) {
				$errors['user'] = "user already exist";
				echo '{ "errors": '; echo json_encode($errors); echo ' }';
			}
		}
	}

	public function users() {
		header('Content-Type: application/json');
		echo User::all()->toJson();
	}

	public function login() {
		header('Content-Type: application/json');
		$errors = [];
		if (!isset($_POST['id_number']))
			$errors['id_number'] = "id_number is missing";
		if (!isset($_POST['password']))
			$errors['password'] = "password is missing";
		if (!empty($errors)) {
			echo '{ "errors": '; echo json_encode($errors); echo ' }';
			return;
		}
		try {
			$user = User::where([
				'id_number' => $_POST['id_number'],
				'password' => $_POST['password']
			])->firstOrFail();
			$user = User::findOrFail($user['user_id']);
			$user->update(['session_id' => session_id()]);
			$_SESSION['user_id'] = $user['user_id'];
			header('Location: ' . BASE_URL . 'events');
		} catch (Illuminate\Database\Eloquent\ModelNotFoundException $exception) {
			$errors['user'] = "user not found";
			echo '{ "errors": '; echo json_encode($errors); echo ' }';
		}
	}

	public function logout() {
		header('Content-Type: application/json');
		$sid = session_id();
		try {
			$user = User::where(['session_id' => $sid])->firstOrFail();
			$user->update(['session_id' => null]);
			session_destroy();
			print_r($user->toJson());
			header('Location: ' . BASE_URL);
		} catch (Illuminate\Database\Eloquent\ModelNotFoundException $exception) {
			$errors['user'] = "user with session id " . $sid . " is not logged in";
			$errors['session_id'] = $sid;
			echo '{ "errors": '; echo json_encode($errors); echo ' }';
		}
	}
}