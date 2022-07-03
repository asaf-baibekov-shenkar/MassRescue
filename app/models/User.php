<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class User extends Eloquent {
	public $incrementing = true;
	public $user_id;
	public $id_number;
	public $first_name;
	public $last_name;
	public $password;

	public $timestamps = true;
	protected $fillable = ['id_number', 'first_name', 'last_name', 'password'];
}

?>