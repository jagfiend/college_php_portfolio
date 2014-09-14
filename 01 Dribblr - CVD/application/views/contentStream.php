				<div id="content"> <!-- content div -->
					<div class="blurb">Hi <?php echo $_SESSION['username']; ?>, this is your post stream:</div>
					<?php if(isAdmin(true)) : // if statement checks whether user is an admin to determine if cms button shown ?>
						<form id="buttonFrame" method="get" action="">
								<!-- link button to cms home page -->
								<button class="contentNavButton" type="submit" name="page" value="cmsHome">CMS Home</button>
						</form>
					<?php endif; ?>
					<form id="buttonFrame" method="get" action="">
							<!-- link button to create post page -->
							<button class="contentNavButton" type="submit" name="page" value="create">Create New Post</button>
					</form>
					<!-- markup for large thumbnails of logged in users posts -->
					<?php foreach($posts as $post) : ?>
						<div class="indexLargeThumb">
							<!-- each thumbnail acts as a link to the full display of the post -->
							<a href="?page=postDisplay&id=<?php echo $post['id']; ?>">
								<div>
									<img src="site/img/<?php echo $post['category']; ?>.jpg" alt="there should be a picture here">
									<h2><?php echo $post['title']; ?></h2>
								</div>
							</a>
						</div>
					<?php endforeach; ?>
				</div> <!-- end of content div -->