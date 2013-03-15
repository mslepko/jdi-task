<?php
$post=$error=array();
if($_POST['submitNewIncident']):
	$post = $_POST;
	unset($_POST);
	array_map('trim',$post);
	if(empty($post['incident_date']) || (date('Y/m/d H:i', strtotime($post['incident_date'])) != $post['incident_date']))
		$error['incident_date'] = 'The given date is invalid';
	if(empty($post['resolution_date']) || (date('Y/m/d H:i', strtotime($post['resolution_date'])) != $post['resolution_date']))
		$error['resolution_date'] = 'The given date is invalid';
	if(empty($post['total_time']))
		$error['total_time'] = 'Total time cannot be empty';
	if(empty($post['explanation']))
		$error['explanation'] = 'Explanation cannot be empty';
	if(empty($post['measures']))
		$error['measures'] = 'Measures cannot be empty';
	if(empty($error)):
		unset($post['submitNewIncident']);
		if(Reports::addReport($post)):
			$info = 'Report added';
			unset($post);
		else:
			$info = 'Report not added. Try again later.';
		endif;
	endif;
endif;
if(isset($_GET['id_report'])):
	$report = Reports::getReport($_GET['id_report']);
	if($report)
		$post = $report[0];
	else
		$info = 'There is no report wiht specified id.';
endif;

if(isset($_POST['submitNewComment'])):
	$post = $_POST;
	unset($_POST);
	array_map('trim',$post);
	if(empty($post['name']) || strlen($post['name'])>32)
		$error['name'] = 'Name must be from 1 to 32 characters long.';
	if(empty($post['comment']))
		$error['comment'] = 'Comment cannot be empty';
	if(empty($error)):
		unset($post['submitNewComment']);
		$post['comment_date'] = time();
		if(Comments::addComment($post)):
			$info = 'New comment added';
			unset($post);
		else:
			$info = 'Comment not added. Please try again later';
		endif;
	endif;

endif;
?>
<h2><?=isset($_GET['id_report'])?'Edit ':'Submit New '?>Incident</h2>

<form method="post" action="" class="newIncident" id="newIncident">
	<?=!empty($info)?'<span class="info">'.$info.'</span>':''?>
	<?if(!empty($error)):
		echo '<ul class="errorList">';
		foreach($error as $e)
			echo '<li>'.$e.'</li>';
		echo '</ul>';
	endif;?>
<fieldset>
	<div class="row">
		<label for="incident_date">Date / Time of Incident:</label>
		<input type="text" id="incident_date" name="incident_date" value="<?=isset($post['incident_date'])?date('H:i d-m-Y',$post['incident_date']):'YYYY/mm/dd HH:mm'?>" onblur="javascript:if(this.value=='') {this.value='YYYY/mm/dd HH:mm';}" onfocus="javascript:if(this.value=='YYYY/mm/dd HH:mm') {this.value='';}"/>
	</div>
	<div class="row">
		<label for="resolution_date">Date / Time of Resolution:</label>
		<input type="text" name="resolution_date" id="resolution_date" value="<?=isset($post['resolution_date'])?date('H:i d-m-Y',$post['resolution_date']):'YYYY/mm/dd HH:mm'?>" onblur="javascript:if(this.value=='') {this.value='YYYY/mm/dd HH:mm';}" onfocus="javascript:if(this.value=='YYYY/mm/dd HH:mm') {this.value='';}"/>
	</div>
	<div class="row">
		<label for="total_time">Total Time Elapsed:</label>
		<input type="text" name="total_time" id="total_time" value="<?=isset($post['total_time'])?$post['total_time']:''?>"/>
	</div>
	<div class="row">
		<label for="explanation">General Explanation:</label>
		<textarea name="explanation" rows="50" cols="25" id="explanation"><?=isset($post['explanation'])?$post['explanation']:''?></textarea>
	</div>
	<div class="row">
		<label for="measures">Preventive Measures Taken:</label>
		<textarea name="measures" rows="50" cols="25" id="measures"><?=isset($post['measures'])?$post['measures']:''?></textarea>
	</div>
	<div class="row">
		<?=(isset($_GET['idReport']) && $_GET['idReport']>0)?'<input type="hidden" name="idReport" value="'.$post['idReport'].'"/>':''?>
		<input type="submit" name="submitNewIncident" id="submitNewIncident" value=" "/>
	</div>
</fieldset>
</form>
<?if(isset($_GET['id_report'])):?>
<div class="comments">
	<form method="post" action="" id="newComment" class="newIncident">
		<fieldset>
			<legend>Add new comment</legend>
			<div class="row">
				<label for="name">Name:</label>
				<input type="text" name="name" id="name" value="" />
			</div>
			<div class="row">
				<label for="comment">Comment:</label>
				<textarea name="comment" id="comment" rows="20" cols="50"></textarea>
			</div>
			<div class="row">
				<input type="hidden" value="<?=$post['idReport']?>" name="idReport" />
				<input type="submit" name="submitNewComment" value="Add comment" class="fr" id="submitNewComment"/>
			</div>
		</fieldset>
	</form>

<?$comments = Comments::getCommentsForReport($post['idReport']);
if($comments):
	echo '<ul class="list">';
	foreach($comments as $comment):?>
		<li><div>
				<?=$comment['comment']?>
			</div>
			<p class="title">Comment from <span class="bold"><?=date('H:i:s d-m-Y',$comment['comment_date'])?></span> by <?=$comment['name']?></p>
		</li>
<?
	endforeach;
	echo '</ul>';
else:
	echo 'There are no other comments';
endif;?>
</div>

<?endif;?>