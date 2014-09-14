<?php

	// define a connection
	$conn = @mysql_connect('localhost','root','root');

	// error handling if no connection
	if (!$conn) {
		die('Could not connect: ' . mysql_error());
	}

	// make a connection
	mysql_select_db('db_620', $conn);

?>