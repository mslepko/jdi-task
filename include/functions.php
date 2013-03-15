<?php
function truncate($str, $length=10, $break = ' ', $end = '...') {
    $length-=mb_strlen($end);
    if (mb_strlen($str) <= $length)
        return $str;
    if (($breakpoint = strpos($str, $break, $length)) !== false) {
        if ($breakpoint < strlen($str) - 1) {
            $str = substr($str, 0, $breakpoint) . $end;
        }
    }
    return $str;
}
function page_title(){
	$uri = explode('?',$_SERVER['REQUEST_URI']);
    $uri = $uri[0];
	if($uri == '/')
		return 'Home';
	else
		return ucwords(strtolower(str_replace(array('/','_'),array('',' '),$uri)));
}