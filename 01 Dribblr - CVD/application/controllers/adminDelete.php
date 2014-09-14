<?php // controller for admin delete page...
// must be logged in to view...
requireLogin();
// data supporting page...
include(DATA.'users.php');
// variable for page logic...
$id = $_GET['id'];
// page logic...
if (!empty($_POST)) {
	if ($_POST['deleteConf'] == 'Yes') {
		deleteUser($id);
		session_destroy();
		header('Location: ?page=deleteSuccess');
	} elseif ($_POST['deleteConf'] == 'No') {
		header('Location: ?page=admin');
	}
}
// variable...
$user = getUserById($id);
// views...
include(VIEWS.'header.php');
include(VIEWS.'contentAdminDelete.php');
include(VIEWS.'footer.php');
?>