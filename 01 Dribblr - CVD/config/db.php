<?php // db.php to connect to server & database...
// database variables...
$db_host = 'localhost';
$db_user = 'root';
$db_pass = 'root';
$db_name = 'db_wp11';
// connect to the server...
$connection = mysql_connect($db_host,$db_user,$db_pass);
// if server connection failure, user is given error number and message...
if(!$connection){
	echo 'Quick, tell the nearest professional: <br>'.mysql_errno().': '.mysql_error().'<br>';
	exit;
}
// connect to the database...
$db = mysql_select_db($db_name);
// if database connection failure...
if(!$db){
	echo 'Quick, tell the nearest professional: <br>'.mysql_errno().': '.mysql_error().'<br>';
} 
?>