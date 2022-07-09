<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class Force extends Eloquent {
	protected $primaryKey = 'force_id';
	public $incrementing = true;
	protected $nullable = ['event_id'];
	public $force_id;
	public $event_id;
	public $title;
	public $subtitle;
	public $type;
	public $latitude;
	public $longitude;

	public $timestamps = true;
	protected $fillable = ['event_id', 'title', 'subtitle', 'type', 'latitude', 'longitude'];
}

?>