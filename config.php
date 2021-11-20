<?php
// Database details for connecting to mysql

define('DB_SERVER','localhost');
define('DB_USERNAME','root');
define('DB_PASSWORD', '');
define('DB_NAME', 'games');

// try to connect to database

$con= mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// check if connection is ok, or else display an error message

if($con === false) { die("Error Cannot connect" . msqli_connect_Error()); }



?>