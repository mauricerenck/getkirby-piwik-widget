<?php
return array(
	'title' => 'Piwik Stats For Today',
	'html'  => function() {

		$data = array(
			'keywords'	=> array(),
			'visitors'	=> array()
		);

		$token_auth = c::get('piwik_token');
		$baseUrl = c::get('piwik_baseUrl');
		$siteId = c::get('piwik_siteId');

		if($token_auth === null || $baseUrl === null || $piwik_siteId === null) {
			echo '<h2>ERROR</h2>';
			echo '<p>Please provide your Piwik Auth Token and a base url in your config.php - ';
			echo 'You can find more information in the README.md of this widget</p>';
			exit;
		}

		$baseUrl .= '?module=API&idSite='.$siteId;
		$baseUrl .= '&format=PHP';
		$baseUrl .= '&token_auth='.$token_auth;


		$url = $baseUrl.'&method=Referrers.getKeywords';
		$url .= '&period=day&date=today&filter_limit=7';

		$fetched = file_get_contents($url);
		$content = unserialize($fetched);

		// get recent keywords
		foreach ($content as $row) {
			$keyword = htmlspecialchars(html_entity_decode(urldecode($row['label']), ENT_QUOTES), ENT_QUOTES);

			$data['keywords'][] = array(
				'keyword'	=> $keyword,
				'hits'		=> $row['nb_visits']
			);
		}

		// Get live stats for today
		$minutesOfToday = date('i') + (date('G')*60);
		$url = $baseUrl.'&method=Live.getCounters&lastMinutes='.$minutesOfToday;

		$fetched = file_get_contents($url);
		$content = unserialize($fetched);

		$data['visitors']= $content[0];

		return tpl::load(__DIR__ . DS . 'template.php', $data);
	}
);
