<?php // controller for CMS Users Tables
// checks user is admin..
probeAdmin();
// supporting data function file...
include(DATA.'users.php');
// set error array key value pairs so that correct error messages displayed...
$error = array(
	'email' => '',
	'username' => '',
	'password' => ''
	);
// page logic for different views...
if (isset($_GET['action'])){
	switch ($_GET['action']){
		case 'create':
			if(!empty($_POST)){
				$form_valid = true;
				// sanitization...
				$_POST['email'] = filter_var(
					trim($_POST['email']), // trim function removes white space from beginning and end of string...
					FILTER_SANITIZE_EMAIL // cleans e-mail field using in built php function
				);
				$_POST['username'] = trim($_POST['username']); 
				$_POST['password'] = trim($_POST['password']);
				//validation...
				if($_POST['email'] == ''){
					$error['email'] = 'Email address is blank, please fill in';
					$form_valid = false;
				} elseif (filter_var($_POST['email'],FILTER_VALIDATE_EMAIL) == false){ // validates email with built php function
					$error['email'] = 'Invalid email address, please try again';
					$form_valid = false;
				}
				if($_POST['username'] == ''){
					$error['username'] = 'Username is blank, please fill in';
					$form_valid = false;
				}
				if($_POST['password'] == ''){
					$error['password'] = 'Password is blank, please fill in';
					$form_valid = false;
				} elseif (strlen($_POST['password']) <= 7){
					$error['password'] = 'Password too short, please enter 8 or more characters';
					$form_valid = false;
				}
				// action taken if form filled in correctly...
				if($form_valid == true){
					createUser($_POST['email'], $_POST['username'], $_POST['password']);
					header('Location: ?page=cmsUpdated&goto=cmsUsersTable');
				}
			}
			include(VIEWS.'contentCMSCreate.php');
		break;
		case 'update':
			if(!empty($_POST)){
				$form_valid = true;
				// sanitization...
				$_POST['email'] = filter_var(
					trim($_POST['email']), // trim function removes white space from beginning and end of string...
					FILTER_SANITIZE_EMAIL // cleans e-mail field using in built php function
				);
				$_POST['username'] = trim($_POST['username']); 
				$_POST['password'] = trim($_POST['password']);
				//validation...
				if($_POST['email'] == ''){
					$error['email'] = 'Email address is blank, please fill in';
					$form_valid = false;
				} elseif (filter_var($_POST['email'],FILTER_VALIDATE_EMAIL) == false){ // validates email with built php function
					$error['email'] = 'Invalid email address, please try again';
					$form_valid = false;
				}
				if($_POST['username'] == ''){
					$error['username'] = 'Username is blank, please fill in';
					$form_valid = false;
				}
				// note: check for a blank password moved to form_valid = true section....
				if(strlen($_POST['password']) <= 7 && strlen($_POST['password']) != 0){
					$error['password'] = 'Password too short, please enter 8 or more characters';
					$form_valid = false;
				}
				// action taken if form filled in correctly...two options here to prevent writing blank passwords to the database
				if($form_valid == true && ($_POST['password'] != '')){ // if a password entered, full update function called
					updateUser($_GET['id'], $_POST['email'], $_POST['username'], $_POST['password'], $_POST['role']); // variables set for updateUser function to update values on db
					header('Location: ?page=cmsUpdated&goto=cmsUsersTable');
				} else { // if empty string in the password field then update function without password change called....
					updateUserNoPassword($_GET['id'], $_POST['email'], $_POST['username'], $_POST['role']);
					header('Location: ?page=cmsUpdated&goto=cmsUsersTable');
				}
			}
			$id = $_GET['id'];
			$user = getUserById($id);
			include(VIEWS.'contentCMSUpdate.php');
		break;
		case 'delete':
			$id = $_GET['id'];
			if (!empty($_POST)) {
				if ($_POST['deleteConf'] == 'Yes') {
					deleteUser($id);
					header('Location: ?page=cmsUpdated&goto=cmsUsersTable');
				} elseif ($_POST['deleteConf'] == 'No') {
					header('Location: ?page=cmsUsersTable');
				}
			}
			$user = getUserById($id);
			include(VIEWS.'contentCMSDelete.php');
		break;
	}
} else {
	$users = getAllUsers();
	include(VIEWS.'contentCMSUsersTable.php');
}
?>