<?php // controller for admin page
requireLogin();
include(DATA.'users.php');
// set error array key value pairs so that correct error messages displayed...
$error = array(
	'email' => '',
	'username' => '',
	'password' => ''
	);
// page logic...
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
		$error['password'] = 'Please enter your password to confirm changes';
		$form_valid = false;
	} elseif (strlen($_POST['password']) <= 7){
		$error['password'] = 'Password too short, please enter 8 or more characters';
		$form_valid = false;
	}
	// action taken if form filled in correctly...
	if($form_valid == true){
		$username = $_SESSION['username'];
		$user = getUserByUsername($username);
		updateUser($user['id'], $_POST['email'], $_POST['username'], $_POST['password'], $user['role']); // variables set to create_user function for insertion on db
		header('Location: ?page=UpdateSuccess');
	}
}
// variables...
$username = $_SESSION['username'];
$user = getUserByUsername($username);
// views...
include(VIEWS.'header.php');
include(VIEWS.'contentAdmin.php');
include(VIEWS.'footer.php');
?>