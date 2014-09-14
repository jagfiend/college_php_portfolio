				<div id="content"> <!-- content div -->
					<?php if(loggedIn()) : ?>
						<!-- theres is some duplicated code in the different conditions but I think this looks cleaner 
						than having duplicated conditional statements throughout the page -->
						<!-- mark up for logged in user -->
						<div class="largeContent">
							<?php if($post['username'] == $_SESSION['username']) : ?>
								<!-- markup for full display of chosen post -->
								<h2><?php echo $post['title']; ?></h2>
								<p><?php echo $post['content']; ?></p>
								<!-- link to stream page -->
								<a href="?page=stream">Back to Stream</a>
							<?php else : ?>
								<!-- markup for full display of chosen post -->
								<h2><?php echo $post['title']; ?></h2>
								<p><?php echo $post['content']; ?></p>
								 <!-- link to display of more posts by the searched for user -->
		                    	<a href="?page=search&usernameSearch=<?php echo $post['username']; ?>">View more posts by <?php echo $post['username']; ?></a>
		                    <?php endif; ?>
						</div>
						<!-- mark up for comments section -->
						<div>
							<form id="editor" class="indexLargeThumb" method="post" action="">
								<h2>Add a comment below:</h2>
								<!-- mark up for text editor to create a comment -->
								<textarea name="editor1"><?php formLastValue('editor1'); ?></textarea>
	        					<script>CKEDITOR.replace('editor1',{toolbar:'Basic',uiColor:'#888888'});</script>
								<div class="errorText"><?php echo $error['editor1']; ?></div>
								<!-- mark up for form submission button -->
								<button class="submitButton" type="submit">Comment!!!</button>
	       					</form>
		       			</div>
		       			<!-- mark up for form submission button -->
		       			<?php if(empty($comments)) : ?>
							<p class="blurb">No comments yet...</p>
						<?php else : ?>
							<!-- markup to show comments made on the current post -->
							<?php foreach($comments as $comment) : ?>
								<div class="largeContent">
									<p><?php echo $comment['username']; ?> says:</p>
									<?php echo $comment['comment']; // not wrapped in html tags as ck editor adds tags automatically... ?>	
									<p>Submitted: <?php echo $comment['created_at']; ?></p>
								</div>
							<?php endforeach; ?>
						<?php endif; ?>
					<?php else : ?>
						<!-- mark up for guest user -->
						<div class="largeContent">
							<!-- markup for full display of chosen post -->
							<h2><?php echo $post['title']; ?></h2>
							<p><?php echo $post['content']; ?></p>
							 <!-- link to display of more posts by the searched for user -->
	                    	<a href="?page=search&usernameSearch=<?php echo $post['username']; ?>">View more posts by <?php echo $post['username']; ?></a>
						</div>
						<!-- link to prompt user to log in to make a comment -->
						<p class="blurb"><a href="?page=login">Log in</a> and make a comment...</p>
						<!-- markup to show comments made on the current post -->
						<?php if(empty($comments)) : ?>
							<p class="blurb">No comments yet...</p>
						<?php else : ?>
		       				<!-- markup to show comments made on the current post -->
							<?php foreach($comments as $comment) : ?>
								<div class="largeContent">
									<p><?php echo $comment['username']; ?> says:</p>
									<?php echo $comment['comment']; // not wrapped in html tags as ck editor adds tags automatically... ?>	
									<p>Submitted: <?php echo $comment['created_at']; ?></p>
								</div>
							<?php endforeach; ?>
						<?php endif; ?>
					<?php endif; ?>			
				</div> <!-- end of content div -->