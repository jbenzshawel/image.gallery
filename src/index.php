<!doctype html>
<html>
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<?php
		$subreddit = isset($_GET['subreddit']) ? $_GET['subreddit'] : 'gonewild';
		if($subreddit == 'gonewild'){
			$title = "Wank Gallery";
		} else {
			$title = "/r/$subreddit - Wank Gallery";
		}

	?>
	<title><?php echo $title; ?></title>

	<!--Styles-->
	<link rel="stylesheet" type="text/css" href="lib/fancybox/jquery.fancybox.css" />
	<link rel="stylesheet" type="text/css" href="lib/foundation/css/foundation.css" />
	<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
<?php
	require_once('fetch-links.php');
	$page = isset($_GET['page']) ? $_GET['page'] : 1;
	$next_page = $page + 1;
	if($subreddit != "gonewild"){
		$images = Gallery::get_images($subreddit, $page);
		$link_info = "?subreddit=$subreddit&page=$page";
	}else {
		$images = Gallery::get_images($subreddit, $page);
		$link_info = "?page=$page";
	}
	if(!isset($link_info)){
		$link_info="";
	}
	$i = 0;
?>
<!--Off Canvas Wrapper-->
<div class="off-canvas-wrap" data-offcanvas>
	<div class="inner-wrap">
		<!--Header-->
		<header class="main">
			<h2><a href="index.php">Wank Gallery</a></h2>
			<a class="right-off-canvas-toggle" href="#" >Menu</a>

			<!-- Off Canvas Menu -->
		    <aside class="right-off-canvas-menu">
		        <ul class="off-canvas-list">
		          <?php include 'sidebar.php'; ?>
		        </ul>
		    </aside>
		</header><!--End Header-->
		<!--Main Content-->
		<ul class="images">
		<?php
			foreach($images as $image){
				if(strpos($image['link'], "/a/")){
					$j = 0;
					$gallery = Gallery::get_imgur_gallery($image['link']);
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
					if(substr($image['link'], -4, 1) == "."){
						echo '<li><a class="fancybox" rel="group" title="' . $image['title'] . '" href="' . $image['link'] . '"><img class="thumbnail" src="' . $image['link'] .'" alt=""/></a></li>' . "\n"; 
					} elseif (substr($image['link'], 0, 21) == 'http://www.reddit.com' ) {
						echo '<li><a class="fancybox" rel="group" title="' . $image['title'] . '" href="'. $image['link'] .'"><img class="thumbnail" src="img/self-post.png" style="width:180px; height:auto;" alt="selfpost" /></a></li>' . "\n"; 
					} elseif(strpos($image['link'], 'imgur') and substr($image['link'], -4, 1) != ".")  {
						$cleaned_link = strpos($image['link'], "&") ? substr($image['link'], 0, stripos($image['link'], "&") ) : $image['link'];
					} else{
						echo '<li><a class="fancybox" rel="group" title="' . $image['title'] . '" href="'. $image['link'] .'"><img class="thumbnail" src="img/self-post.png" style="width:180px; height:auto;" alt="selfpost" /></a></li>' . "\n"; 
					}
				}
			}
		?>
		</ul><!--Close image list-->
	<?php if($subreddit == "gonewild"): ?>
				<a href="<?php echo '?page=' . $next_page; ?>" id="morePosts">Page <?php echo $next_page; ?></a>
		<?php elseif($page == 5): ?>
			<p>Sorry this site only goes back five pages right now. Check back for improvements!</p>
		<?php else: ?>
				<a href="<?php echo '?subreddit=' . $subreddit . '&page=' . $next_page; ?>" id="morePosts">Page <?php echo $next_page; ?></a>
		<?php endif; ?>
		
<!-- close the off-canvas menu -->
  <a class="exit-off-canvas"></a>

  </div> <!--End Inner Wrapper-->
</div><!--End Off Canvas Wrapper-->
	
	<!--Framework Stuff-->
	<script src="lib/jquery.min.1.11.js"></script>
	<script src="lib/foundation/js/foundation/foundation.js"></script>
	<script src="lib/foundation/js/foundation/foundation.offcanvas.js"></script>
	<script src="lib/fancybox/jquery.fancybox.js"></script>
	<script type="text/javascript" src="scripts.js"></script>

	<!--GOOLGE ANALYTICS-->
	<script>
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

		ga('create', 'UA-43365901-3', 'wank.gallery');
		ga('send', 'pageview');
	</script>
</body>
</html>