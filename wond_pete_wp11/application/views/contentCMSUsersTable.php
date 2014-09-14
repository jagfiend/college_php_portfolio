<!DOCTYPE html> <!-- cms pages include header and footer html to prevent duplicate header errors -->
	<html>
		<head> <!-- head -->
			<meta charset="UTF-8">
			<title>Dribblr</title>
			<link rel="stylesheet" type="text/css" href="site/css/style.css">
			<script src="site/ckeditor/ckeditor.js"></script>
		</head> <!-- end of head -->
		<body> <!-- body -->
			<div id="content"> <!-- content div -->
				<div class="blurb">CMS: Users Table</div>
				<div class="largeContentCMS">
					<!-- link back to CMS homepage -->
					<a href="?page=cmsHome">Back to CMS homepage</a>
					<!-- link to post create page -->
					<p><a href='?page=cmsUsersTable&action=create'>Create a new user</a></p>
					<!-- markup for table of function results -->
					<table>
						<!-- markup for table column headers -->
						<thead>
							<tr>
								<th>User Id</th>
								<th>Username</th>
								<th>Email</th>
								<th>Password</th>
								<th>Role</th>
								<th>Created_at</th>
								<th>Updated_at</th>
								<th>Update?</th>
								<th>Delete?</th>
							</tr>
						</thead>
						<!-- markup for table content, values from getAllUsers function  -->
						<tbody>
							<?php foreach ($users as $user) : ?>
							<tr>
								<td><?php echo $user['id']; ?></td>
								<td><?php echo $user['username']; ?></td>
								<td><?php echo $user['email']; ?></td>
								<td><?php echo $user['password']; ?></td>
								<td><?php echo $user['role']; ?></td>
								<td><?php echo $user['created_at']; ?></td>
								<td><?php echo $user['updated_at']; ?></td>
								<!-- links to update and delete pages -->
								<td><a href='?page=cmsUsersTable&action=update&id=<?php echo $user['id']; ?>'>Update</a></td>
								<td><a href='?page=cmsUsersTable&action=delete&id=<?php echo $user['id']; ?>'>Delete</a></td>
							</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
					<!-- links repeated for usability, ie do not have scroll back up from the bottom of long table -->
					<!-- link to comment create page -->
					<p><a href='?page=cmsUsersTable&action=create'>Create a new user</a></p>
					<!-- link back to CMS homepage -->
					<a href="?page=cmsHome">Back to CMS homepage</a>
				</div>
			</div>
		</body> <!-- end of body -->
	</html>