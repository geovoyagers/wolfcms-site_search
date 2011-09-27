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
 
$PDO = Record::getConnection();

// Install snippet, named search-form
$PDO->exec("INSERT INTO ".TABLE_PREFIX."snippet (name, filter_id, content, content_html, created_on, created_by_id) VALUES ('site-search-form', '', '<!-- search form -->\r\n<div class=\"searchform\">\r\n  <form action=\"<?php echo BASE_URL; ?>search-results<?php echo URL_SUFFIX; ?>\" method=\"post\" accept-charset=\"UTF-8\">\r\n    <input type=\"text\" name=\"search\" value=\"\" maxlenght=\"150\" />\r\n    <input type=\"submit\" name=\"searchsubmit\" value=\"Search\" />\r\n  </form>\r\n</div>\r\n<!-- end search form -->\r\n', '<!-- search form -->\r\n<div class=\"searchform\">\r\n  <form action=\"<?php echo BASE_URL; ?>search-results<?php echo URL_SUFFIX; ?>\" method=\"post\" accept-charset=\"UTF-8\">\r\n    <input type=\"text\" name=\"search\" value=\"\" maxlenght=\"150\" />\r\n    <input type=\"submit\" name=\"searchsubmit\" value=\"Search\" />\r\n  </form>\r\n</div>\r\n<!-- end search form -->\r\n', '".date('Y-m-d H:i:s')."', 1)");

