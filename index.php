<?php
/*
 * Wolf CMS - Content Management Simplified. <http://www.wolfcms.org>
 * Copyright (C) 2008-2010 Martijn van der Kleijn <martijn.niji@gmail.com>
 *
 * This file is part of Wolf CMS. Wolf CMS is licensed under the GNU GPLv3 license.
 * Please see license.txt for the full license text.
 */

/* Security measure */
if (!defined('IN_CMS')) { exit(); }

/**
 * This plugin allows you to integrate a search function on your site.
 *
 * @package plugins
 * @subpackage site_search
 *
 * @author Tina Keil <seven@geovoyagers.de>
 * @version 1.0.1
 * @since Wolf version 0.7.5
 * @license http://www.gnu.org/licenses/gpl.html GPL License
 * @copyright Tina Keil, 2011+
 */
 
/**
 * Root location where search plugin lives.
 */
define('SEARCH_ROOT', URI_PUBLIC.'wolf/plugins/site_search');

Plugin::setInfos(array(
	'id'          => 'site_search',
	'title'       => __('Site search'),
	'description' => __('Provides a basic search function with boolean support'),
	'version'     => '1.0.1',
	'license'     => 'GPL',
	'author'      => 'Tina Keil',
	'website'     => 'http://www.geovoyagers.de/',
	'update_url'  => 'http://www.tk-doku.de/wolf/plugin-versions.xml',
	'require_wolf_version' => '0.6.0'
));

// Add the plugin's tab and controller
Plugin::addController('site_search', __('Site search'));

/**
 * TRIM SHORT DESCRIPTON
 */
function site_search_truncate($text='', $length, $suffix ='&hellip;', $break=' ') {
  if (strlen($text) <= $length) return trim($text);
  // is $break present between $limit and the end of the string? 
  if(false !== ($breakpoint = strpos($text, $break, $length))) { 
	if($breakpoint < strlen($text) - 1) { 
	  $trimmed = substr($text, 0, $breakpoint) . ' ' . $suffix; 
	} 
  } 
  return trim($trimmed); 
}

/**
 * SEARCH FUNCTION
 */
