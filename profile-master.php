<?php
/**
 * Plugin Name: Profile Master
 * Plugin URI: https://wordpress.org/plugins/profile-master/
 * Description: Profile master WordPress Plugin for Theme Color Set,FrontEnd Color Switcher,FrontEnd Sidebar Presentation.
 * Version: 2.0.2
 * Author: Rashid87
 * Text Domain: profile-master
 * Domain Path: /languages/
 * Author URI: http://mahfuzrashid.com/
 * License: GPLv2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 */


defined( 'ABSPATH' ) || exit;

$plugin_dir = plugin_dir_path(__FILE__);
defined('PROFILEMASTER_PLUGIN_DIR') || define('PROFILEMASTER_PLUGIN_DIR', $plugin_dir);
$plugin_url = plugins_url('profile-master') . '/';
defined('PROFILEMASTER_PLUGIN_URL') || define('PROFILEMASTER_PLUGIN_URL', $plugin_url);

include_once(PROFILEMASTER_PLUGIN_DIR . 'inc/enqueue.php');
include_once(PROFILEMASTER_PLUGIN_DIR . 'inc/admin-menu.php');
include_once(PROFILEMASTER_PLUGIN_DIR . 'inc/outputcolor.php');

?>