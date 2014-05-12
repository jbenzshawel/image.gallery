<?php

	class Gallery{
		/**
		 * @param $url = string url of reddit subreddit to scrape images from
		 * @param $page = string or int of page number to scrape from 
		 * returns $images array 
		 */
		public static function get_images($url, $page){
			//$url = $this->url;
			//$page = $this->page;
			$images = array();
			$feed_url = isset($page) ? ((int)$page > 0 ? $url . '&page=' . $page : $url) : $url;
			$reddit_scrape = file_get_contents($feed_url);
			$pattern = '#<a\s+href=[\'"]([^\'"]+)[\'"]\s*(?:title=[\'"]([^\'"]+)[\'"])?\s*>((?:(?!</a>).)*)</a>#i';
			preg_match_all($pattern,$reddit_scrape, $matches, PREG_OFFSET_CAPTURE);
			foreach($matches[0] as $link){
				if(strpos($link[0], '[link]')) {
					preg_match('/<a href="(.+)">/', $link[0], $match);
					$images[] = $match[1];
				}
			}
			return $images;
		}
		/**
		 * @param $url = string of imgur gallery url 
		 * retruns $results array("gallery" => $gallery, "title" => $title)
		 */
		public  static function get_imgur_gallery($url){
			$imgur = file_get_contents($url);
			$gallery = array();
			$regex = "!(.*)(</title>)!i";
			preg_match($regex, $imgur, $title);
			preg_match_all('/img.+"/', $imgur, $image_match);
			preg_match_all('/data-src=.+"/', $imgur, $filter);
		
			foreach($filter[0] as $entry){
					$new_imgur = substr($entry, strpos($entry, "/") + 1);  
					$gallery[] = 'http:/' . $new_imgur;
			}
			
			$results = array("gallery" => $gallery, "title" => $title);
			
			return $results;
		}
	}


