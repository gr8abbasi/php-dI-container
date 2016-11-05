<?php

ini_set('display_errors', true);
error_reporting(E_ALL);

$vendorPath = realpath(dirname(__FILE__).'/../vendor');
$loader  = require $vendorPath.'/autoload.php';
