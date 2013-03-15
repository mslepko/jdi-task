<?php
require_once('config/config.inc.php');

//classes
include(PATH.'/class/db.class.php');
include(PATH.'/class/reports.class.php');
include(PATH.'/class/comments.class.php');
//db connection
$db = new DB();

include(PATH.'/include/functions.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title><?=page_title()?> | Unscheduled Downtime Incident Report</title>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
	<link href="/css/style.css" media="screen" rel="stylesheet" type="text/css" />
</head>