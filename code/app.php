<?php

define('APPDIR', __DIR__);

require_once(APPDIR . '/vendor/autoload.php');

$result = main(APPDIR . "/config.ini");

echo $result . PHP_EOL;