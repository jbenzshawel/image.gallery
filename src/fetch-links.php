<?php

class Gallery{
    /**
     * @param $url = string url of reddit subreddit to scrape images from
     * @param $page = string or int of page number to scrape from
     * returns $images array
     */
    public static function getImages($subreddit, $page){
        $url = ($subreddit == "front") ? "http://reddit.com/.rss" : "http://reddit.com/r/$subreddit.rss";
        $next_page = $page + 1;
        $limit = 25*$page;
        $after = $limit - 25;
        // if page is greater than one set the limit for rss query
        $feed_url = isset($page) ? ((int)$page > 0 ? "$url?limit=$limit"  : $url) : $url;
        $rss = simplexml_load_file($feed_url);
        $i = 0;
        foreach($rss->channel->item as $feedItem){
            $itemDesc = explode(' ', $feedItem->description);
            // pull links out of description and store in images array
            foreach($itemDesc as $word){
                preg_match('/href=".+link\]<\/a>/', $word, $match);
                if(count($match) > 0){
                   $images[$i]['link'] = substr($match[0], 6, -12);
                } 
            }
            $images[$i]['title'] = $feedItem->title;
            $i++;
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
        $new_title = str_replace("</title>", "", $title);
        preg_match_all('/data-src=.+"/', $imgur, $filter);

        foreach($filter[0] as $entry){
                $new_imgur = substr($entry, strpos($entry, "/") + 1);
                $gallery[] = 'http:/' . $new_imgur;
        }

        $results = array("gallery" => $gallery, "title" => $new_title);

        return $results;
    }

	public static function fetchPosts($category, $limit, $after){
	  	// Load the XML source
		$xml = new DOMDocument;
		if($category == "front" or strlen($category) == 0){
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