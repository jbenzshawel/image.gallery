<!doctype html>
<html>
<head>
	<meta charset="utf-8" />
	<title>Wank Gallery</title>

	<!--Styles-->
	<link rel="stylesheet" type="text/css" href="lib/fancybox/jquery.fancybox.css" />
	<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="style.css" />

	<!--Scripts-->
	<script type="text/javascript" src="lib/jquery.min.1.11.js"></script>
	<script type="text/javascript" src="lib/fancybox/jquery.fancybox.js"></script>
	<script type="text/javascript" src="scripts.js"></script>
</head>
<body>
<?php
	require_once('fetch-links.php');
	$page = isset($_GET['page']) ? $_GET['page'] : 1;
	$next_page = $page + 1;
	$subreddit = (isset($_GET) and strlen($_GET['subreddit']) > 1) ? $_GET['subreddit'] : 'gonewild';
	if($subreddit != "gonewild"){
		$images = get_images("http://addison.im/oneK/gonewild/", $page);
	}else {
		$images = get_images("http://addison.im/oneK/$subreddit/", $page);

	}
	$i = 0;
?>
<!--Header-->
<header class="main">
	<h2><a href="#">Wank Gallery</a></h2>
	<h3><a href="info.php">Details View</a></h3>
</header><br/>
<!--MAIN CONTENT-->
<div class="wrapper">
	<ul class="images">
	<?php
		foreach($images as $image){
			if(strpos($image, "/a/")){
				$j = 0;
				$gallery = get_imgur_gallery($image);
				$gallery_title = $gallery['title'][0];
				echo "<li><ul class='imgur-gal'>";
				foreach($gallery['gallery'] as $imgur){
					echo '<li><a class="fancybox-imgur" rel="imgur_gal' . $i . '" href="' . $imgur . '">[Gallery] ' . $gallery_title.'</a></li>' . "\n"; 
					$j++;
					if($j > count($gallery['gallery'])/2 - 1){
						break;
					}
				}
				echo "</ul></li>";
				$i++;
			} else {
				if(substr($image, -4, 1) == "."){
					echo '<li><a class="fancybox" rel="group" href="' . $image . '"><img class="thumbnail" src="' . $image .'" alt=""/></a></li>' . "\n"; 
				} else{
					echo '<li><a class="fancybox" rel="group" href="' . $image . '"><img class="thumbnail" src="http://placehold.it/350x350" alt=""/></a></li>' . "\n"; 
				}
			}
		}
	?>
	</ul>

	<a class="nextPage" href="?page=<?php echo $next_page; ?>">Page <?php echo $next_page; ?></a>
</div>
    <!--GOOLGE ANALYTICS-->
    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

      ga('create', 'UA-43365901-2', 'addison.im');
      ga('send', 'pageview');
    </script>
</body>
</html>