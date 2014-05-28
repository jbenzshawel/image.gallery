<?php require_once('header.php'); ?>
<!--Off Canvas Wrapper-->
<div class="off-canvas-wrap" data-offcanvas>
	<div class="inner-wrap">
		<!--Header-->
		<header class="main">
			<h2><a href="info.php">/r/<?php echo $subreddit; ?></a></h2>
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
			<?php echo $details; ?>
		</div>
<?php if($subreddit == "gonewild"): ?>
		<a href="<?php echo '?page=' . $next_page; ?>" id="morePosts">Page <?php echo $next_page; ?></a>
<?php elseif($page == 5): ?>
	<p>Sorry this site only goes back five pages right now. Check back for improvements!</p>
<?php else: ?>
		<a href="<?php echo 'info.php?subreddit=' . $subreddit . '&page=' . $next_page; ?>" id="morePosts">Page <?php echo $next_page; ?></a>
<?php endif; ?>
		<a class="exit-off-canvas"></a><!-- close the off-canvas menu -->
	</div> <!--End Inner Wrapper-->
</div><!--End Off Canvas Wrapper-->
<?php include('footer.php'); ?>