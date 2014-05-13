<?php
if(!isset($link_info)){
	$link_info="";			
}
?>
<li><input type="search" placeholder="search subreddits" name="s"></input><input type="submit" id="searchSub" ></input></li>
<li><a href="info.php<?php echo $link_info;?>">Details View</a></li>
<li><a href="index.php<?php echo $link_info;?>">Gallery View</a></li>