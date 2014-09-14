<?php // controller for search results page
// supporting data functions file...
include(DATA.'posts.php');
// page logic for appropriate search...
if(!empty($_GET['searchValue'])){
	$search_query = $_GET['searchValue'];
} elseif (!empty($_GET['usernameSearch'])){
	$search_query = $_GET['usernameSearch'];
}
// variable for search results...
$posts = searchPosts($search_query); 
// views...
include(VIEWS.'header.php');
include(VIEWS.'contentSearch.php');
include(VIEWS.'footer.php');
?>