<?php // controller for CMS Posts Tables
// checks user is admin...
probeAdmin();
// supporting data function file..
include(DATA.'posts.php');
// set error array key value pairs so that correct error messages displayed...
$error = array(
	'title' => '',
	'editor1' => ''
	);
// page logic for different views...
if (isset($_GET['action'])){
	switch ($_GET['action']){
		case 'create':
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
					header('Location: ?page=cmsUpdated&goto=cmsPostsTable');
				}
			}
			include(VIEWS.'contentCMSCreate.php');
		break;
		case 'update':
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
					updatePost($_GET['id'], $_SESSION['userId'],$_POST['title'], $_POST['editor1'], $_POST['category']); // variables set to createPost function for insertion into db...
					header('Location: ?page=cmsUpdated&goto=cmsPostsTable');
				}
			}
			$id = $_GET['id'];
			$post = getPostById($id);
			include(VIEWS.'contentCMSUpdate.php');
		break;
		case 'delete':
			$id = $_GET['id'];
			if (!empty($_POST)) {
				if ($_POST['deleteConf'] == 'Yes') {
					deletePost($id);
					header('Location: ?page=cmsUpdated&goto=cmsPostsTable');
				} elseif ($_POST['deleteConf'] == 'No') {
					header('Location: ?page=cmsPostsTable');
				}
			}
			$post = getPostById($id);
			include(VIEWS.'contentCMSDelete.php');
		break;
	}
} else {
	$posts = getAllPostsCMS();
	include(VIEWS.'contentCMSPostsTable.php');
}
?>