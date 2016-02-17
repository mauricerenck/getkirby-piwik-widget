<?php
return array(
	'title' => 'Piwik Stats For Today',
	'html'  => function() {

		$data = array(
			'keywords' => array(),
			'visitors' => array(),
			'goals'    => array()
		);

		$token_auth = c::get('piwik_token');
		$baseUrl = c::get('piwik_baseUrl');
		$siteId = c::get('piwik_siteId');

		if($token_auth === null || $baseUrl === null || $siteId === null) {
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

		$data['visitors'] = $content[0];


		// GET GOALS
		$url = $baseUrl.'&method=Goals.getGoals';
		$goals = array();

		$fetched = file_get_contents($url);
		$allGoals = unserialize($fetched);

		foreach ($allGoals as $goal) {
			$currentGoal = array(
				'id'	=> $goal['idgoal'],
				'name'	=> $goal['name']
			);

			$url = $baseUrl.'&method=Goals.get&idGoal='.$currentGoal['id'].'&period=day&date=today';

			$fetched = file_get_contents($url);
			$singleGoal = unserialize($fetched);

			$currentGoal['conversions'] = $singleGoal['nb_conversions'];
			$data['goals'][] = $currentGoal;
		}

		// image graph
		$data['graph'] = $baseUrl.'&method=ImageGraph.get&period=&period=day&date=previous7&apiModule=VisitsSummary&apiAction=get&graphType=evolution&width=600&height=150';

		return tpl::load(__DIR__ . DS . 'template.php', $data);
	}
);
