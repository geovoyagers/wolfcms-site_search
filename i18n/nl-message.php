<?php

    /**
     * Dutch language file for search plugin
     * Translation version 1.0.0
     *
     * @package Plugins
     * @subpackage site_search
     *
     * @author Fortron
     * @version Wolf 0.7.5
     */

    //Get settings
    $min_wordlength = (int) Plugin::getSetting('min_wordlength', 'site_search');
    if (!isset($min_wordlength) || empty($min_wordlength)) $min_wordlength = 3;
    
    return array(
    'Site search' => 'Site doorzoeken',
    'Search plugin' => 'Zoek-Plugin',
    'Provides a basic search function with boolean support' => 'Bied eenvoudige zoek functionaliteit met boolean ondersteuning',
    'Search function settings' => 'Instellingen zoekfunctie',
    'The search plugin allows you to integrate a basic search function with boolean support.' => 'De zoek plugin bied eenvoudige zoek functionaliteit met boolean ondersteuning.',
    'See documentation for further details and use.' => 'Lees de documentatie voor verdere details en gebruik.',
    'Min. word length' => 'Min. Lengte zoekwoord',
    'No. of terms allowed' => 'Max. Aantal zoektermen',
    'Weight of title tag' => 'Gewicht van Titel tags',
    'Weight of meta tags' => 'Gewicht van Meta tags',
    'Short description length' => 'Lengte van korte beschrijving',
    'Minimum char. length that a search term must have, before a search is carried out or not be ignored.' => 
    'Minimaal aantal karakters voor de zoekterm, voordat het zoeken word uitgevoerd.',
    'Maximum number of terms that can be searched for. This setting relates to boolean search function.' =>
    'Maximaal aantal termen waarop word gezocht. Deze instelling is gerelateerd aan de boolean zoek functie.',
    'Scoring weight of result, when search term is found in the title.' => 'Gewicht van het resultaat, wanneer de zoekterm in de titel is gevonden.',
    'Scoring weight of result, when search term is found in the meta description or meta keywords tag.' => 'Gewicht van het resultaat, wanneer de zoekterm in de meta beschrijving of meta sleutelwoorden is gevonden.',
    'Char. length of short description of each result, shown on search result page.' => 'Maximale karakterlengte van de korte beschrijving bij ieder resultaat, zoals weergegeven op de zoek resultaten pagina.',
    'Please enter a valid search term. It should have at least '.$min_wordlength.' characters and should not contain special characters.' => 'Voer a.u.b. een geldige zoekopdracht in. Deze dient minstens uit '.$min_wordlength.' karakters te bestaan en mag geen speciale tekens bevatten.',
    'Sorry, no results found.' => 'Uw zoekopdracht leverde geen resultaten op.',
    'Support of logical operators (Booleans)' => 'Ondersteuning voor logische operatoren (Booleaanse)',
    'Number of results to return per page on search results page.' => 'Aantal resultaten per pagina op de zoekresulaten pagina.',
    'Results per page' => 'Resulaten per pagina',
    );