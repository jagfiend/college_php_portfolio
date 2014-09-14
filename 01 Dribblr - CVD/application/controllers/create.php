<?php // controller for create post page
// checks user is logged in..
requireLogin();
// supporting data functions file..
include(DATA.'posts.php');
// set error array key value pairs so that correct error messages displayed...
$error = array(
	'title' => '',
	'editor1' => ''
	);
// page logic...
if(!empty($_POST)){
	$form_valid = true;
	// sanitization...
	$_POST['title'] = trim($_POST['title']);
	$_POST['editor1'] = trim($_POST['editor1']);
	//validation
	if($_POST['title'] == ''){
		$error['title'] = 'Title is blank, please add one';
		$form_valid = false;
	} elseif(strlen($_POST['title']) > 25){
		$error['title'] = 'Title too long, keep it simple!';
		$form_valid = false;
	}
	if($_POST['editor1'] == ''){
		$error['editor1'] = 'You have not entered any content! Try again yeh...?';
		$form_valid = false;
	}
	// action taken if form filled in correctly...
	if($form_valid == true){
		createPost($_SESSION['userId'],$_POST['title'], $_POST['editor1'], $_POST['category']); // variables set to createPost function for insertion into db...
		header('Location: ?page=postSuccess');
	}
}
// views...
include(VIEWS.'header.php');
include(VIEWS.'contentCreate.php');
include(VIEWS.'footer.php');
?>