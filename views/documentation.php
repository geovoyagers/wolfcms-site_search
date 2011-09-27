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
 
?>
<style type="text/css">
#documentation li, #documentation p {
  font-size: 0.8em;
  line-height: 1.6em;
  list-style: disc;
  margin-top:0;
}
#documentation ul, #documentation ol {
  margin-left: 25px;
}
#documentation span {
  letter-spacing: 0.3em;
}
#documentation pre {
  padding:5px;
  background:#eeffee;
  margin-bottom:10px;
}
#documentation h4 {
  color: #999;
  font-size: 1em;
  font-weight:bold;
}
#documentation small {
  font-size:0.7em;
  padding-top:5px;
}
</style>
<h1><?php echo __('Documentation'); ?></h1>
<div id="documentation">
<h3>How to use, after installation</h3>
<p>After the plugin has been installed successfully, you will find two new snippets called <b>site-search-form</b> and <b>site-search-results</b></p>
<h4>Step 1:</h4>
<p>To use, create a new page called for the search results. You may set the title of the page to anything you like but the page slug should be called <b>search-results</b> (at least if you want to get the plugin working out of the box. Set its status to hidden and include the search-results snippet in the body of that page, using the following code:<br />
<pre>&lt;?php $this-&gt;includeSnippet('site-search-results'); ?&gt;</pre>
<h4>Step 2:</h4>
<p>Integrate the search form snippet where ever you want the search form to appear on your site (a sidebar in the main layout is a good idea).</p>
<pre>&lt;?php $this-&gt;includeSnippet('site-search-form'); ?&gt;</pre> 
<br />
<h3>Recommended styles to add</h3>
<p>In order for the pagination on the search results page to look nice, I recommend to add the following styles to you main site css. It's only a recommendation, you can of course do it, and/or change it any way you like. Important is to get the "li" tags floating left.</p>
<pre>
  /* Paging */
  #paginator {
    font-size:0.8em;
    overflow:auto;
    padding:4px;
  }
	
  .pageselected {
    font-size:1.1em;
    font-weight:bold;
    color:#ddd;
    background-color:#555;
    border:1px solid #666 !important;
    padding:1px 3px 1px 2px !important;
    margin:0 2px 0 2px !important;
  }

  #paginator li, .pageselected {
    font-size:1.1em;
    line-height: 1.4em;
    border:1px solid #a6a6a6;
    padding:1px 6px 0px 5px !important;
    margin:0 7px 0 0!important;
    list-style-type:none !important;
    float:left;
    display:block;
  }
  
  a:hover.page {
    color:#444;
    background:#f0f0f0;
  }
</pre>
<br />
<h3>Pagination with "mod_rewrite" enabled</h3>
<p>The script will detect if you have mod_rewrite enabled and change the pagination links accordingly. You will most likely have to adjust you mod_rewrite condition to match, the parameters the search script is expecting. Here, a suitable mod_rewrite syntax for Lighttpd:</p>
<pre>
 url.rewrite-once = (
    "^/search-results/([0-9]+)/(.*)$" => "/index.php?WOLFPAGE=search-results&p=$1&q=$2",	
 )
 url.rewrite-if-not-file = (
    "^/(.*)$" => "/index.php?WOLFPAGE=$1"
 )
</pre>
<p>If you have renamed the search results page to anything other than "search-results" you will need to change the syntax above accordingly. The same applies to the snipped code of the site-search-form.</p>
<br />
<hr />
<h3>General things to know</h3>
<ul>
<li>The plugin will not search comments, if the comment plugin is installed.</li>
<li>The plugin will not search hidden, protected pages, or pages requiring a login.</li>
<li>The plugin will search the title, meta description and meta keywords as well as the full content of each page.</li>
<li>Any PHP or HTML or other scripting that is present in the content body, is ignored by the search function.</li>
<li>Any result that has a relevancy of less than  2% is intentionally not shown.</li>
</ul>
<br />
<h3>Boolean function</h3>
<ul>
<li>To use the Boolean function add a + in front of the succeeding search terms, e.g. if you want to search for "honey and bees" enter "honey +bees" without quotes.</li>
<li>The Boolean function current does not support, search like "honey and bees and NOT flowers", e.g. a search like "honey +bees -flowers" is interpreted as "honey and bees or flowers"</li>
<li>If no Booleans are used, searching for "honey bees" is like searching for "honey OR bees"</li>
</ul>
<br />
<h3>International language support</h3>
<ul>
<li>Theoretically, the search function will do a full UTF-8 search, however for security reason the entry of UTF-8 characters has been limited.</li>
<li>The following special characters can be used in a search term:<br/><span>ÀÁÂÃÄÅÆàáâãäåæÒÓÔÕÕÖØòóôõöøÈÉÊËèéêëðÇçÐÌÍÎÏìíîïÙÚÛÜùúûüÑñÞßÿý+-</span></li>
<li>Because of the above restrictions the search function will not work with Russian or Chinese language website unless, the special character list is adapted to allow for this. This is planned at some later time.</li>
</ul>
<br />
<h3>Tested with</h3>
<ul>
<li>Lighttpd 1.4.26, PHP Version 5.3.3, MySQL, on Ubuntu</li>
<li>Lighttpd 1.4.28 and PHP Version 5.3.6, MySQL on Debian</li>
<li>Apache2 and PHP Version 5.3.6 , MySQL and PostgreSQL</li>
</ul>
<br/>
<hr />
<small>Version 1.0.0, 20.08.2011, Tina Keil &lt;seven@geovoyagers.de&gt;</small>
</div>

