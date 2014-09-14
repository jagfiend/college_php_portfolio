				<div id="content"> <!-- content div -->
					
					<div class="blurb">Please log in below:</div>
					
					<form class="formDesign" method="post" action="">
						<!-- markup for username input field, value attribute set from error check if required -->
						<label>Username:</label>
						<input name="username" type="text" value='<?php formLastValue('username'); ?>'/>
						<div class="errorText"><?php echo $error['username']; ?></div>
						<!-- markup for password input field, value attribute set from error check if required -->
						<label>Password:</label>
						<input name="password" type="password" value='<?php formLastValue('password'); ?>'/>
						<div class="errorText"><?php echo $error['password']; ?></div>
						<!-- mark up for form submission button -->
						<button class="submitButton" type="submit">Log Me In!</button>
						<!-- link to support page -->
						<a href="?page=support">I need helping logging in!</a>
					</form>
				
				</div> <!-- end of content div -->