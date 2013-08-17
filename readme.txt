== WHAT IT IS ==

This search plugin provides the following features:

- Basic search function with boolean support for Wolf CMS
- Settings page in the admin area
- Integrated pagination of results page
- Snippets for results page and search form
- Searches title, meta description, meta keywords and content
- Scores results with weighting of title and meta tags
- Provides basic support for UTF-8 (e.g. umlauts and accents are accepted)
- Built-in pagination supports "mod_rewrite", if enabled

== HOW TO USE IT ==

* To use the settings and documentation pages, you will first need to enable 
  the plugin!
* Two new snippets, called site-search-form and site-search-results are 
  created when you enable the plugin. 
  
  1) To use, create a new page called search-results, set its status to hidden 
     and inlcude the following snippet in the body of that page, e.g.
     <?php $this->includeSnippet('site-search-results'); ?>
	 
  2) Integrate the search form snippet in the sidebar of that page
     or where ever you want the search form to appear on your site, e.g.
     <?php $this->includeSnippet('site-search-form'); ?>
	 
* Read the documentation on the plugin page, for explantions how certain
  features and settings work.

== TO DO ==

- Improve pagination
- Expand language support
- If comment plugin is installed, also enable search of comments

== CHANGELOG ==

Version 1.0.2, 18/08/2013
- added en-message.php
- added it-message.php
- small typo fix in update.php

Version 1.0.1, 27/09/2011
- Site_search plugin now supports sqlite
- Moved texts from result-snippet to language file
- Fixed wrong error message if search term is too short
- Settings tab in backend displayed first now

Version 1.0.0, 20/08/2011
- First release

== NOTES ==

* When you disable the search plugin, the snippets stay available.

* Do not forget to remove the code you added to your page(s) if you delete the
  search plugin from your system. If you want to reinstall delete the 
  search snippets manually first.

== LICENSE ==

Copyright 2008-2009, Martijn van der Kleijn. <martijn.niji@gmail.com>
Plugin Author, Tina Keil, <seven@geovoyagers.de>
This plugin is licensed under the GPLv3 License.
<http://www.gnu.org/licenses/gpl.html>
