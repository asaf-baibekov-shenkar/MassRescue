<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class Event extends Eloquent {
	protected $primaryKey = 'event_id';
	public $incrementing = true;
	public $title;
	public $subtitle;
	public $type;
	public $latitude;
	public $longitude;

	public $timestamps = true;
	protected $fillable = ['title', 'subtitle', 'type', 'latitude', 'longitude'];
}

?>