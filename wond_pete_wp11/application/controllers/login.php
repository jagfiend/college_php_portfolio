<?php // controller for log in page
// if logging out, current session destroyed and redirected to login page...
if(isset($_GET['action']) && $_GET['action'] == 'logout'){ 
	session_destroy();
	header('Location: ?page=login');
}
// supporting data functions file...
include(DATA.'users.php');
// set error array key value pairs so that correct error messages displayed...
$error = array(
	'username' => '',
	'password' => ''
	);
// page logic...
if(!empty($_POST)){
	$form_valid = true;
	// sanitization...
	$_POST['username'] = trim($_POST['username']); 
	$_POST['password'] = trim($_POST['password']); 
	//validation
	if($_POST['username'] == ''){
		$error['username'] = 'Username is blank';
		$form_valid = false;
	}
	if($_POST['password'] == ''){
		$error['password'] = 'Password is blank';
		$form_valid = false;
	} elseif (strlen($_POST['password']) <= 7){
		$error['password'] = 'Password too short, please enter 8 or more characters';
		$form_valid = false;
	}
	// form filled in appropriately, run check against database...
	if($form_valid == true){
		// check username exists in the database...
		$user_exists = getUserByUsername($_POST['username']);
		
		if ($user_exists != true){ // if doesnt exist, error...
			$error['username'] = 'Username doesnt exist, try again';
		} else { // if does exist...
			// check password is correct for the username...
			$user = getUserByLogin($_POST['username'], md5($_POST['password']));
			if ($user != true) { // if password not correct for the username, error...
				$error['password'] = 'Password incorrect, try again';
			} elseif ($user == true) { // if password correct for the username, set session and redirect...
				$_SESSION['logged_in'] = true;
				$_SESSION['userId'] = $user['id']; 			
				$_SESSION['username'] = $user['username'];
				$_SESSION['role'] = $user['role'];
				header('Location: ?page=stream');
			}
		}	
	}
}
// views...
include(VIEWS.'header.php');
include(VIEWS.'contentLogIn.php');
include(VIEWS.'footer.php');
?>