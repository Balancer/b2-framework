<?php

$GLOBALS['bors.composer.class_loader'] = require_once __DIR__.'/vendor/autoload.php';

define('BORS_SITE', __DIR__);

require_once __DIR__.'/vendor/balancer/bors-core/init.php';
