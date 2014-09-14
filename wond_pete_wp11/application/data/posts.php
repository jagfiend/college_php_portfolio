<?php // posts data file...
function createPost($userId,$title,$editor1,$category){
	$result = mysql_query("insert into posts(
		userId,
		title, 
		content,
		category, 
		created_at
		)
		values(
		'$userId',
		'$title',
		'$editor1',
		'$category',
		NOW())"
	);
	if (!$result){
		echo 'Quick, tell the nearest professional:'.mysql_errno().': '.mysql_error().'<br>';
		exit;
	}
}

function getAllPosts($subpage,$limit){ // function to return all posts on the home page...
	$page = ($subpage * $limit) - $limit; // pagination calculation...
	$result = mysql_query("
		select *
		from posts
		order by created_at desc
		limit $page, $limit 
		"); // note order by statement to ensure the first post display is the most recent addition to the database...
	if (!$result){
		echo 'Quick, tell the nearest professional:'.mysql_errno().': '.mysql_error().'<br>';
	}
	$posts = []; // array shorthand
	while ($record = mysql_fetch_assoc($result)){
		array_push($posts, $record);
	}
	return $posts;
}

function getAllPostsCMS(){ // function to return all posts for the cms table
	$result = mysql_query("
		select posts.id, posts.title, posts.content, posts.category, posts.created_at, posts.updated_at, users.username as username
		from posts 
		inner join users
		on users.id = posts.userId
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

function numberOfPosts(){ // function to return count of posts in the table...
	$result = mysql_query("select count(*)
		as numPosts 
		from posts
		");
	if (!$result){
		echo 'Quick, tell the nearest professional:'.mysql_errno().': '.mysql_error().'<br>';
	}
	$data = mysql_fetch_assoc($result);
	return $data['numPosts'];
}

function getAllPostsByUsername($username){ // function to return all the posts of a specific user...
	$result = mysql_query("
		select posts.id, posts.title, posts.category, users.username 
		from posts 
		inner join users
		on users.id = posts.userId
		where users.username = '$username'
		order by posts.created_at desc
		"); // note order by statement to ensure the first post display is the most recent addition to the database...
	if (!$result){
		echo 'Quick, tell the nearest professional:'.mysql_errno().': '.mysql_error().'<br>';
	}
	$posts = [];
	while ($record = mysql_fetch_assoc($result)){
		array_push($posts, $record);
	}
	return $posts;
}

function getPostById($id){ // function to return detail of a single post from table by its id...
	$result = mysql_query("
		select posts.id, posts.title, posts.category, posts.content, posts.created_at, users.id as userId, users.username 
		from posts 
		inner join users
		on users.id = posts.userId
		where posts.id = $id
		");
	if (!$result){
		echo 'Quick, tell the nearest professional:'.mysql_errno().': '.mysql_error().'<br>';
	}
	$data = mysql_fetch_assoc($result);
	return $data;
}

function updatePost($id, $userId, $title, $editor1, $category){ // function to update posts in the cms...
	$result = mysql_query("
		update posts
		set
		userId = '$userId',
		title = '$title',
		content = '$editor1',
		category = '$category',
		updated_at = NOW()
		where id = $id
	");
	if (!$result){
		echo 'Quick, tell the nearest professional:'.mysql_errno().': '.mysql_error().'<br>';
	}
}

function deletePost($id){ // function to delete posts in the cms...
	$result = mysql_query("delete from posts where id = $id");
	if (!$result){
		echo 'Quick, tell the nearest professional:'.mysql_errno().': '.mysql_error().'<br>';
	}
}

function searchPosts($q){ // search takes value and checks if exists in each of the main fields of the posts table...
    $result = mysql_query("
    	select posts.id, posts.title, posts.category, users.username 
		from posts 
		inner join users
		on users.id = posts.userId
		where users.username like '%$q%'
		or posts.title like '%$q%'
        or posts.content like '%$q%'
        or posts.category like '%$q%'
        order by posts.created_at desc
        ");
    if (!$result){
		echo 'Quick, tell the nearest professional:'.mysql_errno().': '.mysql_error().'<br>';
	}
    $posts = [];
    while ($record = mysql_fetch_assoc($result)){
        array_push($posts, $record);
    }
    return $posts;
}

function searchUsername($username){ // search function by username for use in post link "show more by user x"...
    $result = mysql_query("
    	select posts.id, posts.title, posts.category, users.username 
		from posts 
		inner join users
		on users.id = posts.userId
		where users.username = '$username'
        order by posts.created_at desc
        ");
    if (!$result){
		echo 'Quick, tell the nearest professional:'.mysql_errno().': '.mysql_error().'<br>';
	}
    $posts = [];
    while ($record = mysql_fetch_assoc($result)){
        array_push($posts, $record);
    }
    return $posts;
}
?>