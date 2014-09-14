<?php // controller for sign up page
// supporting data functions files...
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
		FILTER_SANITIZE_EMAIL // cleans e-mail field using built in php function
	);
	$_POST['username'] = trim($_POST['username']); 
	$_POST['password'] = trim($_POST['password']);
	
	//validation...
	if($_POST['email'] == ''){
		$error['email'] = 'Email address is blank, please fill in';
		$form_valid = false;
	} elseif (filter_var($_POST['email'],FILTER_VALIDATE_EMAIL) == false){ // validates email with built in php function
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
		
		$email_exists = emailDuplicateCheck($_POST['email']); // function checks if email already on database to prevent duplicates...
		$username_exists = usernameDuplicateCheck($_POST['username']); // as above for username...
		// logic to determine error display to prevent duplicates...
		if($email_exists == true){
			$error['email'] = 'This email already has an account, try again!';
		} 
		if($username_exists == true){
			$error['username'] = 'This username is already in use, try again!';
		}
		// if no duplicates found, run sign up function and redirect....
		if($email_exists != true && $username_exists != true){
			createUser($_POST['email'], $_POST['username'], $_POST['password']);
			header('Location: ?page=login');
		}
	}
}
// views....
include(VIEWS.'header.php');
include(VIEWS.'contentSignUp.php');
include(VIEWS.'footer.php');
?>