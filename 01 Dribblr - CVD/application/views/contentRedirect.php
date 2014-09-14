				<div id="content"> <!-- view for success change to user details, redirects to the log in page as long as js switched on -->
					<div class="largeContent">
						<p>You cannot view this page without being logged in, you will be redirected to the log in screen shortly...</p>
						<p>If youre not redirected, please click the link below:</p>
						<!-- link to stream page in case js turned off -->
						<p><a href="?page=login>">Let me log in...</a></p>
					</div>
				</div> <!-- end of content div -->
				<script>
				setTimeout(function() {
					window.location.href='?page=login';
				}, 5000);
				</script>