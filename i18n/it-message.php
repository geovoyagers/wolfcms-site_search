<?php

 /**
 * Italien language file for search plugin
 * Translated by Gestione Huma <gestione@huma.it>
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
	'Site search' => 'Cerca nel sito',
	'Search plugin' => 'Plugin di ricerca',
	'Provides a basic search function with boolean support' => 'Fornisce una funzione di ricerca di base con supporto booleano',
	'Search function settings' => 'Impostazioni funzioni di ricerca',
	'The search plugin allows you to integrate a basic search function with boolean support.' => 'Il Plugin ti permette di integrare una funzione di ricerca con supporto booleano.',
	'See documentation for further details and use.' => 'Consulta la guida per maggiori dettagli.',
	'Min. word length' => 'Lunghezza minima della parola',
	'No. of terms allowed' => 'Numero massimo di termini permessi',
	'Weight of title tag' => 'Larghezza del titolo Tag',
	'Weight of meta tags' => 'Larghezza del Meta Tags',
	'Short description length' => 'Lunghezza descrizione corta',
	'Minimum char. length that a search term must have, before a search is carried out or not be ignored.' => 'Lunghezza minima che un termine di ricerca deve avere, prima che la ricerca venga eseguita.',
	'Maximum number of terms that can be searched for. This setting relates to boolean search function.' => 'Numero massimo di termini che possono essere cercati. Questa impostazione si riferisce alla funzione di ricerca booleana',
	'Scoring weight of result, when search term is found in the title.' => 'Analizzando i risultati, quando il termine di ricerca viene trovato nel titolo.',
	'Scoring weight of result, when search term is found in the meta description or meta keywords tag.' => 'Analizzando i risultati, quando il termine di ricerca viene trovato nel meta keywords tag.',
	'Char. length of short description of each result, shown on search result page.' => 'Lunghezza caratteri della breve descrizione di ogni risultato, illustrato sulla pagina dei risultati.',
	'Please enter a valid search term. It should have at least '.$min_wordlength.' characters and should not contain special characters.' => 'Per favore inserisci un valido termine di ricerca. Deve avere almento '.$min_wordlength.' caratteri e non deve contenere caratteri speciali.',
	'Sorry, no results found.' => 'Nessun risultato trovato.',
	'Support of logical operators (Booleans)' => 'Supporto di operatori logici (Booleans)',
	'Number of results to return per page on search results page.' => 'Numero di risultati da restituire per ogni pagina, nella pagina dei risultati di ricerca',
	'Results per page' => 'Risultati per pagina',
	'Please enter a search term.' => 'Per favore inserisci un termine di ricerca.',
	'Displaying results' => 'Mostrando Risultati',
	'of' => 'di',
	'matches' => 'Risultati'
);
