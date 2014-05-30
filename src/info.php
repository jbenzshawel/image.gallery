<?php require_once('header.php'); ?>
<!--Main Content-->
<div class="info-wrap">
	<?php echo $details; ?>
</div>
<?php if($subreddit == "front"): ?>
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