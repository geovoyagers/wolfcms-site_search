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

class SiteSearchController extends PluginController {

    public function __construct() {
        $this->setLayout('backend');
        $this->assignToLayout('sidebar', new View('../../plugins/site_search/views/sidebar'));
    }

    public function index() {
        $this->documentation();
		$this->settings();
    }

    public function documentation() {
        $this->display('site_search/views/documentation');
    }

    function settings() {
        $tmp = Plugin::getAllSettings('site_search');				 
		$settings = array('min_wordlength' => $tmp['min_wordlength'],
                  'max_terms_allowed' => $tmp['max_terms_allowed'],
                  'title_weight' => $tmp['title_weight'],
                  'meta_weight' => $tmp['meta_weight'],
				  'short_desc_length' => $tmp['short_desc_length'],
				  'results_perpage' => $tmp['results_perpage']
        );
				 
        $this->display('site_search/views/settings', $settings);;
    }
	
	function save() {
        if (isset($_POST['settings'])) {
            $settings = $_POST['settings'];
            foreach ($settings as $key => $value) {
                $settings[$key] = mysql_escape_string($value);
            }
            
            $ret = Plugin::setAllSettings($settings, 'site_search');

            if ($ret) {
                Flash::set('success', __('The settings have been saved.'));
            }
            else {
                Flash::set('error', 'An error occured trying to save the settings.');
            }
        }
        else {
            Flash::set('error', 'Could not save settings, no settings found.');
        }

        redirect(get_url('plugin/site_search/settings'));
    }

}