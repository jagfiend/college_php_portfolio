<?php

	$id = intval($_REQUEST['id']);
	$username = $_REQUEST['username'];
	$email = $_REQUEST['email'];
	$password = $_REQUEST['password'];

	include 'connection.php';

	$sql = "update users set username='$username',email='$email',password='$password',modifiedAt=NOW() where id=$id";
	$result = @mysql_query($sql);

	// error handling
	if ($result){
		echo json_encode(array('success'=>true));
	} else {
		echo json_encode(array('msg'=>'Some errors occured.'));
	}
?>