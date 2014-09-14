				<div id="content"> <!-- content div -->
					<div class="blurb">Update your details below:</div>
					<form class="formDesign" method="post" action="">
						<!-- markup for email input field, value attribute set from database -->
						<label name="email">Email:</label>
						<input name="email" type="text" value="<?php echo $user['email']; ?>"/>
						<div class="errorText"><?php echo $error['email']; ?></div>
						<!-- markup for username input field, value attribute set from database -->
						<label name="username">Username:</label>
						<input name="username" type="text" value="<?php echo $user['username']; ?>"/>
						<div class="errorText"><?php echo $error['username']; ?></div>
						<!-- markup for password input field, value attribute set from database -->
						<label name="password">Password:</label>
						<input name="password" type="password"/>
						<!-- no password value as this would be the md5 version, user must enter their password to confirm changes, preventing them making updates in error -->
						<div class="errorText"><?php echo $error['password']; ?></div>
						<!-- form submission button -->
						<button class="submitButton" type="submit">Update</button>
						<!-- user can delete their own account with the following button -->
						<a class="deleteButton" href='?page=adminDelete&action=delete&id=<?php echo $user['id']; ?>'>Delete Me</a>
						<!-- link out to support page -->
						<a href="?page=support">I need admin advice!</a>
					</form>
				</div> <!-- end of content div -->