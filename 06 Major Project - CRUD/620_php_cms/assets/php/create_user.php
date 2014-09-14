<?php

	$username = $_REQUEST['username'];
	$email = $_REQUEST['email'];
	$password = $_REQUEST['password'];

	include 'connection.php';

	$sql = "insert into users(username,email,password,createdAt, modifiedAt) values('$username','$email','$password', NOW(), NOW())";
	
	$result = @mysql_query($sql);
	if ($result){
		echo json_encode(array('success'=>true));
	} else {
		echo json_encode(array('msg'=>'Some errors occured.'));
	}

?>