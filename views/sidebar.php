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
 * @version 1.0.0
 * @since Wolf version 0.7.5
 * @license http://www.gnu.org/licenses/gpl.html GPL License
 * @copyright Tina Keil, 2011+
 */
 
?>
<p class="button"><a href="<?php echo get_url('plugin/site_search/documentation/'); ?>"><img src="<?php echo SEARCH_ROOT;?>/images/documentation.png" align="middle" alt="page icon" /> <?php echo __('Documentation'); ?></a></p>
<p class="button"><a href="<?php echo get_url('plugin/site_search/settings'); ?>"><img src="<?php echo SEARCH_ROOT;?>/images/settings.png" align="middle" alt="page icon" /> <?php echo __('Settings'); ?></a></p>
<div class="box">
<h2><?php echo __('Search plugin');?></h2>
<p>
<?php echo __('The search plugin allows you to integrate a basic search function with boolean support.')?>
</p>
<p>
<?php echo __('See documentation for further details and use.')?>
</p>
</div>
