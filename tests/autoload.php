<?php

ini_set('display_errors', true);
error_reporting(E_ALL);

$vendorPath = realpath(dirname(__FILE__).'/../vendor');
$testsPath = realpath(dirname(__FILE__).'/../tests');

$loader  = require $vendorPath.'/autoload.php';
$loader->add('Tests\\', $testsPath);
