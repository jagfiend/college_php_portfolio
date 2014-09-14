<?php // functions file 
// functions to ensure user is logged in - prevents unwanted guest access to logged in area...
// ie you can't type a restricted page name into the url to navigate there...
function loggedIn() {
	if (isset($_SESSION['logged_in'])){
		return true;
	} else {
		return false;
	}
}

function requireLogin(){ // prevents unauthorised access to the registered users pages...called on the controllers for these pages...
	if (!loggedIn()){
		header('Location: ?page=redirect');
	}
}

// functions to check whether the user logged in is an admin or not...if so they will be able to access the cms... 
function probeAdmin(){ // prevents unauthorised access to the CMS pages...called on the controllers for these pages...
	requireLogin();
	if ($_SESSION['role'] != 'admin'){
		header('Location: ?page=stream');
	}
}

function isAdmin(){ // fucntion used to add navigation to the CMS from the stream page for admin users...
	if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin'){
		return true;
	} else {
		return false;
	}
}

// other functions used on numerous pages...
function formLastValue($field){ // function populates input fields if necessary (if errors etc); used on controllers for that include views with forms...
	
	if(isset($_POST[$field])){
		
		echo $_POST[$field];

	}

}
?>