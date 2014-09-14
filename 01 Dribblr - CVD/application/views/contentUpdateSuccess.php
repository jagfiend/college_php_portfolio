				<div id="content"> <!-- view for success change to user details, redirects to the stream page as long as js switched on -->
					<div class="largeContent">
						<p>Your details have been updated successfully! You will be redirected shortly...</p>
						<p>If youre not redirected, please click the link below:</p>
						<!-- link to stream page in case js turned off -->
						<p><a href="?page=stream">Back to Stream</a></p>
					</div>
				</div> <!-- end of content div -->
				<script>
				setTimeout(function(){
					window.location.href='?page=stream';
				}, 3000);
				</script>