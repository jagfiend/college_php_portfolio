<?php // controller for CMS Updated page
// checks user is admin..
probeAdmin();
// views...
include(VIEWS.'header.php');
include(VIEWS.'contentCMSUpdated.php');
include(VIEWS.'footer.php');
?>