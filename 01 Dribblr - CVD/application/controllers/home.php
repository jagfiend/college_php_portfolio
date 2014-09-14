<?php // controller for home page
// supporting data function file...
include(DATA.'posts.php');
// variables for pagination...
$numPosts = numberOfPosts();
$limit = 12; // number of posts to be displayed per page...
$pages = ceil($numPosts/$limit);
// if statement for pagination
if (isset($_GET['subpage'])){
	$subpage = $_GET['subpage'];
} else {
	$subpage = 1;
}
// variable for page data...
$posts = getAllPosts($subpage,$limit);
// views...
include(VIEWS.'header.php');
include(VIEWS.'contentHome.php');
include(VIEWS.'footer.php');
?>