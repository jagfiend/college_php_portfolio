<?php 
// defining constants for directory paths...
define('DATA','application/data/');
define('CONTROLLERS','application/controllers/');
define('VIEWS','application/views/');
define('CONFIG','config/');
// session started so $_SESSION active..
session_start();
// includes call server & database connections and set global functions...
include(CONFIG.'db.php');
include(CONFIG.'functions.php');
?>