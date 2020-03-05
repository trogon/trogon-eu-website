<?php
echo('<pre>');

$path = realpath(__DIR__ . '/../bin/console');

$_SERVER['argv'] = [$path];
$_SERVER['argv'][] = 'doctrine:migrations:migrate';
$_SERVER['argv'][] = '--no-interaction';

include($path);

echo('</pre>');

exit($exitCode);
