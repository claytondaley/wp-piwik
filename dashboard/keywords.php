<?php
/*********************************
	WP-Piwik::Stats:Keywords
**********************************/

	$aryConf['data'] = $this->call_API(
		'Referers.getKeywords',
		$aryConf['params']['period'],
		$aryConf['params']['date'],
		$aryConf['params']['limit']
	);
	$aryConf['title'] = __('Keywords', 'wp-piwik');
	include('header.php');
/***************************************************************************/ ?>
<table class="widefat">
	<thead>
		<tr><th><?php _e('Keyword', 'wp-piwik'); ?></th><th><?php _e('Unique', 'wp-piwik'); ?></th></tr>
	</thead>
	<tbody>
<?php /************************************************************************/
	foreach ($aryConf['data'] as $aryValues)
		echo '<tr><td>'.$aryValues['label'].'</td><td>'.$aryValues['nb_uniq_visitors'].'</td></tr>';
/***************************************************************************/ ?>
	</tbody>
</table>
<?php /************************************************************************/
include ('footer.php');

/* EOF */
