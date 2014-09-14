<?php // controller for individual post display page...
include(DATA.'posts.php');
include(DATA.'comments.php');
// set error array key value pairs so that correct error messages displayed...
$error = array(
	'editor1' => ''
	);

$postId = $_GET['id'];
$post = getPostById($postId);
$comments = getAllPostComments($postId);

if(!empty($_POST)){
	$form_valid = true;
	// sanitization...
	$_POST['editor1'] = trim($_POST['editor1']);
	//validation
	if($_POST['editor1'] == ''){
		$error['editor1'] = 'You have not entered any content! Try again yeh...?';
		$form_valid = false;
	}
	// action taken if form filled in correctly...
	if($form_valid == true){
		createComment($post['userId'], $_GET['id'], $_POST['editor1']); // variables sent to createComment function for insertion into db...
		header('Location: ?page=postDisplay&id='.$_GET['id']); // reloads the page with new comment...
	}
}

include(VIEWS.'header.php');
include(VIEWS.'contentPostDisplay.php');
include(VIEWS.'footer.php');
?>