<?php // controller for admin update success 
// checks user is logged in...
requireLogin();
// views...
include(VIEWS.'header.php');
include(VIEWS.'contentUpdateSuccess.php');
include(VIEWS.'footer.php');
?>