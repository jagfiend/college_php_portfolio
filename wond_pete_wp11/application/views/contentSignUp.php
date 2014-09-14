				<div id="content"> <!-- content div -->
					<div class="blurb">Provide your sign up details below:</div>
					<form class="formDesign" method="post" action="">
						<!-- markup for email input field, value attribute set from error check if required -->
						
						<label name="email">Email:</label>
						
						<input name="email" type="text" value='<?php formLastValue('email'); ?>'/>
						
						<div class="errorText"><?php echo $error['email']; ?></div>
						
						<!-- markup for username input field, value attribute set from error check if required -->
						<label name="username">Username:</label>
						<input name="username" type="text" value='<?php formLastValue('username'); ?>'/>
						<div class="errorText"><?php echo $error['username']; ?></div>
						<!-- markup for password input field, value attribute set from error check if required -->
						<label name="password">Password:</label>
						<input name="password" type="password" value='<?php formLastValue('password'); ?>'/>
						<div class="errorText"><?php echo $error['password']; ?></div>
						<!-- mark up for form submission button -->		
						<button class="submitButton" type="submit">Sign Me Up!</button>
						<!-- link to support page -->
						<a href="?page=support">I need helping signing up!</a>
					</form>
				</div> <!-- end of content div -->