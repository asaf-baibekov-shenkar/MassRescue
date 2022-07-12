<?php

class EventsController extends Controller {

	public function index() {
		$this->view('events/index', [
			'css' => CSS_PATH . 'events.css',
			'js' => JS_PATH . 'events.js',
			'events-cell-js' => JS_PATH . 'event_cell.js',
			'consts-js' => JS_PATH . 'consts.js'
		]);
	}

	public function create() {
		header('Content-Type: application/json');
		$errors = [];
		if (!isset($_POST['title']))
			$errors['title'] = "title is missing";
		if (!isset($_POST['subtitle']))
			$errors['subtitle'] = "subtitle is missing";
		if (!isset($_POST['type']))
			$errors['type'] = "type is missing";
		else if ($_POST['type'] != "fire" && $_POST['type'] != "earthquake" && $_POST['type'] != 'unknown')
			$errors['type'] = "type has to be fire or earthquake or unknown";
		if (!isset($_POST['latitude']))
			$errors['latitude'] = "latitude is missing";
		if (!isset($_POST['longitude']))
			$errors['longitude'] = "longitude is missing";
		if (!empty($errors)) {
			echo '{ "errors": '; echo json_encode($errors); echo ' }';
			return;
		}
		echo '{ "event": ';
		echo Event::create([
			'title' => $_POST['title'],
			'subtitle' => $_POST['subtitle'],
			'type' => $_POST['type'],
			'latitude' => $_POST['latitude'],
			'longitude' => $_POST['longitude']
		]);
		echo '}';
	}

	public function eventById() {
		header('Content-Type: application/json');
		$errors = [];
		if (!isset($_GET['id']))
			$errors['id'] = "id is missing";
		if (!empty($errors)) {
			echo '{ "errors": '; echo json_encode($errors); echo ' }';
			return;
		}
		try {
			$event = Event::findOrFail($_GET['id']);
			echo '{ "event": '; print_r($event->toJson()); echo ' }';
		} catch (Illuminate\Database\Eloquent\ModelNotFoundException $exception) {
			$errors['id'] = "id not exist";
			echo '{ "errors": '; echo json_encode($errors); echo ' }';
		}
	}

	public function eventsList() {
		header('Content-Type: application/json');
		echo '{ "events": ' . Event::all()->toJson() . ' }';
	}

	public function update() {
		header('Content-Type: application/json');
		$errors = [];
		if (!isset($_POST['id']))
			$errors['id'] = "id is missing";
		if (!empty($errors)) {
			echo '{ "errors": '; echo json_encode($errors); echo ' }';
			return;
		}
		try {
			$event = Event::findOrFail($_POST['id']);
			if (isset($_POST['title']))
				$event->update(['title' => $_POST['title']]);
			if (isset($_POST['subtitle']))
				$event->update(['subtitle' => $_POST['subtitle']]);
			if (isset($_POST['type']))
				$event->update(['type' => $_POST['type']]);
			if (isset($_POST['latitude']))
				$event->update(['latitude' => $_POST['latitude']]);
			if (isset($_POST['longitude']))
				$event->update(['longitude' => $_POST['longitude']]);
			echo '{ "event": '; print_r($event->toJson()); echo ' }';
		} catch (Illuminate\Database\Eloquent\ModelNotFoundException $exception) {
			$errors['id'] = "id not exist";
			echo '{ "errors": '; echo json_encode($errors); echo ' }';
		}
	}

	public function remove() {
		header('Content-Type: application/json');
		$errors = [];
		if (!isset($_POST['id']))
			$errors['id'] = "id is missing";
		if (!empty($errors)) {
			echo '{ "errors": '; echo json_encode($errors); echo ' }';
			return;
		}
		try {
			$event = Event::findOrFail($_POST['id']);
			echo '{ "event": '; print_r($event->toJson()); echo ' }';
			$event->delete();
		} catch (Illuminate\Database\Eloquent\ModelNotFoundException $exception) {
			$errors['id'] = "id not exist";
			echo '{ "errors": '; echo json_encode($errors); echo ' }';
		}
	}
}

?>