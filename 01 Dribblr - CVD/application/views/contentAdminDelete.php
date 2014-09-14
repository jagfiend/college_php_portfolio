				<div id="content"> <!-- content div -->
					<!-- markup for account deletion confirmation -->
					<div class="blurb">Confirm Account Deletion</div>
					<div class="largeContent">
						<!-- markup username value from getUserById function -->
						<p>Delete: <?php echo $user['username']; ?></p>
						<form method='post' action=''>
						    <p>Are you sure you want to your account?</p>
						    <!-- markup for submit buttons, these send name and value to the $_POST variable to determine next action -->
						    <input type='submit' name='deleteConf' value='Yes' />
							<input type='submit' name='deleteConf' value='No' />
						</form>	
					</div>
				</div>	<!-- end of content div -->