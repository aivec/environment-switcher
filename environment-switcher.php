<?php

/**
 * Plugin Name: Aivec Environment Switcher
 * Description: Switch between development, staging, and production environments for integration testing.
 * Version: %%VERSION%%
 * Author: Aivec LLC.
 * Author URI: https://www.aivec.co.jp
 * License: GPL2
 * Text Domain: avces
 * Domain Path: /languages/
 *
 * @package Aivec
 */

use Aivec\Plugins\EnvironmentSwitcher\Options;
use Aivec\Plugins\EnvironmentSwitcher\SettingsPage;

define('AVCES', true);
load_plugin_textdomain('avces', false, plugin_basename(__DIR__) . '/languages');

require_once(__DIR__ . '/vendor/autoload.php');

SettingsPage::init();

/**
 * Returns options array
 *
 * @author Evan D Shaw <evandanielshaw@gmail.com>
 * @return array
 */
function avces_get_options() {
    return Options::getOptions();
}

/**
 * Returns the current setting for working environment
 *
 * @author Evan D Shaw <evandanielshaw@gmail.com>
 * @return string
 */
function avces_get_env() {
    return Options::getOptions()['env'];
}
