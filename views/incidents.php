<?
$page = isset($_GET['page'])?$_GET['page']:0;
$limit = 1;
$Reports = Reports::getListWithPagination($page*$limit,$limit);
if($Reports):
		echo '<h2>List of incidents</h2>
				<ul class="list">';
		foreach($Reports as $Report):?>
			<li class="clearfix"><h4 class="title">Incident from <span class="bold"><?=date('Y/m/d H:i',$Report['incident_date'])?></span></h4>
				<div>
					<p class="title">Explanation</p>
					<?=truncate($Report['explanation'],100)?>
				</div>
				<?if(!empty($Report['measures'])):?>
				<div>
					<p class="title">Measures</p>
					<?=truncate($Report['measures'],100)?>
				</div>
				<?endif;?>
				<a href="/incident?id_report=<?=$Report['idReport']?>" class="fr title">read more</a>
			</li>
		<?endforeach;
		echo '</ul>';
	else:
		echo 'No incidents';
	endif;

$reportsCount = Reports::getAllReports(TRUE);
$maxPage = (ceil($reportsCount / $limit))-1;
echo '<div class="pagination">';
if($page>0)
	echo '<a href="/incidents?page='.($page-1).'" title="Prevoius">Prevoius page</a>';
if($maxPage>$page)
	echo '<a href="/incidents?page='.($page+1).'" title="Next">Next page</a>';
echo '</div>';