<?php // controller for 404 error page
// header info specific to 404 error...
header('HTTP/1.0 404 Not Found');
// views...
include(VIEWS.'header.php');
include(VIEWS.'404.php');
include(VIEWS.'footer.php'); 
?>