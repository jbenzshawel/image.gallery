<?php require_once('header.php'); ?>
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
				echo '<li><a class="fancybox-imgur" rel="imgur_gal' . $i . '" href="' . $imgur . '">[Gallery] ' . $image['title'] .'</a></li>' . "\n"; 
				$j++;
				if($j > count($gallery['gallery'])/2 - 1){
					break;
				}
			}
			echo "</ul></li>";
			$i++;
		} else {
			if (strpos($image['link'], '.gif') !== FALSE) {
				echo '<li><a class="fancybox" rel="group" title="' . $image['title'] . '" href="'. $image['link'] .'"><img class="thumbnail" src="img/self-post.png" style="width:180px; height:auto;" alt="selfpost" /></a></li>' . "\n"; 
			} elseif(substr($image['link'], -4, 1) == "."){
				echo '<li><a class="fancybox" rel="group" title="' . $image['title'] . '" href="' . $image['link'] . '"><img class="thumbnail" src="' . $image['link'] .'" alt="'. $image['title'] . '"/></a></li>' . "\n"; 
			} elseif(strpos($image['link'], 'imgur') !== FALSE and substr($image['link'], -4, 1) != ".")  {
				$cleaned_link = strpos($image['link'], "&") ? substr($image['link'], 0, stripos($image['link'], "&") ) : $image['link'];
				echo "<li><a class='fancybox' rel='group'  title='{$image['title']}'  href='$cleaned_link.jpg'><img class='thumbnail' src='$cleaned_link.jpg' alt=''/></a></li>\n"; 
			} else {
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