				<div id="content"> <!-- content div -->
					<?php if(empty($posts)) : ?>
						<!-- markup to display the value used in the unsuccessful search... -->
						<div class="blurb">No results found for "<?php echo $search_query; ?>"</div>
					<?php else : ?>
						<!-- markup to display the value used in the successful search... -->
						<?php if(!empty($_GET['searchValue'])) : ?>
							<div class="blurb">Search results for "<?php echo $_GET['searchValue']; ?>":</div>
						<?php else : ?>
							<div class="blurb">Search results for "<?php echo $_GET['usernameSearch']; ?>":</div>
						<?php endif; ?>
						<!-- markup for thumbnails of posts found by search -->
						<?php foreach($posts as $post) : ?>
							<div class="indexSmallThumb">
								<!-- each thumbnail acts as a link to the full display of the post -->
								<a href="?page=postDisplay&id=<?php echo $post['id']; ?>">
									<div>
										<img src="site/img/<?php echo $post['category']; ?>.jpg" alt="there should be a picture here">
										<h2><?php echo $post['title']; ?></h2>
									</div>
								</a>
							</div>
						<?php endforeach; ?>
					<?php endif; ?>
				</div> <!-- end of content div -->