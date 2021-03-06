<?php
/*
Plugin Name: WP-Piwik

Plugin URI: http://wordpress.org/extend/plugins/wp-piwik/

Description: Adds Piwik stats to your dashboard menu and Piwik code to your wordpress header.

Version: 0.10.RC1
Author: Andr&eacute; Br&auml;kling
Author URI: http://www.braekling.de

****************************************************************************************** 
	Copyright (C) 2009-2014 Andre Braekling (email: webmaster@braekling.de)

	This program is free software: you can redistribute it and/or modify
	it under the terms of the GNU General Public License as published by
	the Free Software Foundation, either version 3 of the License, or
	at your option) any later version.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

	You should have received a copy of the GNU General Public License
	along with this program.  If not, see <http://www.gnu.org/licenses/>.
*******************************************************************************************/

if (!function_exists ('add_action')) {
	header('Status: 403 Forbidden');
	header('HTTP/1.1 403 Forbidden');
	exit();
}

function wp_piwik_autoloader($class) {
	if (substr($class, 0, 9) == 'WP_Piwik_') {
		$class = str_replace('.', '', str_replace('_', '/',substr($class, 9)));
		require_once('classes/WP_Piwik/'.$class.'.php');
	}
}

function wp_piwik_phperror($class) {
	echo '<div class="error"><p>';
	printf(__('WP-Piwik requires at least PHP 5.3. You are using the deprecated version %s. Please update PHP to use WP-Piwik.', 'wp-piwik'), PHP_VERSION);
	echo '</p></div>';
}

load_plugin_textdomain('wp-piwik', false, 'wp-piwik'.DIRECTORY_SEPARATOR.'languages'.DIRECTORY_SEPARATOR);

if (version_compare(PHP_VERSION, '5.3.0', '<')) 
	add_action('admin_notices', 'wp_piwik_phperror');
else {
	define('WP_PIWIK_PATH', dirname(__FILE__).DIRECTORY_SEPARATOR);
	require_once(WP_PIWIK_PATH.'config.php');
	require_once(WP_PIWIK_PATH.'classes'.DIRECTORY_SEPARATOR.'WP_Piwik.php');
	spl_autoload_register('wp_piwik_autoloader');
	if (class_exists('WP_Piwik'))
		$GLOBALS['wp_piwik'] = new WP_Piwik();
}