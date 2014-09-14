<!DOCTYPE html> <!-- cms pages include header and footer html to prevent duplicate header errors -->
	<html>
		<head> <!-- head -->
			<meta charset="UTF-8">
			<title>Dribblr</title>
			<link rel="stylesheet" type="text/css" href="site/css/style.css">
		</head> <!-- end of head -->
		<body> <!-- body -->
			<div id="content"> <!-- content div -->
				<div class="blurb">CMS: Comments Table</div>
				<div class="largeContentCMS">
					<!-- link back to CMS homepage -->
					<a href="?page=cmsHome">Back to CMS homepage</a>
					<!-- link to comment create page -->
					<p><a href='?page=cmsCommentsTable&action=create'>Create a new comment</a></p>
					<!-- markup for table of function results -->
					<table>
						<!-- markup for table column headers -->
						<thead>
							<tr>
								<th>Comment Id</th>
								<th>Username</th>
								<th>Post Id</th>
								<th>Comment</th>
								<th>Created_at</th>
								<th>Updated_at</th>
								<th>Update?</th>
								<th>Delete?</th>
							</tr>
						</thead>
						<!-- markup for table content, values from getAllCommentsCMS function  -->
						<tbody>
							<?php foreach ($comments as $comment) : ?>
								<tr>
									<td><?php echo $comment['id']; ?></td>
									<td><?php echo $comment['username']; ?></td>
									<td><?php echo $comment['postId']; ?></td>
									<td><?php echo $comment['comment']; ?></td>
									<td><?php echo $comment['created_at']; ?></td>
									<td><?php echo $comment['updated_at']; ?></td>
									<!-- links to update and delete pages -->
									<td><a href='?page=cmsCommentsTable&action=update&id=<?php echo $comment['id']; ?>'>Update</a></td>
									<td><a href='?page=cmsCommentsTable&action=delete&id=<?php echo $comment['id']; ?>'>Delete</a></td>
								</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
					<!-- links repeated for usability, ie do not have scroll back up from the bottom of long table -->
					<!-- link to comment create page -->
					<p><a href='?page=cmsCommentsTable&action=create'>Create a new comment</a></p>
					<!-- link back to CMS homepage -->
					<a href="?page=cmsHome">Back to CMS homepage</a>
				</div>
			</div> <!-- end of content div -->
		</body> <!-- end of body -->
	</html>