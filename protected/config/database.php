<?php

// This is the database connection configuration.
return array(
	//'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
	// uncomment the following lines to use a MySQL database

	'connectionString' => 'mysql:host=172.19.51.222;dbname=test',
	'emulatePrepare' => true,
	'username' => 'test',
	'password' => 'test',
	'charset' => 'utf8',

	/*'connectionString' => 'mysql:host=localhost;dbname=guoguang_johnnydesign',
	'emulatePrepare' => true,
	'username' => 'guoguang_johnny',
	'password' => 'max112345',
	'charset' => 'utf8',*/

);