// Install snippet, named search-results
$PDO->exec("INSERT INTO ".TABLE_PREFIX."snippet (name, filter_id, content, content_html, created_on, created_by_id) VALUES ('site-search-results', '', '<!-- search results -->\r\n<div id=\"searchresults\">\r\n<?php\r\n\r\n  \$search_error_message = \"<p>\".__(''Please enter a search term.'').\"</p>\";\r\n\r\n  //search term is sanitized in search plugin, no need to do it here\r\n  \$cur_page = (int) (isset(\$_GET[''p'']) ? \$_GET[''p''] : 1);\r\n  \$get_search_term = (isset(\$_GET[''q'']) ? \$_GET[''q''] : '''');\r\n  \$post_search_term = (isset(\$_POST[''search'']) ? \$_POST[''search''] : '''');\r\n  \$results_perpage = (int) Plugin::getSetting(''results_perpage'', ''site_search'');\r\n  \$pages = ''''; \$count_pagecontent = 0; \$ol_start = 1;\r\n\r\n  if (empty(\$post_search_term) && \$cur_page >= 1) {\r\n     \$search_term = urldecode(\$get_search_term);\r\n  } else {\r\n     \$search_term = \$post_search_term;\r\n  }\r\n\r\n  if (isset(\$search_term) && !empty(\$search_term)) {\r\n\r\n    \$search_results = site_search(\$search_term);\r\n    \$num_searchresults = count(\$search_results);\r\n\r\n    if (\$search_results && \$num_searchresults > 0) {\r\n      \$pages = array_chunk(\$search_results, \$results_perpage, true);\r\n      \r\n      if (isset(\$pages[\$cur_page-1])) {\r\n\r\n        \$ol_start = ((\$cur_page-1) * \$results_perpage) + 1;\r\n        \$ol_end = (count(\$pages[\$cur_page-1]) + \$ol_start) - 1;\r\n          \r\n        echo ''<ol start=\"''.\$ol_start.''\">'';\r\n        echo \"<p><strong>\".__(''Displaying results'').'' ''.\$ol_start.'' - ''.\$ol_end.'' ''.__(''of'').'' ''.\$num_searchresults.'' ''.__(''matches'').\"</strong></p>\";\r\n        \r\n        foreach (\$pages[\$cur_page-1] as \$search_id => \$search_value) {\r\n          \$search_link = \$this->linkById((int)\$search_id);\r\n          \$search_url = \$this->urlById((int)\$search_id);\r\n          echo ''<li><span class=\"searchtitle\">[''.\$search_value[''score''].''%] ''.\$search_link.''</span><br />'';\r\n          if (!empty(\$search_value[''desc''])) {\r\n            echo ''<span class=\"searchdesc\">''.\$search_value[''desc''].''</span><br />'';\r\n          }\r\n          echo ''<span class=\"searchlink\">''.\$search_url.''</span></li>'';\r\n          \$count_pagecontent++;\r\n        }\r\n\r\n        echo ''</ol>'';\r\n      } else {\r\n        echo \$search_error_message;\r\n      }\r\n    }\r\n  } else {\r\n    echo \$search_error_message;\r\n  }\r\n?>\r\n</div>\r\n<!-- end search results -->\r\n\r\n<?php\r\n  //Pagination\r\n  if (\$pages && count(\$pages) > 1 && !empty(\$search_term) && \$count_pagecontent > 0) {\r\n    echo ''<div id=\"paginator\">'';\r\n    echo ''<ul>'';\r\n    for(\$page_num = 1; \$page_num < count(\$pages)+1; \$page_num++) {\r\n       if (\$cur_page == \$page_num) {\r\n         echo ''<li class=\"pageselected\">'';\r\n       } else {\r\n         echo ''<li>'';\r\n       }\r\n       if (USE_MOD_REWRITE == false) {\r\n         echo ''<a href=\"''.BASE_URL.CURRENT_URI.''?p=''.\$page_num.''&amp;q=''.urlencode(\$search_term).''\">''.\$page_num.''</a></li>'';\r\n       } else {\r\n         echo ''<a href=\"''.BASE_URL.CURRENT_URI.''/''.\$page_num.''/''.urlencode(\$search_term).''\">''.\$page_num.''</a></li>'';\r\n       }\r\n    }\r\n    echo ''</ul>'';\r\n    echo ''</div>'';\r\n  }\r\n?>', '<!-- search results -->\r\n<div id=\"searchresults\">\r\n<?php\r\n\r\n  \$search_error_message = \"<p>\".__(''Please enter a search term.'').\"</p>\";\r\n\r\n  //search term is sanitized in search plugin, no need to do it here\r\n  \$cur_page = (int) (isset(\$_GET[''p'']) ? \$_GET[''p''] : 1);\r\n  \$get_search_term = (isset(\$_GET[''q'']) ? \$_GET[''q''] : '''');\r\n  \$post_search_term = (isset(\$_POST[''search'']) ? \$_POST[''search''] : '''');\r\n  \$results_perpage = (int) Plugin::getSetting(''results_perpage'', ''site_search'');\r\n  \$pages = ''''; \$count_pagecontent = 0; \$ol_start = 1;\r\n\r\n  if (empty(\$post_search_term) && \$cur_page >= 1) {\r\n     \$search_term = urldecode(\$get_search_term);\r\n  } else {\r\n     \$search_term = \$post_search_term;\r\n  }\r\n\r\n  if (isset(\$search_term) && !empty(\$search_term)) {\r\n\r\n    \$search_results = site_search(\$search_term);\r\n    \$num_searchresults = count(\$search_results);\r\n\r\n    if (\$search_results && \$num_searchresults > 0) {\r\n      \$pages = array_chunk(\$search_results, \$results_perpage, true);\r\n      \r\n      if (isset(\$pages[\$cur_page-1])) {\r\n\r\n        \$ol_start = ((\$cur_page-1) * \$results_perpage) + 1;\r\n        \$ol_end = (count(\$pages[\$cur_page-1]) + \$ol_start) - 1;\r\n          \r\n        echo ''<ol start=\"''.\$ol_start.''\">'';\r\n        echo \"<p><strong>\".__(''Displaying results'').'' ''.\$ol_start.'' - ''.\$ol_end.'' ''.__(''of'').'' ''.\$num_searchresults.'' ''.__(''matches'').\"</strong></p>\";\r\n        \r\n        foreach (\$pages[\$cur_page-1] as \$search_id => \$search_value) {\r\n          \$search_link = \$this->linkById((int)\$search_id);\r\n          \$search_url = \$this->urlById((int)\$search_id);\r\n          echo ''<li><span class=\"searchtitle\">[''.\$search_value[''score''].''%] ''.\$search_link.''</span><br />'';\r\n          if (!empty(\$search_value[''desc''])) {\r\n            echo ''<span class=\"searchdesc\">''.\$search_value[''desc''].''</span><br />'';\r\n          }\r\n          echo ''<span class=\"searchlink\">''.\$search_url.''</span></li>'';\r\n          \$count_pagecontent++;\r\n        }\r\n\r\n        echo ''</ol>'';\r\n      } else {\r\n        echo \$search_error_message;\r\n      }\r\n    }\r\n  } else {\r\n    echo \$search_error_message;\r\n  }\r\n?>\r\n</div>\r\n<!-- end search results -->\r\n\r\n<?php\r\n  //Pagination\r\n  if (\$pages && count(\$pages) > 1 && !empty(\$search_term) && \$count_pagecontent > 0) {\r\n    echo ''<div id=\"paginator\">'';\r\n    echo ''<ul>'';\r\n    for(\$page_num = 1; \$page_num < count(\$pages)+1; \$page_num++) {\r\n       if (\$cur_page == \$page_num) {\r\n         echo ''<li class=\"pageselected\">'';\r\n       } else {\r\n         echo ''<li>'';\r\n       }\r\n       if (USE_MOD_REWRITE == false) {\r\n         echo ''<a href=\"''.BASE_URL.CURRENT_URI.''?p=''.\$page_num.''&amp;q=''.urlencode(\$search_term).''\">''.\$page_num.''</a></li>'';\r\n       } else {\r\n         echo ''<a href=\"''.BASE_URL.CURRENT_URI.''/''.\$page_num.''/''.urlencode(\$search_term).''\">''.\$page_num.''</a></li>'';\r\n       }\r\n    }\r\n    echo ''</ul>'';\r\n    echo ''</div>'';\r\n  }\r\n?>', '".date('Y-m-d H:i:s')."', 1)");

// Store settings new style
$settings = array('min_wordlength' => '4',
                  'max_terms_allowed' => '5',
                  'title_weight' => '0.2',
                  'meta_weight' => '0.1',
                  'short_desc_length' => '135',
                  'results_perpage' => '10'
                 );

Plugin::setAllSettings($settings, 'site_search');

exit();