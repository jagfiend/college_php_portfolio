<!DOCTYPE html>
	<html> 
		<head> <!-- head -->
			<meta charset="UTF-8">
			<title>Dribblr</title>
			<link rel="stylesheet" type="text/css" href="site/css/style.css">
			<script src="site/ckeditor/ckeditor.js"></script>
		</head> <!-- end of head -->
		<body> <!-- body -->
			<div id="wrapper"> <!-- wrapper div, surrounds all site content -->
				<div id='banner'> <!-- banner div -->
					<?php if (loggedIn()) : ?> <!-- checks if user is logged in to serve correct navigation -->
						<!-- view for logged in user -->
						<div id="logo">
							<!-- link to stream page, home for logged in users -->
							<a href="?page=stream"><h1>dribblr.</h1></a>
						</div>
	                    <div id="navigation">
	                    	<!-- links to pages for logged in user -->
							<a class="loggedNavButton" href="?page=stream">Stream</a>
							<a class="loggedNavButton" href="?page=admin">Admin</a>
							<a class="loggedNavButton" href="?page=login&action=logout">Log Out</a>
						</div>
                    <?php else : ?>
	                    <!-- view for guest user -->
	                    <div id="logo">
	                    	<!-- link to home page -->
							<a href="?page=home"><h1>dribblr.</h1></a>
						</div>
						<div id="navigation">
							<!-- links to guest pages -->
	                        <a class="guestNavButton" href="?page=login">Log In</a>
							<a class="guestNavButton" href="?page=signup">Sign Up</a>
						</div>
                    <?php endif; ?>
                    <!-- markup for search functionality, note use of hidden field to send extra information to the $_GET super global -->
                    <div id="search">
						<form method="get" action="">
							<input type="hidden" name="page" value="search"/>
  							<input name="searchValue" type="text" size="50" placeholder="Search..."/>
						</form>
					</div>
				</div> <!-- end of banner div -->
				