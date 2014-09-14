<?php

	$result = array();

	include 'connection.php';
	
	$rs = mysql_query("select count(*) from users");
	$row = mysql_fetch_row($rs);
	$rs = mysql_query("select * from users");
	
	$items = array();
	
	while($row = mysql_fetch_object($rs)){
		array_push($items, $row);
	}

	$result = $items;

	echo json_encode($result);

?>