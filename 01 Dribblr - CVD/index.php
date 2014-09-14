<?php // dribblr index.php
include('config/init.php'); // inclusion of initisation file to define directory path constants and store login functions...

// check if key field of page has been specified in the query string of the url...
if(isset($_GET['page']) == true){
	// if it has, use that value...
	$page = $_GET['page'];		
} else {
	// if not, use the following value as default...
	$page = 'home';
}

// variable and if statement check page requested in url is appropriate; if not "404 page not found" displayed....
$controllerPath = CONTROLLERS.$page.'.php';

if(file_exists($controllerPath)){
	// file exists...
	include($controllerPath);
} else {
	// file does not exist...
	include(CONTROLLERS.'404.php');
}

?>