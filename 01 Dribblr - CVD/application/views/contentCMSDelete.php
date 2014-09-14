<!DOCTYPE html> <!-- cms pages include header and footer html to prevent duplicate header errors -->
	<html>
		<head> <!-- head -->
			<meta charset="UTF-8">
			<title>Dribblr</title>
			<link rel="stylesheet" type="text/css" href="site/css/style.css">
		</head> <!-- end of head -->
		<body> <!-- body -->			
			<div id="content"> <!-- content div -->
				<!-- users are served contextual content depending on which table theyre updating -->
				<!-- theres is some duplicated code in the switch but I think this looks cleaner than moving the shared elements outside of the statement -->
				<?php switch ($_GET['page']){
					case 'cmsUsersTable': ?>
						<div class="blurb">CMS: Delete User</div>
						<div class="largeContent">
							<!-- link back to previous page -->
							<a href='?page=<?php echo $_GET['page']; ?>'>Back to Users table</a>
							<p>Delete: <?php echo $user['username']; ?></p>
							<form method='post' action=''>
							    <label>Are you sure you want to delete user '<?php echo $user['username']; ?>?</label>
							    <!-- markup for submit buttons, these send name and value to the $_POST variable to determine next action -->
							    <input type='submit' name='deleteConf' value='Yes' />
								<input type='submit' name='deleteConf' value='No' />
							</form>	
						</div>	
				<?php break;
					case 'cmsPostsTable': ?>
					<div class="blurb">CMS: Delete Post</div>
					<div class="largeContent">
						<!-- link back to previous page -->
						<a href='?page=<?php echo $_GET['page']; ?>'>Back to Posts table</a>
						<p>Delete: <?php echo $post['content']; ?></p>
						<form method='post' action=''>
						    <label>Are you sure you want to delete this post?</label>
						    <!-- markup for submit buttons, these send name and value to the $_POST variable to determine next action -->
						    <input type='submit' name='deleteConf' value='Yes' />
							<input type='submit' name='deleteConf' value='No' />
							</form>	
						</div>
				<?php break;
					case 'cmsCommentsTable': ?>
					<div class="blurb">CMS: Delete Comment</div>
					<div class="largeContent">
						<!-- link back to previous page -->
						<a href='?page=<?php echo $_GET['page']; ?>'>Back to Comments table</a>
						<p>Delete: <?php echo $comment['comment']; ?></p>
						<form method='post' action=''>
						    <label>Are you sure you want to delete this comment?</label>
						    <!-- markup for submit buttons, these send name and value to the $_POST variable to determine next action -->
						    <input type='submit' name='deleteConf' value='Yes' />
							<input type='submit' name='deleteConf' value='No' />
							</form>	
						</div>
				<?php break; }; ?> 
			</div> <!-- end of content div -->
		</body> <!-- end of body -->
	</html>