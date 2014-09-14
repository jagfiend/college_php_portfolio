<?php // controller for CMS Comments Tables
// checks user is admin...
probeAdmin();
// supporting data function file...
include(DATA.'comments.php');
// set error array key value pairs so that correct error messages displayed...
$error = array(
	'editor1' => ''
	);
// page logic for different views...
if (isset($_GET['action'])){
	switch ($_GET['action']){
		case 'create':
			if(!empty($_POST)){
				$form_valid = true;
				// sanitization...
				$_POST['editor1'] = trim($_POST['editor1']);
				//validation...
				if($_POST['editor1'] == ''){
					$error['editor1'] = 'You have not entered any content! Try again yeh...?';
					$form_valid = false;
				}
				// action taken if form filled in correctly...
				if($form_valid == true){
					createComment($_SESSION['userId'],$_POST['postId'], $_POST['editor1']); // variables set to createPost function for insertion into db...
					header('Location: ?page=cmsUpdated&goto=cmsCommentsTable');
				}
			}
			$postIds = getAllPostIds();
			include(VIEWS.'contentCMSCreate.php');
		break;
		case 'update':
			if(!empty($_POST)){
				$form_valid = true;
				// sanitization...
				$_POST['editor1'] = trim($_POST['editor1']);
				//validation...
				if($_POST['editor1'] == ''){
					$error['editor1'] = 'You have not entered any content! Try again yeh...?';
					$form_valid = false;
				}
				// action taken if form filled in correctly...
				if($form_valid == true){
					updateComment($_GET['id'], $_SESSION['userId'], $_POST['postId'], $_POST['editor1']); // variables set for updateComment function to update values on db
					header('Location: ?page=cmsUpdated&goto=cmsCommentsTable');
				}
			}
			$id = $_GET['id'];
			$comment = getCommentById($id);
			$postIds = getAllPostIds();
			include(VIEWS.'contentCMSUpdate.php');
		break;
		case 'delete':
			$id = $_GET['id'];
			if (!empty($_POST)) {
				if ($_POST['deleteConf'] == 'Yes') {
					deleteComment($id);
					header('Location: ?page=cmsUpdated&goto=cmsCommentsTable');
				} elseif ($_POST['deleteConf'] == 'No') {
					header('Location: ?page=cmsCommentsTable');
				}
			}
			$comment = getCommentById($id);
			include(VIEWS.'contentCMSDelete.php');
		break;
	}
} else {
	$comments = getAllCommentsCMS();
	include(VIEWS.'contentCMSCommentsTable.php');
}
?>