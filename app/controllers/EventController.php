<?php

class EventController extends Controller {

	public function index() {
		$id = $_GET['id'];
		if (!isset($id)) {
			header('Location: ' . BASE_URL . 'events');
			return;
		}
		try {
			try {
				$user = User::where(['session_id' => session_id()])->firstOrFail();
				$force_cell_role = $user['role'] == "admin" ? 'admin_force_cell.js' : 'force_cell.js';
				$this->view('event/index', [
					'css' => CSS_PATH . 'event.css',
					'js' => JS_PATH . 'event.js',
					'force-cell-js' => JS_PATH . $force_cell_role,
					'consts-js' => JS_PATH . 'consts.js',
					'spinner-js' => JS_PATH . 'spinner.js',
					'event' => '{ "event": ' . Event::findOrFail($id)->toJson() . ' }',
					'forces' => '{ "forces": ' . Force::where('event_id', $id)->get()->toJson() . ' }',
					'user' => '{ "user": ' . $user->toJson() . ' }'
				]);
			} catch (Illuminate\Database\Eloquent\ModelNotFoundException $exception) {
				header('Location: ' . BASE_URL);
				return;
			}
		} catch (Illuminate\Database\Eloquent\ModelNotFoundException $exception) {
			header('Location: ' . BASE_URL . 'events');
		}
	}

	public function create() {
		header('Content-Type: application/json');
		$errors = [];
		if (!isset($_POST['event_id']))
			$errors['event_id'] = "event_id is missing";
		if (!isset($_POST['title']))
			$errors['title'] = "title is missing";
		if (!isset($_POST['subtitle']))
			$errors['subtitle'] = "subtitle is missing";

		if (!isset($_POST['type']))
			$errors['type'] = "type is missing";
		else if ($_POST['type'] != "firefighter" &&
				 $_POST['type'] != "medic" &&
				 $_POST['type'] != 'police' &&
				 $_POST['type'] != "drone" &&
				 $_POST['type'] != 'block')
			$errors['type'] = "type has to be firefighter, medic, police, drone or block";

		if (!isset($_POST['latitude']))
			$errors['latitude'] = "latitude is missing";
		if (!isset($_POST['longitude']))
			$errors['longitude'] = "longitude is missing";
		if (!empty($errors)) {
			echo '{ "errors": '; echo json_encode($errors); echo ' }';
			return;
		}
		echo '{ "event": ';
		echo Force::create([
			'event_id' => $_POST['event_id'],
			'title' => $_POST['title'],
			'subtitle' => $_POST['subtitle'],
			'type' => $_POST['type'],
			'latitude' => $_POST['latitude'],
			'longitude' => $_POST['longitude']
		]);
		echo '}';

	}

	public function forceById() {
		header('Content-Type: application/json');
		$id = $_GET['id'];
		$errors = [];
		if (!isset($id))
			$errors['id'] = "id is missing";
		if (!empty($errors)) {
			echo '{ "errors": '; echo json_encode($errors); echo ' }';
			return;
		}
		try {
			echo '{ "force": ' . Force::findOrFail($id)->toJson() . ' }';
		} catch (Illuminate\Database\Eloquent\ModelNotFoundException $exception) {
			$errors['event_id'] = "event_id not exist";
			echo '{ "errors": '; echo json_encode($errors); echo ' }';
		}
	}

	public function forcesList() {
		header('Content-Type: application/json');
		$event_id = $_GET['event_id'];
		$errors = [];
		if (!isset($event_id))
			$errors['event_id'] = "event_id is missing";
		if (!empty($errors)) {
			echo '{ "errors": '; echo json_encode($errors); echo ' }';
			return;
		}
		try {
			Event::findOrFail($event_id);
			echo '{ "forces": ' . Force::where('event_id', $event_id)->get()->toJson() . ' }';
		} catch (Illuminate\Database\Eloquent\ModelNotFoundException $exception) {
			$errors['event_id'] = "event_id not exist";
			echo '{ "errors": '; echo json_encode($errors); echo ' }';
		}
	}

	public function updateForce() {
		header('Content-Type: application/json');
		$errors = [];
		if (!isset($_POST['event_id']))
			$errors['event_id'] = "event_id is missing";
		if (!isset($_POST['force_id']))
			$errors['force_id'] = "force_id is missing";
		if (!empty($errors)) {
			echo '{ "errors": '; echo json_encode($errors); echo ' }';
			return;
		}
		try {
			$event_id = $_POST['event_id'];
			$force_id = $_POST['force_id'];
			Event::findOrFail($event_id);
			$force = Force::findOrFail($force_id);
			if (isset($_POST['title']))
				$force->update(['title' => $_POST['title']]);
			if (isset($_POST['subtitle']))
				$force->update(['subtitle' => $_POST['subtitle']]);
			if (isset($_POST['type']))
				$force->update(['type' => $_POST['type']]);
			if (isset($_POST['latitude']))
				$force->update(['latitude' => $_POST['latitude']]);
			if (isset($_POST['longitude']))
				$force->update(['longitude' => $_POST['longitude']]);
			echo '{ "force": '; print_r($force->toJson()); echo ' }';
		} catch (Illuminate\Database\Eloquent\ModelNotFoundException $exception) {
			switch ($exception->getModel()) {
				case "Event": $errors['event_id'] = "event_id not exist"; break;
				case "Force": $errors['force_id'] = "force_id not exist"; break;
			}
			echo '{ "errors": '; echo json_encode($errors); echo ' }';
		}
	}

	public function removeForce() {
		header('Content-Type: application/json');
		$errors = [];
		if (!isset($_POST['event_id']))
			$errors['event_id'] = "event_id is missing";
		if (!isset($_POST['force_id']))
			$errors['force_id'] = "force_id is missing";
		if (!empty($errors)) {
			echo '{ "errors": '; echo json_encode($errors); echo ' }';
			return;
		}
		try {
			$event_id = $_POST['event_id'];
			$force_id = $_POST['force_id'];
			Event::findOrFail($event_id);
			$force = Force::findOrFail($force_id);
			$force->update(['event_id' => null]);
			echo '{ "force": '; print_r($force->toJson()); echo ' }';
		} catch (Illuminate\Database\Eloquent\ModelNotFoundException $exception) {
			switch ($exception->getModel()) {
				case "Event": $errors['event_id'] = "event_id not exist"; break;
				case "Force": $errors['force_id'] = "force_id not exist"; break;
			}
			echo '{ "errors": '; echo json_encode($errors); echo ' }';
		}
	}
}