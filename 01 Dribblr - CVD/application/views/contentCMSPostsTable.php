<!DOCTYPE html> <!-- cms pages include header and footer html to prevent duplicate header errors -->
	<html> 
		<head> <!-- head -->
			<meta charset="UTF-8">
			<title>Dribblr</title>
			<link rel="stylesheet" type="text/css" href="site/css/style.css">
		</head> <!-- end of head -->
		<body> <!-- body -->
			<div id="content"> <!-- content div -->
				<div class="blurb">CMS: Posts Table</div>
				<div class="largeContentCMS">
					<!-- link back to CMS homepage -->
					<a href="?page=cmsHome">Back to CMS homepage</a>
					<!-- link to post create page -->
					<p><a href='?page=cmsPostsTable&action=create'>Create a new post</a></p>
					<!-- markup for table of function results -->
					<table>
						<!-- markup for table column headers -->
						<thead>
							<tr>
								<th>Post Id</th>
								<th>Username</th>
								<th>Title</th>
								<th>Content</th>
								<th>Category</th>
								<th>Created_at</th>
								<th>Updated_at</th>
								<th>Update?</th>
								<th>Delete?</th>
							</tr>
						</thead>
						<!-- markup for table content, values from getAllPostsCMS function  -->
						<tbody>
							<?php foreach ($posts as $post) : ?>
								<tr>
									<td><?php echo $post['id']; ?></td>
									<td><?php echo $post['username']; ?></td>
									<td><?php echo $post['title']; ?></td>
									<td><?php echo $post['content']; ?></td>
									<td><?php echo $post['category']; ?></td>
									<td><?php echo $post['created_at']; ?></td>
									<td><?php echo $post['updated_at']; ?></td>
									<!-- links to update and delete pages -->
									<td><a href='?page=cmsPostsTable&action=update&id=<?php echo $post['id']; ?>'>Update</a></td>
									<td><a href='?page=cmsPostsTable&action=delete&id=<?php echo $post['id']; ?>'>Delete</a></td>
								</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
					<!-- links repeated for usability, ie do not have scroll back up from the bottom of long table -->
					<!-- link to comment create page -->
					<p><a href='?page=cmsPostsTable&action=create'>Create a new post</a></p>
					<!-- link back to CMS homepage -->
					<a href="?page=cmsHome">Back to CMS homepage</a>
				</div>
			</div> <!-- end of content div -->
		</body> <!-- end of body -->
	</html>