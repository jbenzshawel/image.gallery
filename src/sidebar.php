<?php 
if(!isset($link_info)){ 
	$link_info=""; 
} 
$checked_gifs = (isset($gifs)) ? "checked" : ""; ?>
<li><input type="search" placeholder="search subreddits" name="s"></input><input type="submit" id="searchSub" ></input></li>
<li><a href="info.php<?php echo $link_info;?>">Details View</a></li>
<li><a href="index.php<?php echo $link_info;?>">Gallery View</a></li>
<li>
	<form action="" id="sidebar_form" method="POST">
		<label for="load_gifs">Load gifs?</label>
		<input type="checkbox" id="load_gifs" name="gifs" value="checked" <?php //echo $checked_gifs; ?>/>
		<input type="image" value="submit" src="img/refresh.png"/>
	</form>
</li>