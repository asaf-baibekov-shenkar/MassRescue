<?php

class EventController extends Controller {

	public function index() {
		$id = $_GET['id'];
		if (!isset($id)) {
			header('Location: ' . BASE_URL . 'events');
		}
		try {
			$this->view('event/index', [
			    'css' => CSS_PATH . 'event.css',
			    'js' => JS_PATH . 'event.js',
			    'event' => '{ "event": ' . Event::findOrFail($id)->toJson() . ' }',
				'forces' => '{ "forces": ' . Force::where('event_id', $id)->get()->toJson() . ' }'
			]);
		} catch (Illuminate\Database\Eloquent\ModelNotFoundException $exception) {
			header('Location: ' . BASE_URL . 'events');
		}
	}

	public function create() {
		header('Content-Type: application/json');
		$errors = [];
		if (empty($_POST['event_id']))
			$errors['event_id'] = "event_id is missing";
		if (empty($_POST['title']))
			$errors['title'] = "title is missing";
		if (empty($_POST['subtitle']))
			$errors['subtitle'] = "subtitle is missing";

		if (empty($_POST['type']))
			$errors['type'] = "type is missing";
		else if ($_POST['type'] != "firefighter" &&
				 $_POST['type'] != "medic" &&
				 $_POST['type'] != 'police' &&
				 $_POST['type'] != "drone" &&
				 $_POST['type'] != 'block')
			$errors['type'] = "type has to be firefighter, medic, police, drone or block";

		if (empty($_POST['latitude']))
			$errors['latitude'] = "latitude is missing";
		if (empty($_POST['longitude']))
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
		if (empty($id))
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
		if (empty($event_id))
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
		if (empty($_POST['event_id']))
			$errors['event_id'] = "event_id is missing";
		if (empty($_POST['force_id']))
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
			if (!empty($_POST['title']))
				$force->update(['title' => $_POST['title']]);
			if (!empty($_POST['subtitle']))
				$force->update(['subtitle' => $_POST['subtitle']]);
			if (!empty($_POST['type']))
				$force->update(['type' => $_POST['type']]);
			if (!empty($_POST['latitude']))
				$force->update(['latitude' => $_POST['latitude']]);
			if (!empty($_POST['longitude']))
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
		if (empty($_POST['event_id']))
			$errors['event_id'] = "event_id is missing";
		if (empty($_POST['force_id']))
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