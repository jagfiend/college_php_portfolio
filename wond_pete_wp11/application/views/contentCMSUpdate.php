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
				<!-- theres some duplicated code in the switch but I think this looks cleaner than moving the shared elements outside of the statement -->
				<?php switch ($_GET['page']){
					case 'cmsUsersTable': ?>
						<div class="blurb">CMS: Update User</div>
						<form method="post" action="" class="formDesign">
							<p>Member since <?php echo $user['created_at']; ?></p>
							<!-- markup for email input field, value attribute set from error check if required -->
							<label name="email">Email:</label>
							<input name="email" type="text" value="<?php echo $user['email']; ?>"/>
							<div class="errorText"><?php echo $error['email']; ?></div>
							<!-- markup for username input field, value attribute set from error check if required -->
							<label name="username">Username:</label>
							<input name="username" type="text" value="<?php echo $user['username']; ?>"/>
							<div class="errorText"><?php echo $error['username']; ?></div>
							<!-- markup for password input field, value attribute as dont want to reset users password on every update -->
							<label name="password">Password:</label>
							<input name="password" type="password"/>
							<div class="errorText"><?php echo $error['password']; ?></div>
							<!-- mark up for role drop down list, note condition statement to set default value to current value -->
							<label name="password">Role:</label>
							<select name="role">
								<?php if($user['role'] == 'admin') : ?>
									<option value='admin' selected>admin</option>
									<option value='user'>user</option>
								<?php else : ?>
									<option value='admin'>admin</option>
									<option value='user' selected>user</option>
								<?php endif; ?>
							</select>
							<!-- mark up for form submission button -->
							<button class="submitButton" type="submit">Update</button>
						</form>
						<div class="blurb">
							<!-- link to return to previous page -->
							<a href="?page=cmsUsersTable">Back to Users table</a>
						</div>
				<?php break;
					case 'cmsPostsTable': ?>
						<div class="blurb">CMS: Update Post</div>
						<form id="editor" class="largeContent" method="post" action="">
							<p>Post created at <?php echo $post['created_at'] ?> by <?php echo $post['username'] ?></p>
							<!-- markup for title input field, value attribute set from error check if required -->
							<label name="tile">Post Title (max 25 characters):</label>
							<input name="title" type="text" value='<?php echo $post['title']; ?>' class="longInput"/>
							<div class="errorText"><?php echo $error['title']; ?></div>
							<!-- markup for post content input field, value attribute set from error check if required -->							
							<textarea name="editor1"><?php echo $post['content'];; ?></textarea>
	    					<script>CKEDITOR.replace('editor1',{toolbar:'Basic',uiColor:'#888888'});</script>
							<div class="errorText"><?php echo $error['editor1']; ?></div>
							<!-- markup for category radio buttons, swith case used to shown current "checked" value -->
							<label name="category">Select a category:</label>
							<?php switch($post['category']){ case 'html': ?>
								<span>html</span>
								<input class="radio" type="radio" name="category" value="html" checked/>
								<span>CSS</span>
								<input class="radio" type="radio" name="category" value="CSS"/>	
								<span>Javascript</span>
								<input class="radio" type="radio" name="category" value="javascript"/>
							<?php break; case 'CSS' ?>
								<span>html</span>
								<input class="radio" type="radio" name="category" value="html"/>
								<span>CSS</span>
								<input class="radio" type="radio" name="category" value="CSS" checked/>	
								<span>Javascript</span>
								<input class="radio" type="radio" name="category" value="javascript"/>
							<?php break; case 'javascript' ?>
								<span>html</span>
								<input class="radio" type="radio" name="category" value="html"/>
								<span>CSS</span>
								<input class="radio" type="radio" name="category" value="CSS"/>	
								<span>Javascript</span>
								<input class="radio" type="radio" name="category" value="javascript" checked/>
							<?php break; }; ?>
 							<!-- mark up for form submission button -->
							<button class="submitButton" type="submit">Update Post</button>
	   					</form>
						<div class="largeContent">
							<!-- link to return to previous page -->
							<a href="?page=cmsPostsTable">Back to Posts table</a>
						</div>
				<?php break;
					case 'cmsCommentsTable': ?>
						<div class="blurb">CMS: Update Comment</div>
						<p class="largeContent">Comment currently linked to post id <?php echo $comment['postId']; ?>, 
							entitled "<?php echo $comment['title']; ?>" by <?php echo $comment['username']; ?></p>
						<form id="editor" class="largeContent" method="post" action="">
							<!-- markup for post id drop down list, note use of foreach to create list -->
							<label>Select the post to link the comment to: </label>
							<select name="postId">
								<?php foreach($postIds as $postId) : ?>
									<?php if($postId['id'] == $comment['postId']) : ?>
										<option selected><?php echo $postId['id'] ?></option>
									<?php else : ?>
										<option><?php echo $postId['id'] ?></option>
									<?php endif; ?>
								<?php endforeach ?>
							</select>
							<!-- markup for comment content input field, value attribute set from error check if required -->							
							<textarea name="editor1"><?php echo $comment['comment']; ?></textarea>
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
			</div> <!-- theres is some duplicated code in the switch but I think this looks cleaner than moving the shared elements outside of the statement -->
		</body> <!-- end of body -->
	</html>