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
<h1><?php echo __('Settings'); ?></h1>

<form action="<?php echo get_url('plugin/site_search/save'); ?>" method="post">
    <fieldset style="padding: 0.5em;">
        <legend style="padding: 0em 0.5em 0em 0.5em; font-weight: bold;"><?php echo __('Search function settings'); ?></legend>
        <table class="fieldset" cellpadding="0" cellspacing="0" border="0">
            <tr>
                <td class="label"><label for="min_wordlength"><?php echo __('Min. word length'); ?>: </label></td>
                <td class="field">
					<select name="settings[min_wordlength]" id="min_wordlength">
						<option value="3" <?php if($min_wordlength == "3") echo 'selected ="";' ?>>3</option>
						<option value="4" <?php if($min_wordlength == "4") echo 'selected ="";' ?>>4</option>
						<option value="5" <?php if($min_wordlength == "5") echo 'selected ="";' ?>>5</option>
						<option value="6" <?php if($min_wordlength == "6") echo 'selected ="";' ?>>6</option>
						<option value="7" <?php if($min_wordlength == "7") echo 'selected ="";' ?>>7</option>
						<option value="8" <?php if($min_wordlength == "8") echo 'selected ="";' ?>>8</option>
						<option value="9" <?php if($min_wordlength == "9") echo 'selected ="";' ?>>9</option>
						<option value="10" <?php if($min_wordlength == "10") echo 'selected ="";' ?>>10</option>
					</select>
                </td>
                <td class="help"><?php echo __('Minimum char. length that a search term must have, before a search is carried out or not be ignored.'); ?></td>
            </tr>
			<tr>
                <td class="label"><label for="max_terms_allowed"><?php echo __('No. of terms allowed'); ?>: </label></td>
                <td class="field">
					<select name="settings[max_terms_allowed]" id="max_terms_allowed">
					    <option value="1" <?php if($max_terms_allowed == "1") echo 'selected ="";' ?>>1</option>
						<option value="2" <?php if($max_terms_allowed == "2") echo 'selected ="";' ?>>2</option>
						<option value="3" <?php if($max_terms_allowed == "3") echo 'selected ="";' ?>>3</option>
						<option value="4" <?php if($max_terms_allowed == "4") echo 'selected ="";' ?>>4</option>
						<option value="5" <?php if($max_terms_allowed == "5") echo 'selected ="";' ?>>5</option>
						<option value="6" <?php if($max_terms_allowed == "6") echo 'selected ="";' ?>>6</option>
						<option value="7" <?php if($max_terms_allowed == "7") echo 'selected ="";' ?>>7</option>
						<option value="8" <?php if($max_terms_allowed == "8") echo 'selected ="";' ?>>8</option>
						<option value="9" <?php if($max_terms_allowed == "9") echo 'selected ="";' ?>>9</option>
						<option value="10" <?php if($max_terms_allowed == "10") echo 'selected ="";' ?>>10</option>
					</select>
                </td>
                <td class="help"><?php echo __('Maximum number of terms that can be searched for. This setting relates to boolean search function.'); ?></td>
            </tr>
			<tr>
                <td class="label"><label for="title_weight"><?php echo __('Weight of title tag'); ?>: </label></td>
                <td class="field">
					<select name="settings[title_weight]" id="title_weight">
					    <option value="0.1" <?php if($title_weight == "0.1") echo 'selected ="";' ?>>10%</option>
						<option value="0.2" <?php if($title_weight == "0.2") echo 'selected ="";' ?>>20%</option>
						<option value="0.3" <?php if($title_weight == "0.3") echo 'selected ="";' ?>>30%</option>
						<option value="0.4" <?php if($title_weight == "0.4") echo 'selected ="";' ?>>40%</option>
						<option value="0.5" <?php if($title_weight == "0.5") echo 'selected ="";' ?>>50%</option>
						<option value="0.6" <?php if($title_weight == "0.6") echo 'selected ="";' ?>>60%</option>
						<option value="0.7" <?php if($title_weight == "0.7") echo 'selected ="";' ?>>70%</option>
						<option value="0.8" <?php if($title_weight == "0.8") echo 'selected ="";' ?>>80%</option>
						<option value="0.9" <?php if($title_weight == "0.9") echo 'selected ="";' ?>>90%</option>
						<option value="1" <?php if($title_weight == "1") echo 'selected ="";' ?>>100%</option>
					</select>
                </td>
                <td class="help"><?php echo __('Scoring weight of result, when search term is found in the title.'); ?></td>
            </tr>
			<tr>
                <td class="label"><label for="meta_weight"><?php echo __('Weight of meta tags'); ?>: </label></td>
                <td class="field">
					<select name="settings[meta_weight]" id="meta_weight">
					    <option value="0.1" <?php if($meta_weight == "0.1") echo 'selected ="";' ?>>10%</option>
						<option value="0.2" <?php if($meta_weight == "0.2") echo 'selected ="";' ?>>20%</option>
						<option value="0.3" <?php if($meta_weight == "0.3") echo 'selected ="";' ?>>30%</option>
						<option value="0.4" <?php if($meta_weight == "0.4") echo 'selected ="";' ?>>40%</option>
						<option value="0.5" <?php if($meta_weight == "0.5") echo 'selected ="";' ?>>50%</option>
						<option value="0.6" <?php if($meta_weight == "0.6") echo 'selected ="";' ?>>60%</option>
						<option value="0.7" <?php if($meta_weight == "0.7") echo 'selected ="";' ?>>70%</option>
						<option value="0.8" <?php if($meta_weight == "0.8") echo 'selected ="";' ?>>80%</option>
						<option value="0.9" <?php if($meta_weight == "0.9") echo 'selected ="";' ?>>90%</option>
						<option value="1" <?php if($meta_weight == "1") echo 'selected ="";' ?>>100%</option>
					</select>
                </td>
                <td class="help"><?php echo __('Scoring weight of result, when search term is found in the meta description or meta keywords tag.'); ?></td>
            </tr>
			<tr>
                <td class="label"><label for="short_desc_length"><?php echo __('Short description length'); ?>: </label></td>
                <td class="field">
					<input type="text" name="settings[short_desc_length]" id="short_desc_length" maxlength="4" value="<?php echo $short_desc_length; ?>" />
                </td>
                <td class="help"><?php echo __('Char. length of short description of each result, shown on search result page.'); ?></td>
            </tr>
			<tr>
                <td class="label"><label for="results_perpage"><?php echo __('Results per page'); ?>: </label></td>
                <td class="field">
					<select name="settings[results_perpage]" id="results_perpage">
					    <option value="5" <?php if($results_perpage == "5") echo 'selected ="";' ?>>5</option>
					    <option value="10" <?php if($results_perpage == "10") echo 'selected ="";' ?>>10</option>
						<option value="20" <?php if($results_perpage == "20") echo 'selected ="";' ?>>20</option>
						<option value="30" <?php if($results_perpage == "30") echo 'selected ="";' ?>>30</option>
						<option value="40" <?php if($results_perpage == "40") echo 'selected ="";' ?>>40</option>
						<option value="50" <?php if($results_perpage == "50") echo 'selected ="";' ?>>50</option>
						<option value="60" <?php if($results_perpage == "60") echo 'selected ="";' ?>>60</option>
						<option value="70" <?php if($results_perpage == "70") echo 'selected ="";' ?>>70</option>
						<option value="80" <?php if($results_perpage == "80") echo 'selected ="";' ?>>80</option>
						<option value="90" <?php if($results_perpage == "90") echo 'selected ="";' ?>>90</option>
						<option value="100" <?php if($results_perpage == "100") echo 'selected ="";' ?>>100</option>
					</select>
                </td>
                <td class="help"><?php echo __('Number of results to return per page on search results page.'); ?></td>
            </tr>
        </table>
    </fieldset>

    <p class="buttons">
        <input class="button" name="commit" type="submit" accesskey="s" value="<?php echo __('Save'); ?>" />
    </p>
</form>

<script type="text/javascript">
// <![CDATA[
    function setConfirmUnload(on, msg) {
        window.onbeforeunload = (on) ? unloadMessage : null;
        return true;
    }

    function unloadMessage() {
        return '<?php echo __('You have modified this page. If you navigate away from this page without first saving your data, the changes will be lost.'); ?>';
    }

    $(document).ready(function() {
        // Prevent accidentally navigating away
        $(':input').bind('change', function() { setConfirmUnload(true); });
        $('form').submit(function() { setConfirmUnload(false); return true; });
    });
// ]]>
</script>