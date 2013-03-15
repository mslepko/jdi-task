<?php
ini_set('display_errors',1);

define('BASE_URL',(($_SERVER['HTTPS'] && $_SERVER['HTTPS'] != "off") ? "https" : "http").'://'. $_SERVER['HTTP_HOST']);
define('PATH',dirname(dirname(__FILE__)));

//database
$db_host = 'localhost';
$db_name = 'mslepko_jdi';
$db_user = 'mslepko_jdi';
$db_pass ='OwiKY9Se';