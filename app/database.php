<?php

use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule();
$capsule->addConnection([
	'driver' => 'mysql',
	'host' => '148.66.138.145',
	'username' => 'dbusrShnkr22',
	'password' => 'studDBpwWeb1!',
	'database' => 'dbShnkr22studWeb1',
	'charset' => 'utf8',
	'collation' => 'utf8_unicode_ci',
	'prefix' => 'tbl_massrescue_'
]);
$capsule->bootEloquent();