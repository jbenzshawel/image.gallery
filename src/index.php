<?php
	require_once('header.php');
	require_once('fetch-links.php');
	$page = isset($_GET['page']) ? $_GET['page'] : 1;
	$next_page = $page + 1;
	$images = Gallery::get_images($subreddit, $page);
	$link_info = ($subreddit != "gonewild") ? "?subreddit=$subreddit&page=$page" : "?page=$page";
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
			$i = 0;
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
						echo '<li><a class="fancybox" rel="group" title="' . $image['title'] . '" href="' . $image['link'] . '"><img class="thumbnail" src="' . $image['link'] .'" alt="'. $image['title'] . '"/></a></li>' . "\n"; 
					} elseif (substr($image['link'], 0, 21) == 'http://www.reddit.com' ) {
						echo '<li><a class="fancybox" rel="group" title="' . $image['title'] . '" href="'. $image['link'] .'"><img class="thumbnail" src="img/self-post.png" style="width:180px; height:auto;" alt="selfpost" /></a></li>' . "\n"; 
					} elseif(strpos($image['link'], 'imgur') and substr($image['link'], -4, 1) != ".")  {
						$cleaned_link = strpos($image['link'], "&") ? substr($image['link'], 0, stripos($image['link'], "&") ) : $image['link'];
						echo "<li><a class='fancybox' rel='group'  title='{$image['title']}'  href='$cleaned_link'><img class='thumbnail' src='$cleaned_link.jpg' alt=''/></a></li>\n"; 
					} else{
						echo '<li><a class="fancybox" rel="group" title="' . $image['title'] . '" href="'. $image['link'] .'"><img class="thumbnail" src="img/self-post.png" style="width:180px; height:auto;" alt="selfpost" /></a></li>' . "\n"; 
					}
				}
			} ?>
		</ul><!--Close image list-->
<?php if($subreddit == "gonewild"): ?>
		<a href="<?php echo '?page=' . $next_page; ?>" id="morePosts">Page <?php echo $next_page; ?></a>
<?php elseif($page == 5): ?>
	<p>Sorry this site only goes back five pages right now. Check back for improvements!</p>
<?php else: ?>
		<a href="<?php echo '?subreddit=' . $subreddit . '&page=' . $next_page; ?>" id="morePosts">Page <?php echo $next_page; ?></a>
<?php endif; ?>
		<a class="exit-off-canvas"></a><!-- close the off-canvas menu -->
	</div> <!--End Inner Wrapper-->
</div><!--End Off Canvas Wrapper-->
<?php include('footer.php'); ?>