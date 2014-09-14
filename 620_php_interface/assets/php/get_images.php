<?php

	$result = array();

	include 'connection.php';
	
	$rs = mysql_query("select * from interface");
	
	$items = array();
	
	while($row = mysql_fetch_object($rs)){
		array_push($items, $row);
	}

	$result["images"] = $items;

	/* Definitely send as JSON object */
    header("Content-Type: application/json", true);

	echo json_encode($result);

?>