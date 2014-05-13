<!doctype html>
<html>
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Wank Gallery</title>

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
		$limit = 25*$page;
		$after = $limit - 25;
		$subreddit = isset($_GET['subreddit']) ? $_GET['subreddit'] : 'gonewild';
		if($subreddit != "gonewild"){
			$content = Gallery::fetchPosts($subreddit, $limit, $after);
			$link_info = "?subreddit=$subreddit&page=$page";
		}else {
			$content = Gallery::fetchPosts($subreddit, $limit, $after);
			$link_info = "?page=$page";
		}
	
		$i = 0;
	?>
<!--Off Canvas Wrapper-->
<div class="off-canvas-wrap" data-offcanvas>
	<div class="inner-wrap">
		<!--Header-->
		<header class="main">
			<h2><a href="#">Wank Gallery</a></h2>
			<a class="right-off-canvas-toggle" href="#" >Menu</a>

			<!-- Off Canvas Menu -->
		    <aside class="right-off-canvas-menu">
		        <ul class="off-canvas-list">
		          <?php include 'sidebar.php'; ?>
		        </ul>
		    </aside>
		</header><!--End Header-->
		<!--Main Content-->
		<div class="info-wrap">
			<?php echo $content; ?>
		</div>

		<?php if($subreddit == "all"): ?>
				<a href=<?php echo '"&page=' . $next_page . '"'; ?> id="morePosts">Page <?php echo $next_page; ?></a>
		<?php elseif($page == 5): ?>
			<p>Sorry this site only goes back five pages right now. Check back for improvements!</p>
		<?php else: ?>
				<a href=<?php echo '"' . $subreddit . '&page=' . $next_page . '"'; ?> id="morePosts">Page <?php echo $next_page; ?></a>
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

      ga('create', 'UA-43365901-2', 'addison.im');
      ga('send', 'pageview');
    </script>
</body>
</html>