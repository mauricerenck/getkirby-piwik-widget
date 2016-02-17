<h3>Todays visits</h3>
Visits = <?php echo $visitors['visits'] ?>
<br>Actions = <?php echo $visitors['actions'] ?>
<br>&nbsp;

<h3>Keywords</h3>
<ul class="dashboard-items">
<?php foreach ($keywords as $entry) : ?>
	<li class="dashboard-item">
		<?php echo $entry['keyword']; ?> (<?php echo $entry['hits']; ?>)
	</li>
<?php endforeach; ?>
</ul>
