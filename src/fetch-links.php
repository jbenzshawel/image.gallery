<?php

class Gallery{
	/**
	 * @param $url = string url of reddit subreddit to scrape images from
	 * @param $page = string or int of page number to scrape from 
	 * returns $images array 
	 */
	public static function get_images($subreddit, $page){
		$url = "http://reddit.com/r/$subreddit.rss";
		$next_page = $page + 1;
		$limit = 25*$page;
		$after = $limit - 25;
		$feed_url = isset($page) ? ((int)$page > 0 ? "$url?limit=$limit"  : $url) : $url;
		$reddit_scrape = file_get_contents($feed_url);
		$rss = simplexml_load_file($feed_url);	
		$reddit_scrape_array = explode(" ", $reddit_scrape);
		$i = 0;
		$j = 0;
		foreach($reddit_scrape_array as $row){
			if(strpos($row, '[link]')) {
				$images[$i]['link'] = substr($row, 10, strlen($row) - 35);  
				$i++;
			}

		}
		foreach($rss->channel->item as $feedItem){
			$images[$j]['title'] = $feedItem->title;
			$j++;
		}
		if($limit == 25){
			return $images;
		} else {
			for($i = count($images) - 25; $i < count($images); $i++){
				$new_images[] = $images[$i];
			}
			return $new_images;
		}
	}

	/**
	 * @param $url = string of imgur gallery url 
	 * retruns $results array("gallery" => $gallery, "title" => $title)
	 */
	public static function get_imgur_gallery($url){
		$imgur = file_get_contents($url);
		$gallery = array();
		$regex = "!(.*)(</title>)!i";
		preg_match($regex, $imgur, $title);
		preg_match_all('/data-src=.+"/', $imgur, $filter);
		
		foreach($filter[0] as $entry){
				$new_imgur = substr($entry, strpos($entry, "/") + 1);  
				$gallery[] = 'http:/' . $new_imgur;
		}
		
		$results = array("gallery" => $gallery, "title" => $title);
		
		return $results;
	}


	public static function fetchPosts($category, $limit, $after){
	  	// Load the XML source
		$xml = new DOMDocument;
		if($category == "all" or strlen($category) == 0){
			$feedURL = 'http://www.reddit.com/.rss?limit=' . $limit;
		} else{
			$feedURL = 'http://www.reddit.com/r/' . $category . '.rss?limit=' . $limit;
		}
		//echo $feedURL . "<br/>";
		$xml->load($feedURL);
		$xsl = new DOMDocument;
		$xsl->load('format-posts.xsl');

		// Configure the transformer
		$proc = new XSLTProcessor;
		$proc->importStyleSheet($xsl); // attach the xsl rules
		$xsl = $proc ->setParameter('', 'after', $after);
		return $proc->transformToXML($xml);
	}
}


