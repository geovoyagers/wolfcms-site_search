<?php

    /**
     * English language file for search plugin
     * Translation version 1.0.1
     *
     * @package Plugins
     * @subpackage site_search
     *
     * @author Fortron
     * @version Wolf 0.7.7
     */

    //Get settings
    $min_wordlength = (int) Plugin::getSetting('min_wordlength', 'site_search');
    if (!isset($min_wordlength) || empty($min_wordlength)) $min_wordlength = 3;
    
    return array(
    'Site search' => 'Site search',
    'Search plugin' => 'Search plugin',
    'Provides a basic search function with boolean support' => 'Provides a basic search function with boolean support',
    'Search function settings' => 'Search function settings',
    'The search plugin allows you to integrate a basic search function with boolean support.' => 'The search plugin allows you to integrate a basic search function with boolean support.',
    'See documentation for further details and use.' => 'See documentation for further details and use.',
    'Min. word length' => 'Min. word length',
    'No. of terms allowed' => 'No. of terms allowed',
    'Weight of title tag' => 'Weight of title tag',
    'Weight of meta tags' => 'Weight of meta tags',
    'Short description length' => 'Short description length',
    'Minimum char. length that a search term must have, before a search is carried out or not be ignored.' => 
    'Minimum char. length that a search term must have, before a search is carried out or not be ignored.',
    'Maximum number of terms that can be searched for. This setting relates to boolean search function.' =>
    'Maximum number of terms that can be searched for. This setting relates to boolean search function.',
    'Scoring weight of result, when search term is found in the title.' => 'Scoring weight of result, when search term is found in the title.',
    'Scoring weight of result, when search term is found in the meta description or meta keywords tag.' => 'Scoring weight of result, when search term is found in the meta description or meta keywords tag.',
    'Char. length of short description of each result, shown on search result page.' => 'Char. length of short description of each result, shown on search result page.',
    'Please enter a search term.' => 'Please enter a search term.',
    'Please enter a valid search term. It should have at least '.$min_wordlength.' characters and should not contain special characters.' => 'Please enter a valid search term. It should have at least '.$min_wordlength.' characters and should not contain special characters.',
    'Sorry, no results found.' => 'Sorry, no results found.',
    'Support of logical operators (Booleans)' => 'Support of logical operators (Booleans)',
    'Number of results to return per page on search results page.' => 'Number of results to return per page on search results page.',
    'Results per page' => 'Results per page',
    'Displaying results' => 'Displaying results',
    'of' => 'of',
    'matches' => 'matches'
    );
