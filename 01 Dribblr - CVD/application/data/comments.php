<?php // comments data file...
function getAllPostComments($postId){ // function to return all comments using the postId....
	$result = mysql_query("
		select comments.comment, comments.created_at, users.username
		from comments
		inner join posts
		on posts.id = comments.postId 
		inner join users
		on users.id = comments.userId
		where comments.postId = '$postId'
		order by created_at desc
		");
	if (!$result){
		echo 'Quick, tell the nearest professional:'.mysql_errno().': '.mysql_error().'<br>';
	}
	$comments = []; // array shorthand
	while ($record = mysql_fetch_assoc($result)){
		array_push($comments, $record);
	}
	return $comments;
}

function createComment($userId,$postId,$editor1){ // function to insert comment into db...
	$result = mysql_query("
		insert into comments(
		userId,
		postId,
		comment,
		created_at
		)
		values(
		'$userId',
		'$postId',
		'$editor1',
		NOW()
		)"
	);
	if (!$result){
		echo 'Quick, tell the nearest professional:'.mysql_errno().': '.mysql_error().'<br>';
		exit;
	}
}

function getAllCommentsCMS(){ // function to return all comments for the cms table
	$result = mysql_query("
		select comments.id, comments.postId, comments.comment, comments.created_at, comments.updated_at, users.username as username
		from comments 
		inner join users
		on users.id = comments.userId
		");
	if (!$result){
		echo 'Quick, tell the nearest professional:'.mysql_errno().': '.mysql_error().'<br>';
	}
	$posts = []; // array shorthand
	while ($record = mysql_fetch_assoc($result)){
		array_push($posts, $record);
	}
	return $posts;
}

function getAllPostIds(){ // function to populate dropdown menu in the comment update part of the CMS...
	$result = mysql_query("
		select posts.id
		from posts
		");
	if (!$result){
		echo 'Quick, tell the nearest professional:'.mysql_errno().': '.mysql_error().'<br>';
	}
	$posts = []; // array shorthand
	while ($record = mysql_fetch_assoc($result)){
		array_push($posts, $record);
	}
	return $posts;
}

function getCommentById($id){ // function to call individual comment detail in the cms...
	$result = mysql_query("
		select comments.id, comments.userId, comments.postId, comments.comment,
		comments.created_at, comments.updated_at, posts.title, users.username  
		from comments
		inner join posts
		on posts.id = comments.postId 
		inner join users
		on users.id = comments.userId
		where comments.id = $id
		");
	if (!$result){
		echo 'Quick, tell the nearest professional:'.mysql_errno().': '.mysql_error().'<br>';
	}
	$data = mysql_fetch_assoc($result);
	return $data;
}

function updateComment($id,$userId,$postId,$editor1){ // function to update comments on the comments table...
	$result = mysql_query("
		update comments
		set
		userId = '$userId',
		postId = '$postId',
		comment = '$editor1',
		updated_at = NOW()
		where id = $id
	");
	if (!$result){
		echo 'Quick, tell the nearest professional:'.mysql_errno().': '.mysql_error().'<br>';
	}
}

function deleteComment($id){ // function to delete comments from comments table...
	$result = mysql_query("delete from comments where id = $id");
	if (!$result){
		echo 'Quick, tell the nearest professional:'.mysql_errno().': '.mysql_error().'<br>';
	}
}
?>