<?php
function getAllUsers(){ // function calls all user records from users table to populate cms....
	$result = mysql_query('select * from users');
	if (!$result) {
		echo 'Quick, tell the nearest professional:'.mysql_errno().': '.mysql_error().'<br>';
	}
	$data = array();
	while ($record = mysql_fetch_assoc($result)){
		array_push($data, $record);
	}
	return $data;
}

function createUser($email, $username, $password){ // function uses validated field variables to write new user details into the users table...
	$password = md5($password);
	$result = mysql_query("
		insert into users(
			email,
			username,
			password,
			role,
			created_at,
			updated_at
		) 
		values( 
			'$email', 
			'$username',
			'$password',
			'user',
			NOW(),
			NOW()
		)"
	);
	if (!$result) {
		echo 'Quick, tell the nearest professional:'.mysql_errno().': '.mysql_error().'<br>';
		exit;
	}
}

function emailDuplicateCheck($email){
	// functions to prevent duplications during sign up...
	$result = mysql_query("
		SELECT users.email
		FROM users
		WHERE users.email='$email'
	");
	
	$rows = mysql_num_rows($result);
	
	if ($rows != 0){
		// email found
		return true;
	}

}
function usernameDuplicateCheck($username){

	$result = mysql_query("
		select users.username
		from users
		where users.username='$username'
	");
	$rows = mysql_num_rows($result);
	if ($rows != 0){
		// email not found
		return true;
	}
}

function getUserByLogin($username, $password){ 
	
	// function checks username and password match for login validation...
	$result = mysql_query("
		select * 
		from users 
		where username='$username' 
		and password='$password'
	");
	if (!$result){
		echo 'Quick, tell the nearest professional:'.mysql_errno().': '.mysql_error().'<br>';
		exit;
	}
	$rows = mysql_num_rows($result);
	if ($rows == 0){
		// user not found
		return false;
	} else {
		// user was found
		$data = mysql_fetch_assoc($result);
		return $data;
	}
}

function getUserById($userId){ 

	// function to return detail of a single user by their id...
	$result = mysql_query("
		select * 
		from users
		where id = $userId
	");
	if (!$result){
		echo 'Quick, tell the nearest professional:'.mysql_errno().': '.mysql_error().'<br>';
	}
	$data = mysql_fetch_assoc($result);
	return $data;
}

function getUserByUsername($username){ 

	// function to return detail of a single user by their username...
	$result = mysql_query("
		select * 
		from users
		where username = '$username'
	");
	if (!$result){
		echo 'Quick, tell the nearest professional:'.mysql_errno().': '.mysql_error().'<br>';
	}
	$rows = mysql_num_rows($result); // extra valdation for function use in login...
	if ($rows == 0){
		// user not found
		return false;
	} else {
		// user was found
		$data = mysql_fetch_assoc($result);
		return $data;
		return true;
	}
}

function updateUser($id, $email, $username, $password, $role){

	 // function to update user record via cms and user update...
	$password = md5($password);
	$result = mysql_query("
		update users 
		set
		email = '$email',
		username = '$username',
		password = '$password',
		role = '$role',
		updated_at = NOW()
		where id = $id
	");
	if (!$result){
		echo 'Quick, tell the nearest professional:'.mysql_errno().': '.mysql_error().'<br>';
	}
}

function updateUserNoPassword($id, $email, $username, $role){ 

	// function to update user record via cms without changing user password...
	$result = mysql_query("
		update users 
		set
		email = '$email',
		username = '$username',
		role = '$role',
		updated_at = NOW()
		where id = $id
	");
	if (!$result){
		echo 'Quick, tell the nearest professional:'.mysql_errno().': '.mysql_error().'<br>';
	}
}

function deleteUser($id){ 

	// function to delete user from users table...
	$result = mysql_query("delete from users where id = $id");
	if (!$result){
		echo 'Quick, tell the nearest professional:'.mysql_errno().': '.mysql_error().'<br>';
	}
}
?>