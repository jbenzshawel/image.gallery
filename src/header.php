<!doctype html>
<html>
<head>
<?php
	$subreddit = isset($_GET['subreddit']) ? $_GET['subreddit'] : "front";
	if($subreddit == "front"){
		$title = "Image Gallery"; 
		$home_logo = $title;
	} else {
		$home_logo = "/r/$subreddit";
		$title = $home_logo . " - Image Gallery";
	} ?>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
	<title><?php echo $title; ?></title>

	<!--Styles-->
	<link rel="stylesheet" type="text/css" href="lib/foundation/css/normalize.css" />
	<link rel="stylesheet" type="text/css" href="lib/foundation/css/foundation.css" />
	<link rel="stylesheet" type="text/css" href="lib/fancybox/jquery.fancybox.css" />
	<link rel="stylesheet" type="text/css" href="style.css" />
	<link href='http://fonts.googleapis.com/css?family=Roboto:400,100' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
</head>
<body>
<?php
	require_once('fetch-links.php');
	$page = isset($_GET['page']) ? $_GET['page'] : 1;
	$next_page = $page + 1;
	$link_info = ($subreddit != "front") ? "?subreddit=$subreddit&page=$page" : "?page=$page";	
	// if in details view load post details else load gallery images
	if(strpos($_SERVER['PHP_SELF'], "info.php") !== FALSE){
		$limit = 25*$page;
		$after = $limit - 25;
		$details = Gallery::fetchPosts($subreddit, $limit, $after);
	} else{
		$images = Gallery::getImages($subreddit, $page);
	} ?>
<!--Off Canvas Wrapper-->
<div class="off-canvas-wrap" data-offcanvas>
	<div class="inner-wrap">
		<!--Header-->
		<header class="main">
			<h2><a href="index.php"><?php echo $home_logo; ?></a></h2>
			<a class="right-off-canvas-toggle" href="#" >Menu</a>
			<!-- Off Canvas Menu -->
		    <aside class="right-off-canvas-menu">
		        <ul class="off-canvas-list">
		          <?php include 'sidebar.php'; ?>
		        </ul>
		    </aside>
		</header><!--End Header-->
	