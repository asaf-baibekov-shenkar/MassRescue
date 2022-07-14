<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class User extends Eloquent {
	protected $primaryKey = 'user_id';
	public $incrementing = true;
	protected $nullable = ['session_id'];
	public $user_id;
	public $session_id;
	public $id_number;
	public $first_name;
	public $last_name;
	public $password;
	public $role;

	public $timestamps = true;
	protected $fillable = ['session_id', 'id_number', 'first_name', 'last_name', 'password'];
	protected $hidden = ['session_id', 'password'];
}

?>