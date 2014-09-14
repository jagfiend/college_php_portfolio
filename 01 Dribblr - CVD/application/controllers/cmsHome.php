<?php // controller for CMS homepage
// checks user is admin...
probeAdmin();
// views...
include(VIEWS.'header.php');
include(VIEWS.'contentCMSHome.php');
include(VIEWS.'footer.php');
?>