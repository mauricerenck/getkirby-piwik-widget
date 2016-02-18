<?php
	$baseUrl = c::get('piwik_baseUrl');
	$siteId = c::get('piwik_siteId');
?>
<div id="piwik">
	<div class="block">
		<img src="<?php echo $graph; ?>" alt="graph" />
	</div>

	<div class="block">
		<h3>Todays visits</h3>
		<ul>
			<li>
				<span class="conversion-title">Visits</span>
				<span class="marginalia conversion"><?php echo $visitors['visits'] ?></span>
			</li>
			<li>
				<span class="conversion-title">Actions</span>
				<span class="marginalia conversion"><?php echo $visitors['actions'] ?></span>
			</li>
		</ul>
	</div>

	<div id="goals" class="block">
		<h3>Goals</h3>
		<ul>
		<?php foreach($goals as $goal): ?>
			<li>
				<span class="conversion-title"><?php echo $goal['name'] ?></span>
				<span class="marginalia conversion"><?php echo $goal['conversions'] ?></span>
			</li>
		<?php endforeach; ?>
		</ul>
	</div>

	<div id="keywords" class="block">
		<h3>Keywords</h3>
		<ul>
		<?php foreach ($keywords as $entry) : ?>
			<li>
				<i class="icon icon-left fa fa-tag"></i>
				<span><?php echo $entry['keyword']; ?></span>
				<small class="marginalia"><?php echo $entry['hits']; ?></small>
			</li>
		<?php endforeach; ?>
		</ul>
	</div>
	<div class="block piwiklink">
		<a href="<?php echo $baseUrl; ?>/index.php?module=CoreHome&action=index&date=today&period=day&idSite=<?php echo $siteId; ?>" target="_blank">Go to Piwik <i class="fa fa-angle-right"></i></a>
	</div>
</div>

<style media="screen">
	#piwik ul {
		list-style-type: none
	}

	#piwik .icon {
		color: #777;
	}

	#piwik .marginalia {
		float: right;
	}

	#piwik .block {
		margin-bottom: 1em;
		padding-bottom: 1em;
		border-bottom: 1px solid #ddd;
		clear: both;
		display: block;
	}

	#piwik .block h3 {
		margin-bottom: 0.5em;
	}

	#piwik .conversion-title {
		width: 80%;
	}

	#piwik .conversion {
		width: 20%;
		text-align: right;
		float: right;
	}

	#piwik .piwiklink {
		text-align: right;
	}

	#piwik .piwiklink a:hover {
		text-decoration: underline;
	}
</style>
