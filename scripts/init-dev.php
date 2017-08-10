<?php

echo('<pre>');

if(!isset($_SERVER['argv']) || !is_array($_SERVER['argv']) || count($_SERVER['argv']) === 0){
	$_SERVER['argv'] = [$_SERVER['SCRIPT_NAME']];
}

$_SERVER['argv'][] = '--env=Development';
$_SERVER['argv'][] = '--overwrite=y';

include('init');

echo('</pre>');
