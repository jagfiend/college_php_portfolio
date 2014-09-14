<!DOCTYPE html> <!-- cms pages include header and footer html to prevent duplicate header errors -->
	<html> 
		<head> <!-- head -->
			<meta charset="UTF-8">
			<title>Dribblr</title>
			<link rel="stylesheet" type="text/css" href="site/css/style.css">
			<?php if($_GET['page'] == 'cmsPostsTable' || $_GET['page'] == 'cmsCommentsTable') : ?>
				<script src="site/ckeditor/ckeditor.js"></script>
			<?php endif; ?>
		</head> <!-- end of head -->
		<body> <!-- body -->
			<div id="content"> <!-- content div -->
				<!-- users are served contextual content with the switch below depending on which table theyre updating -->
				<!-- theres is some duplicated code in the different cases but I think this looks cleaner than moving the shared elements outside of the statement -->
				<?php switch ($_GET['page']){
					case 'cmsUsersTable': ?>
						<div class="blurb">CMS: Create User</div>
						<form method="post" action="?page=cmsUsersTable&action=create" class="formDesign">
							<!-- markup for email input field, value attribute set from error check if required -->
							<label name="email">Email:</label>
							<input name="email" type="text" value="<?php formLastValue('email'); ?>"/>
							<div class="errorText"><?php echo $error["email"]; ?></div>
							<!-- markup for username input field, value attribute set from error check if required -->
							<label name="username">Username:</label>
							<input name="username" type="text" value="<?php formLastValue("username"); ?>"/>
							<div class="errorText"><?php echo $error["username"]; ?></div>
							<!-- markup for password input field, value attribute set from error check if required -->
							<label name="password">Password:</label>
							<input name="password" type="password" value="<?php formLastValue("password"); ?>"/>
							<div class="errorText"><?php echo $error["password"]; ?></div>
							<!-- mark up for form submission button -->
							<button class="submitButton" type="submit">Create User</button>
						</form>
						<div class="blurb">
							<!-- link to return to previous page -->
							<a href="?page=cmsUsersTable">Back to Users table</a>
						</div>
				<?php break;
					case 'cmsPostsTable': ?>
						<div class="blurb">CMS: Create Post</div>
						<form id="editor" class="largeContent" method="post" action="">
							<!-- markup for title input field, value attribute set from error check if required -->
							<label name="tile">Post Title (max 25 characters):</label>
							<input name="title" type="text" value='<?php formLastValue('title'); ?>' class="longInput"/>
							<div class="errorText"><?php echo $error['title']; ?></div>
							<!-- markup for post content input field, value attribute set from error check if required -->
							<textarea name="editor1"><?php formLastValue('editor1'); ?></textarea>
	    					<script>CKEDITOR.replace('editor1',{toolbar:'Basic',uiColor:'#888888'});</script>
							<div class="errorText"><?php echo $error['editor1']; ?></div>
							<!-- markup for category radio buttons -->
							<label name="category">Select a category:</label>
							<span>html</span>
							<input class="radio" type="radio" name="category" value="html" checked/>
							<span>CSS</span>
							<input class="radio" type="radio" name="category" value="CSS"/>	
							<span>Javascript</span>
							<input class="radio" type="radio" name="category" value="javascript"/>
							<!-- mark up for form submission button -->
							<button class="submitButton" type="submit">Publish Post</button>
	   					</form>
						<div class="largeContent">
							<!-- link to return to previous page -->
							<a href="?page=cmsPostsTable">Back to Posts table</a>
						</div>
				<?php break;
					case 'cmsCommentsTable': ?>
						<div class="blurb">CMS: Create Comment</div>
						<form id="editor" class="largeContent" method="post" action="">
							<!-- markup for post id drop down list, note use of foreach to create list -->
							<label>Select the post to link the comment to: </label>
							<select name="postId">
								<?php foreach($postIds as $postId) : ?>
									<option><?php echo $postId['id'] ?></option>
								<?php endforeach ?>
							</select>
							<!-- markup for comment content input field, value attribute set from error check if required -->
							<textarea name="editor1"><?php formLastValue('editor1'); ?></textarea>
	    					<script>CKEDITOR.replace('editor1',{toolbar:'Basic',uiColor:'#888888'});</script>
							<div class="errorText"><?php echo $error['editor1']; ?></div>
							<!-- mark up for form submission button -->
							<button class="submitButton" type="submit">Comment!!!</button>
	   					</form>
						<div class="largeContent">
							<!-- link to return to previous page -->
							<a href="?page=cmsCommentsTable">Back to Comments table</a>
						</div>
				<?php break; }; ?>
			</div> <!-- end of content div -->
		</body> <!-- end of body -->
	</html>