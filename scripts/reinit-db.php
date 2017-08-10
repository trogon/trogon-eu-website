<?php

echo('<pre>');

include('yii-config.php');

$_SERVER['argv'] = [realpath('../yii')];
$_SERVER['argv'][] = 'migrate/down';
$_SERVER['argv'][] = 'all';
$_SERVER['argv'][] = '--interactive=0';

$application = new yii\console\Application($config);
$exitCode = $application->run();

$_SERVER['argv'] = [realpath('../yii')];
$_SERVER['argv'][] = 'migrate/up';
$_SERVER['argv'][] = '--interactive=0';

$application = new yii\console\Application($config);
$exitCode = $application->run();

echo('</pre>');

exit($exitCode);
