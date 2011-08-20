<?php

    /**
     * German language file for search plugin
	 * Translation version 1.0.0
     *
     * @package Plugins
     * @subpackage site_search
     *
     * @author Tina Keil <seven@geovoyagers.de>
     * @version Wolf 0.7.5
     */

	//Get settings
	$min_wordlength = (int) Plugin::getSetting('min_wordlength', 'site_search');
	if (!isset($min_wordlength) || empty($min_wordlength)) $min_wordlength = 3;
	
    return array(
    'Site search' => 'Site Suche',
	'Search plugin' => 'Such-Plugin',
	'Provides a basic search function with boolean support' => 'Ermöglicht die Integration einer einfachen Suchfunktion mit boolescher Unterstützung.',
	'Search function settings' => 'Einstellungen der Suchfunktion',
	'The search plugin allows you to integrate a basic search function with boolean support.' => 'Das Such-Plugin ermöglicht die Integration einer einfachen Suchfunktion mit boolescher Unterstützung.',
	'See documentation for further details and use.' => 'Siehe Dokumentation für weitere Informationen und Hinweise zur Verwendung.',
	'Min. word length' => 'Min. Länge Suchwort',
	'No. of terms allowed' => 'Max. Anzahl Suchwörter',
	'Weight of title tag' => 'Gewichtung Titel Tag',
	'Weight of meta tags' => 'Gewichtung Meta Tags',
	'Short description length' => 'Länge Beschreibung',
	'Minimum char. length that a search term must have, before a search is carried out or not be ignored.' => 'Minimale Zeichenlänge, die ein Suchbegriff haben muss, um die Suche zu starten bzw. um nicht ignoriert zu werden.',
	'Maximum number of terms that can be searched for. This setting relates to boolean search function.' => 'Maximale Anzahl der Suchbegriffe nach denen gesucht werden darf. Die Einstellung beziehtsich auf die Boolean Suchfunktion.',
	'Scoring weight of result, when search term is found in the title.' => 'Gewichtung des Ergebnisses, wenn der Suchbegriff im Titel gefunden wird.',
	'Scoring weight of result, when search term is found in the meta description or meta keywords tag.' => 'Gewichtung des Ergebnisses, wenn der Suchbegriff in den Meta-Tags gefunden wird.',
	'Char. length of short description of each result, shown on search result page.' => 'Maximale Zeichenlänge der Kurzbeschreibung, die in den Suchergebnissen angezeigt wird.',
	'Please enter a valid search term. It should have at least '.$min_wordlength.' characters and should not contain special characters.' => 'Bitte geben Sie einen gültigen Suchbegriff ein. Dieser sollte mindestens '.$min_wordlength.' Zeichen lang sein und darf keine Sonderzeichen enthalten.',
	'Sorry, no results found.' => 'Leider wurden keine passenden Ergebnisse gefunden.',
	'Support of logical operators (Booleans)' => 'Unterstützung von logischen Verknüpfungsfunktionen (Boolesche)',
	'Number of results to return per page on search results page.' => 'Anzahl der Ergebnisse, die pro Seite auf der Suchergebnis-Seite angezeigt werden sollen.',
	'Results per page' => 'Ergebnisse pro Seite',
    );
