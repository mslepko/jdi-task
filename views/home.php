<?php
$incidents = Reports::getIncidentsList(3);
$incidentsCount = (int)Reports::getAllReports(TRUE);
$commentsCount = (int)Comments::getAllComments(TRUE);
?>

<div class="info_box">
	<p>Number of incidents: <span class="bold"><?=$incidentsCount?></span></p>
	<p>Number of comments: <span class="bold"><?=$commentsCount?></span></p>
</div>
<?
	if($incidents):
		echo '<h2>List of latest 3 incidents</h2>
				<ul class="list">';
		foreach($incidents as $incident):?>
			<li class="clearfix"><h4 class="title">Incident from <span class="bold"><?=date('Y/m/d H:i',$incident['incident_date'])?></span></h4>
				<div>
					<p class="title">Explanation</p>
					<?=truncate($incident['explanation'],100)?>
				</div>
				<a href="/incident?id_report=<?=$incident['idReport']?>" class="fr title">read more</a>
			</li>
		<?endforeach;
		echo '</ul>';
	else:
		echo 'No recent incidents';
	endif;
?>
