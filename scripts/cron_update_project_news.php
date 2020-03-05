<?php
echo('<pre>');

$path = realpath(__DIR__ . '/../bin/console');

$_SERVER['argv'] = [$path];
$_SERVER['argv'][] = 'app:cron:update-project-news';

include($path);

echo('</pre>');

exit($exitCode);
