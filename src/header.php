<!doctype html>
<html>
<head>
<?php
	$subreddit = isset($_GET['subreddit']) ? $_GET['subreddit'] : 'gonewild';
	$title = ($subreddit === 'gonewild') ? "Wank Gallery" : "/r/$subreddit - Wank Gallery"; 
	?>
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