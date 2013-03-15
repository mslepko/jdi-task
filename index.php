<?require_once(dirname(__FILE__).'/views/header.php');?>
<body>
<div id="top">
	<div class="wrapper_top"></div>
	<div class="wrapper">
		<h1>Unscheduled Downtime Incident Report</h1>
	</div>
</div>
<div id="nav">
	<div class="wrapper">
		<?include(PATH.'/views/nav_menu.php');?>
	</div>
</div>
<div id="body">
	<div class="wrapper clearfix">
		<div class="left_col">
			<?include(PATH.'/views/sidebarl.php');?>
		</div>
		<div class="center_top center_cols"></div>
		<div class="center_col center_cols">
			<div class="content">
				<?
				if($_GET['site'])
					@include(PATH.'/views/'.$_GET['site'].'.php');
				else
					include(PATH.'/views/home.php');
				?>
			</div>
		</div>
		<div class="center_btm center_cols"></div>
	</div>
	<div class="wrapper_btm"></div>
</div>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js" type="text/javascript"></script>
<script src="<?=BASE_URL?>/js/form.js" type="text/javascript"></script>
</body>
</html>