function site_search($search_query='') {
	global $__CMS_CONN__;
	
	//Get settings
	$min_wordlength = (int) Plugin::getSetting('min_wordlength', 'site_search');
	$max_terms_allowed = (int) Plugin::getSetting('max_terms_allowed', 'site_search');
	$title_weight = (int) Plugin::getSetting('title_weight', 'site_search');
	$meta_weight = (int) Plugin::getSetting('meta_weight', 'site_search');
	$short_desc_length = (int) Plugin::getSetting('short_desc_length', 'site_search');
	$results_perpage = (int) Plugin::getSetting('results_perpage', 'site_search');
	
	//Min. length a word must have before it can be searched for
	if (!isset($min_wordlength) || empty($min_wordlength)) $min_wordlength = 3;
	//Max. number of terms that can be searched for (boolean search)
	if (!isset($max_terms_allowed) || empty($max_terms_allowed)) $max_terms_allowed = 5;
	//Relative weight of sarch term found in title
	if (!isset($title_weight) || empty($title_weight)) $title_weight = 0.2; //equal to 20%
	//Relative weight of search term found in meta_keywords and meta_description together
	if (!isset($meta_weight) || empty($meta_weight)) $meta_weight = 0.1; //equal to 10%
	//Max. length of short description in search results
	if (!isset($short_desc_length) || empty($short_desc_length)) $short_desc_length = 135; 
	//No. of results to be shown on results page, used for pagination
	if (!isset($results_perpage) || empty($results_perpage)) $results_perpage = 10;
	
	$results = '';
	
	$uni_search_query = utf8_decode($search_query);
	//only allow normal charset plus some additonal special chars
	$allowed_extra_chars = 'ÀÁÂÃÄÅÆàáâãäåæÒÓÔÕÕÖØòóôõöøÈÉÊËèéêëðÇçÐÌÍÎÏìíîïÙÚÛÜùúûüÑñÞßÿý+-';
    
	//sanitize input $_POST['search']
	if (strlen($search_query) >= $min_wordlength &&  preg_match('#^[a-zA-Z0-9\x20'.$allowed_extra_chars.']+$#i', $uni_search_query)) {
		$searchfor = trim($search_query);
		if (get_magic_quotes_gpc()) { 
			$searchfor = stripslashes($searchfor); 
		}
		$do_search = true;
	} else {
		echo __('Please enter a valid search term. It should have at least '.$min_wordlength.' characters and should not contain special characters.');
		$do_search = false;
	}

	if ($do_search == true) {
		
		$terms = explode(' ', strtolower($searchfor));
		$count_terms = count($terms);
		$sql_terms = $sql_keywords = $searchfor_new = $boolean = '';
		$max_score = 0;
		
		if ($count_terms > 1) {

		    //we have more than one word to search for (allow only limited separate terms)!!
			if ($count_terms > $max_terms_allowed) { $count_terms = $max_terms_allowed; }
			for ($i = 0; $i < $count_terms; $i++) {

				//see if search term beginns with a plus and assign a boolean to each word accordingly
				if (substr($terms[$i], 0, 1) == "+") {
					$boolean = 'AND';
					$term_value = substr($terms[$i],1);
				} else {
					$boolean = 'OR';
					$term_value = $terms[$i];
				}
				
				$sql_keywords[$term_value] = $boolean;
			}
			
			foreach ($sql_keywords as $sql_keyword => $sql_boolean) {	
				
				//only add words longer than specific char. count to the query
				if (strlen($sql_keyword) >= $min_wordlength) {
					$sql_terms .= " $sql_boolean (content.content LIKE '%".$sql_keyword."%'
							  OR meta.title LIKE '%".$sql_keyword."%'
							  OR meta.description LIKE '%".$sql_keyword."%'
							  OR meta.keywords LIKE '%".$sql_keyword."%')";
					$searchfor_new .= $sql_keyword.'|';
				}		
			}
			
			$trim_boolean = (strlen($boolean)+1);
			$sql_terms = substr($sql_terms, $trim_boolean); //get rid of first boolean
			$searchfor_new = substr($searchfor_new, 0, -1); //trim last delimiter
			
		} else {
			$searchfor_new = $searchfor;
			//ok, we only have one search word
			$sql_terms = "(content.content LIKE '%".$searchfor."%'
						  OR meta.title LIKE '%".$searchfor."%'
						  OR meta.description LIKE '%".$searchfor."%'
						  OR meta.keywords LIKE '%".$searchfor."%')";
		}

		//get all content which comes into question, this may be more than is need because 
		//it has html and php tags in it which may contain the search term
		//we have to get rid of such content later on.
		$sql_content = "SELECT DISTINCT
						  meta.id, meta.title, meta.description, meta.keywords, content.content 
						FROM 
						  ".TABLE_PREFIX."page AS meta
						LEFT JOIN ".TABLE_PREFIX."page_part AS content
						ON meta.id = content.page_id
						WHERE 
						  content.name LIKE 'body'
						  AND meta.is_protected = 0 
						  AND meta.needs_login != 1
						  AND meta.status_id IN (100,200)
						  AND $sql_terms
						  AND content.name LIKE 'body'
						  AND meta.is_protected = 0 
						  AND meta.needs_login != 1
						  AND meta.status_id IN (100,200)";

		//echo "$sql_content";
		
		$stmt = $__CMS_CONN__->prepare($sql_content);
		$stmt->execute();

		while ($row = $stmt->fetchObject()) {	

			//set some variables
			$content_score = $meta_score = $title_score = $final_score = $total_score = 0;

			//get rid of any php from content
			$php_search = array('/<\?((?!\?>).)*\?>/s'); 
			$no_php = preg_replace($php_search, '', $row->content); //get rid of php
			$no_tags = strip_tags($no_php); //get rid of html tags			
				
			$clean_content = preg_replace('/\s\s+/', ' ', $no_tags); //get rid of white spaces
			$clean_meta = strip_tags($row->description).' '.strip_tags($row->keywords);
			$clean_title = strip_tags($row->title);

			//get scoring for title
			if (preg_match_all("/$searchfor_new/i", $clean_title, $null)) {
				$title_score += preg_match_all("/$searchfor_new/i", $clean_title, $null);
			}

			//get scoring for the meta content (e.g. description + keywords)
			if (preg_match_all("/$searchfor_new/i", $clean_meta, $null)) {
				$meta_score += preg_match_all("/$searchfor_new/i", $clean_meta, $null);
			}

			//now get the ids which have the search term we are looking for
			if (preg_match_all("/$searchfor_new/i", $clean_content, $null)) {	
				$content_score += preg_match_all("/$searchfor_new/i", $clean_content, $null);
			}

			//now calculate total score in % taking weight of title and meta into account
			$total_score = ($title_score * $title_weight) + ($meta_score * $meta_weight) + $content_score;

			//find out the highest total score and asign it to max_score
			if ($total_score > $max_score) {$max_score = $total_score;}

			//convert to percent if a match was found
			if ($max_score > 0) {
				$final_score = number_format(($total_score / $max_score) * 100, 2);
				$short_desc = site_search_truncate(strip_tags($row->description), $short_desc_length);
				if ($final_score >= 2) { //a score under 2% is not relevant
					$results[$row->id] = array('score' => $final_score, 'desc' => $short_desc);
					arsort($results); //sort, best score first
				}
			}
		}
	}

	//do a last check to see if the array really contains results
	if (empty($results) && $do_search == true) {
		echo __('Sorry, no results found.');
	}
	return $results;
}
