				<div id="content"> <!-- content div -->
					<div id="contentPageBlurb">You've landed at Dribblr, the definitive blog site for web design showcase and tutorials.</div>
					<!-- foreach loop creates thumbnails of all of the posts in the database --> 
					

					<?php foreach($posts as $post) : ?>
						<div class="indexSmallThumb">
							<!-- each thumbnail is a link to a full display of the post... -->
							<a href="?page=postDisplay&id=<?php echo $post['id']; ?>">
								<div>
									<img src="site/img/<?php echo $post['category']; ?>.jpg" alt="there should be a picture here">
									<h2><?php echo $post['title']; ?></h2>
								</div>
							</a>
						</div>
					<?php endforeach; ?>
					

					<?php if($numPosts > $limit) : ?> <!-- if there are fewer than 12 posts in the database, no controls displayed... -->
						<div class="pageControls"> <!-- div for pagination controls -->
							<!-- previous page control, will not appear if on the initial homepage (even when subpage equals 1) -->
							<?php if(isset($_GET['subpage']) && $_GET['subpage'] != 1) : ?>
								<a href="?page=home&subpage=<?php echo $subpage-1 ?>">...prev</a>
							<?php endif; ?>
							<!-- pages by number, for loop creates as many page links as required...will appear as a list of numbers -->	
							<ul>
						    <?php for($i = 1; $i <= $pages; $i++) : ?>
						        <li><a href="?page=home&subpage=<?php echo $i; ?>"><?php echo $i; ?></a></li>
						    <?php endfor; ?>
							</ul>
							<!-- next page control, will not appear if current subpage equals the total number of pages -->
							<?php if(empty($_GET['subpage']) || $_GET['subpage'] != $pages) : ?>
								<a href="?page=home&subpage=<?php echo $subpage+1 ?>">next...</a>
							<?php endif; ?>
						</div>
					<?php endif; ?>
				</div> <!-- end of content div -->