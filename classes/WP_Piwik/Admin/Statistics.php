<?php

	class WP_Piwik_Admin_Statistics extends WP_Piwik_Admin {

		public function show() {
			self::$wpPiwik->showStats();
		}
		
		public function printAdminScripts() {
			wp_enqueue_script('wp-piwik', self::$wpPiwik->getPluginURL().'js/wp-piwik.js', array(), self::$wpPiwik->getPluginVersion(), true);
			wp_enqueue_script('wp-piwik-jqplot', self::$wpPiwik->getPluginURL().'js/jqplot/wp-piwik.jqplot.js',array('jquery'), self::$wpPiwik->getPluginVersion());
		}
		
		public function extendAdminHeader() {
			echo '<!--[if IE]><script language="javascript" type="text/javascript" src="'.(self::$wpPiwik->getPluginURL()).'js/jqplot/excanvas.min.js"></script><![endif]-->';
			echo '<link rel="stylesheet" href="'.(self::$wpPiwik->getPluginURL()).'js/jqplot/jquery.jqplot.min.css" type="text/css"/>';
			echo '<script type="text/javascript">var $j = jQuery.noConflict();</script>';		
		}
		
		public function onLoad() {
			self::$wpPiwik->onloadStatsPage(self::$pageID);
		}
	}