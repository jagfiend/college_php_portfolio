				<div id="content"> <!-- content div -->
					<div class="largeContent">
						<p><?php switch($_GET['goto'] /* switch statement to show which table has been updated */ ){
							case 'cmsUsersTable':
								echo 'Users';
							break;
							case 'cmsPostsTable':
								echo 'Posts';
							break;
							case 'cmsCommentsTable':
								echo 'Comment';
							break;
						}
						?> table updated successfully! You will be redirected back shortly...</p>
						<p>If youre not redirected, please click the link below:</p>
						<!-- link back to previous page -->
						<p><a href="?page=<?php echo $_GET['goto'] ?>">Back to Table</a></p>
					</div>
				</div> <!-- end of content div -->
				<script>
				setTimeout(function(){
					window.location.href='?page=<?php echo $_GET['goto'] ?>';
				}, 3000);
				</script>