<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class Force extends Eloquent {
	public $incrementing = true;
	public $force_id;
	public $title;
	public $subtitle;
	public $type;
	public $latitude;
	public $longitude;

	public $timestamps = true;
	protected $fillable = ['title', 'subtitle', 'type', 'latitude', 'longitude'];
}

?>